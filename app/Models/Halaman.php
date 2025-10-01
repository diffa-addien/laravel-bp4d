<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Halaman extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * Nama tabel.
     */
    protected $table = 'halamans';

    /**
     * Atribut yang dapat diisi.
     */
    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'isi',
    ];
}