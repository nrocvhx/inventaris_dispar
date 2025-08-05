<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Models\VehicleImage;
use App\Models\Pegawai;
use App\Models\Category;
use App\Traits\HasImage;
use App\Enums\VehicleStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    use HasImage;
    
    public function index()
    {
        $pegawai = Pegawai::get();
        $categories = Category::get();
        $kendaraan = Vehicle::with('pegawai')->paginate(10); 
        return view('admin.kendaraan.index', compact('kendaraan', 'categories', 'pegawai'));
    }

    public function store(VehicleRequest $request)
    {
        $vehicle = Vehicle::create($request->all());

        if ($request->hasFile('gambar')) {
            $images = $this->uploadMultipleImages($request->file('gambar'), 'public/vehicles/');
            foreach ($images as $image) {
                VehicleImage::create([
                    'vehicle_id' => $vehicle->id,
                    'image_path' => $image
                ]);
            }
        }

        // if ($request->hasFile('gambar')) {
        //     $images = $this->uploadMultipleImages($request->file('gambar'), 'public/vehicles/');
        //     foreach ($images as $image) {
        //         VehicleImage::create([
        //             'vehicle_id' => $request->id,
        //             'image_path' => $image
        //         ]);
        //     }
        // }

        return back()->with('toast_success', 'Kendaraan Berhasil Ditambahkan');
    }

    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        $image = $this->uploadImage($request, 'public/vehicles/', 'gambar');

        $vehicle->update([
            'kode_barang' => $request->kode_barang,
            'nup' => $request->nup,
            'jenis_barang' => $request->jenis_barang,
            'merk' => $request->merk,
            'id_kategori' => $request->id_kategori,
            'id_pegawai' => $request->id_pegawai,
            'nopol' => $request->nopol,
            'norang' => $request->norang,
            'nomes' => $request->nomes,
            'tahun_pembuatan' => $request->tahun_pembuatan,
            'bpkb' => $request->bpkb,
            'pajak' => $request->pajak,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan,            
        ]);

        // dd($request->bpkb);

        return back()->with('toast_success', 'Kendaraan Berhasil Diubah');
    }

    public function show(Vehicle $vehicle)
    {        

        return view('admin.kendaraan.show', compact('vehicle'));;
    }

    public function destroy(Vehicle $vehicle)
    {
        Storage::disk('local')->delete('public/vehicles/' . basename($vehicle->gambar));
        $vehicle->delete();

        return back()->with('toast_success', 'Kendaraan Berhasil Dihapus');
    }
}
