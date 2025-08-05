@extends('layouts.master', ['title' => 'Kendaraan'])

@section('content')
    <x-container>
        <div class="row">
            <div class="col-lg-8">
                <x-card title="DAFTAR KENDARAAN" class="card-body p-0">
                    <x-table>
                        <table id="supplierTable" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>NUP</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Merek</th>
                                    <th>Kategori</th>
                                    <th>Nomor Polisi</th>
                                    <th>Nomor Rangka</th>
                                    <th>Nomor Mesin</th>
                                    <th>Tahun Pembuatan</th>
                                    <th>BPKB</th>
                                    <th>Tanggal Pajak Kendaraan</th>
                                    <th>Kondisi</th>
                                    <th>Keterangan</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kendaraan as $i => $kendaraans)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $kendaraans->kode_barang }}</td>
                                        <td>{{ $kendaraans->nup }}</td>
                                        <td>{{ $kendaraans->jenis_barang }}</td>
                                        <td>{{ $kendaraans->merk }}</td>
                                        <td>{{ $kendaraans->kategori->name }}</td>
                                        <td>{{ $kendaraans->nopol }}</td>
                                        <td>{{ $kendaraans->norang }}</td>
                                        <td>{{ $kendaraans->nomes }}</td>
                                        <td>{{ $kendaraans->tahun_pembuatan }}</td>
                                        <td>{{ $kendaraans->bpkb }}</td>
                                        <td>{{ $kendaraans->pajak }}</td>
                                        <td>{{ $kendaraans->kondisi }}</td>
                                        <td>{{ $kendaraans->keterangan }}</td>
                                        <td>
                                            <a href="{{ route('admin.vehicle.show', $kendaraans->id) }}">
                                                <button class="btn btn-success btn-sm fa fa-eye" ></button>
                                            </a>
                                            @can('update-supplier')
                                                <x-button-modal :id="$kendaraans->id" title="" icon="edit"
                                                    style="" class="btn btn-info btn-sm" />
                                                <x-modal :id="$kendaraans->id" title="Edit - {{ $kendaraans->name }}">
                                                    <form action="{{ route('admin.vehicle.update', $kendaraans->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-input name="kode_barang" type="text" title="Kode Barang"
                                                            placeholder="Kode Barang" :value="$kendaraans->kode_barang" />
                                                        <x-input name="nup" type="text" title="NUP"
                                                            placeholder="NUP" :value="$kendaraans->nup" />
                                                        <x-input name="jenis_barang" type="text" title="Jenis Barang"
                                                            placeholder="Jenis Barang" :value="$kendaraans->jenis_barang" />
                                                        <x-input name="merk" type="text" title="Merek"
                                                            placeholder="Merek" :value="$kendaraans->merk" />
                                                            <x-select title="Kategori Kendaraan" name="id_kategori">
                                                                <option value>Silahkan Pilih</option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                                @endforeach
                                                            </x-select>
                                                        <x-input name="nopol" type="text" title="Nomor Polisi"
                                                            placeholder="Nomor Polisi" :value="$kendaraans->nopol" />
                                                        <x-input name="norang" type="text" title="Nomor Rangka"
                                                            placeholder="Nomor Rangka" :value="$kendaraans->norang" />
                                                        <x-input name="nomes" type="text" title="Nomor Mesin"
                                                            placeholder="Nomor Mesin" :value="$kendaraans->nomes" />
                                                        <x-input name="tahun_pembuatan" type="text" title="Tahun Pembuatan"
                                                            placeholder="Tahun Pembuatan" :value="$kendaraans->tahun_pembuatan" />
                                                        <x-input name="bpkb" type="text" title="BPKB"
                                                            placeholder="BPKB" :value="$kendaraans->bpkb" />
                                                        <x-input name="pajak" type="text" title="Tanggal Pajak Kendaraan"
                                                            placeholder="Tanggal Pajak Kendaraan" :value="$kendaraans->pajak" />
                                                        <x-input name="kondisi" type="text" title="Kondisi"
                                                            placeholder="Kondisi" :value="$kendaraans->kondisi" />
                                                        <x-input name="keterangan" type="text" title="Keterangan"
                                                            placeholder="Keterangan" :value="$kendaraans->keterangan" />
                                                            <x-button-save title="Simpan" icon="save"
                                                            class="btn btn-primary" />
                                                    </form>
                                                </x-modal>
                                            @endcan

                                            @can('delete-kendaraan')
                                                <x-button-delete :id="$kendaraans->id"
                                                    :url="route('admin.vehicle.destroy', $kendaraans->id)" title=""
                                                    class="btn btn-danger btn-sm" />
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
                <x-card title="TAMBAH KENDARAAN" class="card-body">
                    <form action="{{ route('admin.vehicle.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-input name="kode_barang" type="text" title="Kode barang" placeholder="Kode barang"
                            :value="old('kode_barang')" />
                        <x-input name="nup" type="text" title="NUP" placeholder="NUP"
                            :value="old('nup')" />
                        <x-input name="jenis_barang" type="text" title="Jenis Barang" placeholder="Jenis Barang"
                            :value="old('jenis_barang')" />
                        <x-input name="merk" type="text" title="Merek" placeholder="Merek"
                            :value="old('merk')" />
                        <x-select title="Kategori Kendaraan" name="id_kategori">
                            <option value>Silahkan Pilih</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input name="nopol" type="text" title="No Polisi" placeholder="No Polisi"
                            :value="old('nopol')" />
                        <x-input name="norang" type="text" title="No Rangka" placeholder="No Rangka"
                            :value="old('norang')" />
                        <x-input name="nomes" type="text" title="No Mesin" placeholder="No Mesin"
                            :value="old('nomes')" />
                        <x-input name="tahun_pembuatan" type="text" title="Tahun pembuatan" placeholder="Tahun pembuatan"
                            :value="old('tahun_pembuatan')" />
                        <x-input name="bpkb" type="text" title="BPKB" placeholder="BPKB"
                            :value="old('bpkb')" />
                        <x-input name="pajak" type="text" title="Pajak" placeholder="Pajak"
                            :value="old('pajak')" />
                        <x-input name="kondisi" type="text" title="Kondisi" placeholder="Kondisi"
                            :value="old('kondisi')" />
                        <x-input name="keterangan" type="text" title="Keterangan" placeholder="Keterangan"
                            :value="old('keterangan')" />
                        <p>
                            Pilih Gambar<input name="gambar[]" type="file" title="Gambar" placeholder="Gambar" :value="old('gambar')" multiple />
                            <small class=""></small>
                        </p>
                        <x-button-save title="Simpan" icon="save" class="btn btn-primary" />
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
            var table = $('#supplierTable').DataTable({
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
