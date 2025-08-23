<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;
    protected $table = 'permintaan';
    protected $primaryKey = 'id';
    protected $guarded = [];

    // public $incrementing = false;
    public $timestamps = true;

    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'barang_id');
    }
}