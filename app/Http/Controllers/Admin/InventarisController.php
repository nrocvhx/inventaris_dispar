<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Models\Pegawai;
use App\Models\Inventaris;
use App\Models\Supplier;
use App\Http\Requests\InventarisRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class InventarisController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();
        $kendaraan = Vehicle::all();
        $inventaris = Inventaris::with('pegawai', 'kendaraan')->paginate(10);

        // Uncomment to debug the data
        // dd($inventaris);

        return view('admin.inventaris.index', compact('kendaraan', 'pegawai', 'inventaris'));
    }

    public function store(InventarisRequest $request)
    {
        Inventaris::create([
            'id_barang' => $request->id_barang,    
            'id_pegawai' => $request->id_pegawai,
            'nomor' => $request->nomor,
            'tanggal' => $request->tanggal,
        ]);

        return back()->with('toast_success', 'Kendaraan Berhasil Ditambahkan');
    }

    public function update(InventarisRequest $request, $id)
    {
        
        $inven = Inventaris::findOrFail($id);
        $inven->update($request->validated());

        return back()->with('toast_success', 'Supplier Berhasil Diubah');

    }

    public function show(Vehicle $vehicle)
    {        

        return view('admin.kendaraan.show', compact('vehicle'));;
    }

    public function destroy($id)
    {
        $inven = Inventaris::findOrFail($id);
        $inven->delete();

        return back()->with('toast_success', 'Inventaris Berhasil Dihapus');
    }
}