from flask import Flask, request, jsonify
from tensorflow.keras.models import load_model 
from tensorflow.keras.preprocessing import image as keras_image
import numpy as np
import json
import os
import tensorflow as tf
from PIL import Image
from werkzeug.utils import secure_filename
import colorsys # Import library untuk konversi warna

# Menonaktifkan optimasi XLA untuk kompatibilitas
os.environ['TF_XLA_FLAGS'] = '--tf_xla_auto_jit=0'

app = Flask(__name__)
os.makedirs("temp_uploads", exist_ok=True)
app.config['UPLOAD_FOLDER'] = 'temp_uploads'

model = load_model("Model_XCEPTION9010.h5", compile=False)

with open('rekomendasi.json') as f:
    rekomendasi_dict = json.load(f)

label_mapping = ['Blast', 'Blight', 'BrownSpot', 'Tungro', 'Tidak Terdeteksi']

# --- FUNGSI BARU UNTUK ANALISIS WARNA ---
def is_leaf_image(img, threshold_percent=20.0):
    """
    Menganalisis gambar untuk memeriksa apakah mengandung persentase warna daun 
    (hijau, kuning, coklat) yang cukup.
    Menggunakan ruang warna HSV untuk deteksi warna yang lebih andal.
    """
    # Ubah ukuran ke thumbnail kecil untuk analisis cepat
    thumb = img.copy()
    thumb.thumbnail((100, 100))
    
    # Dapatkan daftar warna dominan
    colors = thumb.getcolors(thumb.size[0] * thumb.size[1])
    if not colors:
        return False

    leaf_pixel_count = 0
    total_pixel_count = thumb.size[0] * thumb.size[1]

    for count, (r, g, b) in colors:
        # Abaikan warna yang sangat gelap atau sangat terang (mendekati hitam/putih)
        if (r+g+b)/3 < 25 or (r+g+b)/3 > 230:
            continue

        # Konversi RGB ke HSV
        h, s, v = colorsys.rgb_to_hsv(r/255.0, g/255.0, b/255.0)
        
        # Tentukan rentang Hue untuk warna daun
        # Coklat/Kuning/Oranye: 0.05-0.17 (~18-60 derajat)
        # Hijau: 0.17-0.44 (~60-160 derajat)
        if (0.05 <= h <= 0.44) and s > 0.15:
            leaf_pixel_count += count
            
    percentage = (leaf_pixel_count / total_pixel_count) * 100
    return percentage >= threshold_percent

@app.route('/predict', methods=['POST'])
def predict():
    if 'file' not in request.files:
        return jsonify({'error': 'No file part in the request'}), 400

    file = request.files['file']
    if file.filename == '':
        return jsonify({'error': 'No selected file'}), 400

    if file:
        filename = secure_filename(file.filename)
        temp_path = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        file.save(temp_path)

        try:
            img = Image.open(temp_path)
            if img.mode != 'RGB':
                img = img.convert('RGB')

            # --- LANGKAH 1: FILTER WARNA SEBELUM PREDIKSI ---
            if not is_leaf_image(img, threshold_percent=20.0):
                os.remove(temp_path)
                return jsonify({
                    'status': 'success',
                    'label': label_mapping[4], # Tidak Terdeteksi
                    'confidence': 0.0,
                    'rekomendasi': 'Gambar tidak tampak seperti daun padi. Silahkan coba lagi.'
                })
            # -----------------------------------------------

            img_resized = img.resize((150, 150))
            img_array = keras_image.img_to_array(img_resized)
            img_array = np.expand_dims(img_array, axis=0)
            img_array = img_array / 255.0

            prediction = model.predict(img_array)
            
            CONFIDENCE_THRESHOLD = 50.0 
            confidence = float(np.max(prediction[0]) * 100)

            if confidence < CONFIDENCE_THRESHOLD:
                os.remove(temp_path)
                return jsonify({
                    'status': 'success',
                    'label': label_mapping[4],
                    'confidence': round(confidence, 2),
                    'rekomendasi': 'Gambar tidak dapat diidentifikasi sebagai salah satu dari empat penyakit padi yang ada. Silakan unggah ulang gambar daun padi yang lebih jelas.'
                })
            else:
                class_index = int(np.argmax(prediction[0]))
                label = label_mapping[class_index]
                rekomendasi = rekomendasi_dict.get(label, "Rekomendasi tidak ditemukan.")
                
                os.remove(temp_path)
                
                return jsonify({
                    'status': 'success',
                    'label': label,
                    'confidence': round(confidence, 2),
                    'rekomendasi': rekomendasi
                })

        except Exception as e:
            if os.path.exists(temp_path):
                os.remove(temp_path)
            return jsonify({'error': f'Error processing image: {str(e)}'}), 500
            
    return jsonify({'error': 'Invalid file'}), 400

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)

