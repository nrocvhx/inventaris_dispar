<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Http\Requests\PegawaiRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::paginate(10);

        return view('admin.supplier.index', compact('pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PegawaiRequest $request)
    {
        Pegawai::create($request->all());

        return back()->with('toast_success', 'Supplier Berhasil Ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PegawaiRequest $request, $id)
    {

        $pegawais = Pegawai::findOrFail($id);
        $pegawais->update($request->validated());

        return back()->with('toast_success', 'Supplier Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return back()->with('toast_success', 'Pegawai Berhasil Dihapus');
    }
}
