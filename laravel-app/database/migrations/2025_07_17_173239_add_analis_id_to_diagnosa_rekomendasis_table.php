    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::table('diagnosa_rekomendasis', function (Blueprint $table) {
                // Menambahkan kolom untuk menyimpan ID Analis yang membuat diagnosa
                $table->foreignId('analis_id')->nullable()->after('permohonan_no_surat')->constrained('users', 'user_id');
            });
        }

        public function down(): void
        {
            Schema::table('diagnosa_rekomendasis', function (Blueprint $table) {
                $table->dropForeign(['analis_id']);
                $table->dropColumn('analis_id');
            });
        }
    };
    