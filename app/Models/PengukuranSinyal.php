<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengukuranSinyal extends Model
{
    use HasFactory;
    
    /**
     * Menonaktifkan timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $table = 'pengukuran_sinyal';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'perjalanan_id',
        'timestamp_waktu',
        'teknologi',
        'earfcn',
        'pci',
        'rsrp',
        'rsrq',
        'sinr',
        'cqi',
        'cell_id',
    ];

    /**
     * Definisi relasi: Banyak Pengukuran Sinyal dimiliki oleh satu Perjalanan.
     */
    public function perjalanan(): BelongsTo
    {
        return $this->belongsTo(Perjalanan::class, 'perjalanan_id');
    }
}