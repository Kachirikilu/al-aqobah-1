<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     public function up(): void
//     {
//         Schema::create('pengukuran_sinyal', function (Blueprint $table) {
//             $table->id();
            
//             // Foreign Key ke tabel perjalanans
//             $table->foreignId('perjalanan_id')->constrained('perjalanans')->onDelete('cascade');
            
//             // Data Sinyal
//             $table->timestamp('timestamp_waktu');
            
//             // Kolom Umum Jaringan (LTE/5G)
//             $table->string('teknologi', 10)->nullable(); // LTE, NR, 3G
//             $table->integer('earfcn')->nullable(); // Frekuensi (Channel)
//             $table->integer('pci')->nullable(); // Physical Cell ID
            
//             // Pengukuran Kualitas Sinyal
//             $table->float('rsrp')->nullable(); // Reference Signal Received Power
//             $table->float('rsrq')->nullable(); // Reference Signal Received Quality
//             $table->float('sinr')->nullable(); // Signal to Interference Noise Ratio
//             $table->float('cqi')->nullable(); // Channel Quality Indicator
            
//             // Kolom Lain dari NMF yang mungkin penting
//             $table->string('cell_id')->nullable(); 
            
//             $table->timestamps();
            
//             // Index untuk pencarian berdasarkan sesi dan waktu
//             $table->index(['perjalanan_id', 'timestamp_waktu']);
//         });
//     }

//     public function down(): void
//     {
//         Schema::dropIfExists('pengukuran_sinyal');
//     }
// };