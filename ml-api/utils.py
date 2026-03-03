from keras.preprocessing import image
import numpy as np
from PIL import Image
import io

def preprocess_img(file):
    img = Image.open(io.BytesIO(file.read()))
    img = img.resize((150, 150))  # ✅ sesuai input layer model
    img = image.img_to_array(img)
    img = np.expand_dims(img, axis=0)
    img = img / 255.0
    return img
