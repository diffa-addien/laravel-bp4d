<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Agenda extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * Mendefinisikan nama tabel secara eksplisit.
     */
    protected $table = 'agendas';

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'judul',
        'slug',
        'tanggal',
        'lokasi',
        'isi',
        'is_published',
    ];

    /**
     * Tipe data asli dari atribut.
     */
    protected $casts = [
        'is_published' => 'boolean',
        'tanggal' => 'date', // Pastikan tanggal di-cast sebagai objek Date
    ];
}