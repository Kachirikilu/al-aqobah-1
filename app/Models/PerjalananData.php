<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerjalananData extends Model
{
    use HasFactory;

    /**
     * Menonaktifkan timestamps karena kita hanya menggunakan insert batch
     * dan tidak perlu `updated_at`/`created_at` di sini.
     *
     * @var bool
     */
    public $timestamps = false; 
    
    protected $table = 'perjalanan_datas';

    /**
     * Atribut yang dapat diisi secara massal.
     * Meskipun kita menggunakan Query Builder untuk Batch Insert di Controller
     * (yang mengabaikan $fillable), mendefinisikannya adalah praktik yang baik.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'perjalanan_id',
        'perangkat',
        'file_nmf',
        'status',
        'timestamp_mulai',
        'timestamp_selesai',
    ];

    /**
     * Definisi relasi: Banyak Titik GPS dimiliki oleh satu Perjalanan.
     */
    public function perjalanan(): BelongsTo
    {
        return $this->belongsTo(Perjalanan::class, 'perjalanan_id');
    }
}