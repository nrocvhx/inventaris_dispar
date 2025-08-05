@extends('layouts.master', ['title' => 'Inventaris'])

@section('content')
    <x-container>
        <div class="row">
            <div class="col-lg-8">
                <x-card title="DAFTAR INVENTARIS" class="card-body p-0">
                    <x-table>
                        <table id="supplierTable" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>NUP</th>
                                    <th>Jenis Barang</th>
                                    <th>Merk/Type</th>
                                    <th>Status</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Nomor</th>
                                    <th>tanggal</th>
                                    <th>Nomor Polisi</th>
                                    <th>Nomor Rangka</th>
                                    <th>Nomor Mesin</th>
                                    <th>Tahun Pembuatan</th>
                                    <th>Nomor BPKB</th>
                                    <th>Tanggal Pajak Kendaraan</th>
                                    <th>Kondisi Kendaraan</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventaris as $i => $inven)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $inven->kendaraan->kode_barang }}</td>
                                        <td>{{ $inven->kendaraan->nup }}</td>
                                        <td>{{ $inven->kendaraan->jenis_barang }}</td>
                                        <td>{{ $inven->kendaraan->merk }}</td>
                                        <td>{{ $inven->kendaraan->kategori->name }}</td>
                                        <td>{{ $inven->pegawai->nama }}</td>
                                        <td>{{ $inven->pegawai->jabatan }}</td>
                                        <td>{{ $inven->nomor }}</td>
                                        <td>{{ $inven->tanggal }}</td>
                                        <td>{{ $inven->kendaraan->nopol }}</td>
                                        <td>{{ $inven->kendaraan->norang }}</td>
                                        <td>{{ $inven->kendaraan->nomes }}</td>
                                        <td>{{ $inven->kendaraan->tahun_pembuatan }}</td>
                                        <td>{{ $inven->kendaraan->bpkb }}</td>
                                        <td>{{ $inven->kendaraan->pajak }}</td>
                                        <td>{{ $inven->kendaraan->kondisi }}</td>
                                        <td>{{ $inven->kendaraan->keterangan }}</td>
                                        <td>
                                            <a href="{{ route('admin.vehicle.show', $inven->kendaraan->id) }}">
                                                <button class="btn btn-success btn-sm fa fa-eye"></button>
                                            </a>
                                            @can('update-inventaris')
                                                <x-button-modal :id="$inven->kendaraan->id" title="" icon="edit" style="" class="btn btn-info btn-sm" />
                                                <x-modal :id="$inven->kendaraan->id" title="Edit - {{ $inven->kendaraan->kode_barang }}">
                                                    <form action="{{ route('admin.inventaris.update', $inven->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="id_barang" value="{{ $inven->kendaraan->id  }}">
                                                        <x-select title="Pengguna/Penanggung Jawab" name="id_pegawai">
                                                            <option value>Silahkan Pilih</option>
                                                            @foreach ($pegawai as $pegawais)
                                                                <option value="{{ $pegawais->id }}">{{ $pegawais->nama }}</option>
                                                            @endforeach
                                                        </x-select>
                                                        <x-input name="nomor" type="text" title="Nomor" placeholder="Nomor" :value="$inven->nomor" />
                                                        <x-input name="tanggal" type="text" title="Tanggal" placeholder="Tanggal" :value="$inven->tanggal" />
                                                        <x-button-save title="Simpan" icon="save" class="btn btn-primary" />
                                                    </form>
                                                </x-modal>
                                            @endcan
                                            @can('delete-inventaris')
                                                <x-button-delete :id="$inven->id" :url="route('admin.inventaris.destroy', $inven->id)" title="" class="btn btn-danger btn-sm" />
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </x-table>
                </x-card>
            </div>

            <div class="col-lg-4">
                <x-card title="TAMBAH INVENTARIS" class="card-body">
                    <form action="{{ route('admin.inventaris.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-select title="Kode Barang" name="id_barang">
                            <option value>Silahkan Pilih</option>
                            @foreach ($kendaraan as $kendaraans)
                                <option value="{{ $kendaraans->id }}">{{ $kendaraans->kode_barang }}</option>
                            @endforeach
                        </x-select>
                        <x-select title="Pengguna/Penanggung Jawab" name="id_pegawai">
                            <option value>Silahkan Pilih</option>
                            @foreach ($pegawai as $pegawais)
                                <option value="{{ $pegawais->id }}">{{ $pegawais->nama }}</option>
                            @endforeach
                        </x-select>
                        <x-input name="nomor" type="text" title="Nomor" placeholder="Nomor" :value="old('nomor')" />
                        <x-input name="tanggal" type="text" title="Tanggal" placeholder="Tanggal" :value="old('tanggal')" />
                        <x-button-save title="Simpan" icon="save" class="btn btn-primary" />
                        <x-button-link title="Kembali" icon="arrow-left" :url="route('admin.inventaris.index')" class="btn btn-dark" style="mr-1" />
                    </form>
                </x-card>
            </div>
        </div>
    </x-container>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#supplierTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude last column (Aksi)
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude last column (Aksi)
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude last column (Aksi)
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude last column (Aksi)
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude last column (Aksi)
                        }
                    }
                ]
            });
        });
    </script>
@endpush
