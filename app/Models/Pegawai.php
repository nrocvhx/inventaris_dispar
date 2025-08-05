<?php

namespace App\Models;

use App\Models\vehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nip',
        'jabatan'
    ];

    public function kendaraans()
    {
        return $this->hasMany(Vehicle::class, 'id_pegawai');
    }

    public function inventaris()
    {
        return $this->hasMany(Inventaris::class, 'id_pegawai');
    }
}