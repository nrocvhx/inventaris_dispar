@extends('layouts.master', ['title' => 'Kendaraan'])

@section('content')
    <x-container>
        <div class="col-12 col-lg-6">
            <x-card title="Data Kendaraan">
                <div class="list list-row list-hoverable">
                    <div class="list-item">
                        <div>
                            <span class="badge bg-danger">{{ $vehicle->merk }}</span>
                        </div>
                        <div class="text-truncate">
                            <a class="text-body d-block">Kode Barang: {{ $vehicle->kode_barang }}</a>
                            <a class="text-body d-block">Merek Kendaraan: {{ $vehicle->merk }}</a>
                            <a class="text-body d-block">Jenis Kendaraan: {{ $vehicle->jenis_barang }}</a>
                            <a class="text-body d-block">Kategori Kendaraan: {{ $vehicle->kategori->name }}</a>
                            <a class="text-body d-block">Nomor Polisi: {{ $vehicle->nopol }}</a>
                            <a class="text-body d-block">Nomor Kerangka: {{ $vehicle->norang }}</a>
                            <a class="text-body d-block">Nomor Mesin: {{ $vehicle->nomes }}</a>
                            <a class="text-body d-block">Tahun Pembuatan Kendaraan: {{ $vehicle->tahun_pembuatan }}</a>
                            <a class="text-body d-block">Nomor BPKB Kendaraan: {{ $vehicle->bpkb }}</a>
                            <a class="text-body d-block">Tanggal Pajak Kendaraan: {{ $vehicle->pajak }}</a>
                            <a class="text-body d-block">Kondisi Kendaraan: {{ $vehicle->kondisi }}</a>
                            <a class="text-body d-block">Keterangan: {{ $vehicle->keterangan }}</a>
                        </div>
                    </div>
                </div>
            </x-card>
            <a href="{{ route('admin.vehicle.index') }}">
                <button type="button" class="btn btn-primary">                 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"></path>
                    </svg>
                    Kembali               
                </button>
            </a>
        </div>

        <div class="col-12 col-lg-6">
            <x-card title="Gambar Kendaraan">
                <div id="vehicleCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @forelse ($vehicle->images as $index => $image)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/vehicles/' . $image->image_path) }}" class="d-block w-100" alt="{{ $vehicle->kode_barang }} image">
                            </div>
                        @empty
                            <div class="carousel-item active">
                                <p>Tidak ada gambar tersedia.</p>
                            </div>
                        @endforelse
                    </div>
                    <a class="carousel-control-prev" href="#vehicleCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#vehicleCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </x-card>
        </div>
    </x-container>
@endsection
