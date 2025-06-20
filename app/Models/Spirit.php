<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spirit extends Model
{
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    protected $fillable = [
    'code', 'spirit', 'julukan', 'deskripsi',
    'gambar_animal', 'gambar_logo', 'gambar_elemen', 'warna'
    ];

}
