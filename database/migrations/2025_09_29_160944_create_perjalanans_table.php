<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perjalanans', function (Blueprint $table) {
            $table->id(); // Kunci primer (Primary Key) untuk Eloquent
            
            // Kolom dari input user dan header NMF
            $table->string('id_perjalanan')->unique()->comment('ID unik sesi dari log NMF atau UUID');
            $table->string('nama_pengguna');
            $table->string('perangkat')->comment('Model perangkat, misal: samsung/SM-G973F');
            
            // Tambahan info sesi
            $table->timestamp('timestamp_mulai')->nullable();
            $table->timestamp('timestamp_selesai')->nullable();
            
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perjalanans');
    }
};