<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barang',
        'id_pegawai',
        'nomor',
        'tanggal'
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Vehicle::class, 'id_barang');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}
