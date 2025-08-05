<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang', 'nup', 'jenis_barang', 'merk', 'id_kategori', 'nopol', 
        'norang', 'nomes', 'tahun_pembuatan', 'bpkb', 'pajak', 'keterangan', 'kondisi'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'id_kategori');
    }

    public function inventaris()
    {
        return $this->hasMany(Inventaris::class, 'id_barang');
    }

    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }
}
