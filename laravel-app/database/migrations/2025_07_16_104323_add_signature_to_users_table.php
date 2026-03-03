    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::table('users', function (Blueprint $table) {
                // Menambahkan kolom untuk menyimpan path file gambar tanda tangan
                $table->string('tanda_tangan')->nullable()->after('password');
                
                // Menambahkan kolom untuk menyimpan path file gambar stempel
                $table->string('stempel')->nullable()->after('tanda_tangan');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['tanda_tangan', 'stempel']);
            });
        }
    };
    