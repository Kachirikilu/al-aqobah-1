<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     public function up(): void
//     {
//         Schema::create('titik_gps', function (Blueprint $table) {
//             $table->id();
            
//             // Foreign Key ke tabel perjalanans
//             $table->foreignId('perjalanan_id')->constrained('perjalanans')->onDelete('cascade');
            
//             // Data Lokasi
//             $table->timestamp('timestamp_waktu');
//             $table->decimal('latitude', 10, 7); // Presisi tinggi
//             $table->decimal('longitude', 10, 7); // Presisi tinggi
//             $table->decimal('altitude', 8, 2)->nullable(); // Ketinggian
//             $table->string('sumber', 10)->comment('GPX atau NMF');
            
//             $table->timestamps();
            
//             // Index untuk pencarian berdasarkan sesi dan waktu
//             $table->index(['perjalanan_id', 'timestamp_waktu']);
//         });
//     }

//     public function down(): void
//     {
//         Schema::dropIfExists('titik_gps');
//     }
// };