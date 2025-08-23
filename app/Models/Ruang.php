<?php

namespace App\Models;

use App\Models\BarangMasuk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruang extends Model
{
    use HasFactory;
    protected $table = 'ruang';
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
        return $this->hasMany(BarangMasuk::class, 'ruang_id', 'id');
    }
}
