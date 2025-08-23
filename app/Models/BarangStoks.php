<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangStoks extends Model
{
    use HasFactory;
    protected $table = 'barang_stoks';
    protected $primaryKey = 'id';
    protected $guarded = [];

    // public $incrementing = false;
    public $timestamps = true;



    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'prodi_id');
    }
    public function barangmasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'barang_id', 'id');
    }
}
