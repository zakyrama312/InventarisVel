<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = 'prodi';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    // public $incrementing = false;
    public $timestamps = true;

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function kategoris()
    {
        return $this->hasMany(Kategori::class);
    }
    public function kondisis()
    {
        return $this->hasMany(Kondisi::class);
    }
    public function ruangs()
    {
        return $this->hasMany(Ruang::class);
    }
    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'prodi_id');
    }
}
