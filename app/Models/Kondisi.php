<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kondisi extends Model
{
    use HasFactory;
    protected $table = 'kondisi';
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
        return $this->hasMany(BarangMasuk::class, 'kondisi_id');
    }
}
