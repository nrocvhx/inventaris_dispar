@extends('layouts.master', ['title' => 'Supplier'])

@section('content')
    <x-container>
        <div class="row">
            <div class="col-lg-8">
                <x-card title="DAFTAR PEGAWAI" class="card-body p-0">
                    <x-table>
                        <table id="supplierTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawai as $i => $pegawais)
                                    <tr>
                                        <td>
                                            {{ $i + 1 }}
                                        </td>
                                        <td>{{ $pegawais->nama }}</td>
                                        <td>{{ $pegawais->nip }}</td>
                                        <td>{{ $pegawais->jabatan }}</td>
                                        <td>
                                            <!-- Action buttons -->
                                            @can('update-supplier')
                                                <x-button-modal :id="$pegawais->id" title="" icon="edit"
                                                    style="" class="btn btn-info btn-sm" />
                                                <x-modal :id="$pegawais->id" title="Edit - {{ $pegawais->nama }}">
                                                    <form action="{{ route('admin.supplier.update', $pegawais->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-input name="nama" type="text" title="Nama Pegawai"
                                                            placeholder="Nama Pegawai" :value="$pegawais->nama" />
                                                        <x-input name="nip" type="text" title="NIP"
                                                            placeholder="NIP" :value="$pegawais->nip" />
                                                        <x-input name="jabatan" type="text" title="Jabatan"
                                                            placeholder="Jabatan"
                                                            :value="$pegawais->jabatan" />
                                                        <x-button-save title="Simpan" icon="save"
                                                            class="btn btn-primary" />
                                                    </form>
                                                </x-modal>
                                            @endcan
                                                <x-button-delete :id="$pegawais->id"
                                                    :url="route('admin.supplier.destroy', $pegawais->id)" title=""
                                                    class="btn btn-danger btn-sm" />
                                        </td>
                                    </tr>
                                    <!-- Hidden detail row -->
                                    {{-- <tr class="collapse-row">
                                        <td colspan="5">
                                            <div class="collapse" id="detailCollapse{{ $supplier->id }}">
                                                <!-- Detailed content here -->
                                                <p><strong>Detail:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, autem!</p>
                                            </div>
                                        </td>
                                    </tr> --}}
                                @endforeach
                            </tbody>
                        </table>
                    </x-table>
                </x-card>
            </div>

            <div class="col-lg-4">
                <x-card title="TAMBAH PEGAWAI" class="card-body">
                    <form action="{{ route('admin.supplier.store') }}" method="POST">
                        @csrf
                        <x-input name="nama" type="text" title="Nama Pegawai" placeholder="Nama Pegawai"
                            :value="old('nama')" />
                        <x-input name="nip" type="text" title="NIP" placeholder="NIP"
                            :value="old('nip')" />
                        <x-input name="jabatan" type="text" title="Jabatan" placeholder="Jabatan"
                            :value="old('jabatan')" />
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

            // Handle row click to toggle collapse
            $('#supplierTable tbody').on('click', 'td.details-control button', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(formatDetailRow(row.data())).show();
                    tr.addClass('shown');
                }
            });
        });

        // Format the detail row content
        function formatDetailRow(data) {
            // Example content, replace with actual detail content from your data
            var detailHtml = '<div class="details-content">' +
                                 '<p><strong>Detail:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, autem!</p>' +
                             '</div>';

            return detailHtml;
        }
    </script>
@endpush
