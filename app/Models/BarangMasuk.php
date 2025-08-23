<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $guarded = [];

    // public $incrementing = false;
    public $timestamps = true;


    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'prodi_id');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class, 'kondisi_id');
    }
    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
    public function barangstoks()
    {
        return $this->hasMany(BarangStoks::class, 'barang_id', 'id');
    }
}
