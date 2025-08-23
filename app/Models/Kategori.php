<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'id';
    protected $guarded = [];

    // public $incrementing = false;
    public $timestamps = true;

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'prodi_id');
    }
    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'kategori_id');
    }
}
