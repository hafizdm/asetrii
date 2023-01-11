@extends('App')

@php
    $stockCategoryId = app('request')->input('stock_id');

    $stockCategory = \App\Models\Stock::find($stockCategoryId);
@endphp

@section('content-header', 'Stock Keluar Asset Tidak Tetap:' . $stockCategory->name)

@section('content')
    {{-- {{ dd(App\Models\Item::all()) }} --}}
    <x-content>
        <x-row>
            <x-card-collapsible>
                <x-row>
                    <x-col class="mb-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-modal">Tambah</button>
                        <a href="{{ route('record-non-out.exports', ['stock_id'=>app('request')->stock_id]) }}" class="btn btn-info" title="Cetak"><i class="fas fa-print"></i></a>
                        

                    </x-col>

                    <div class="row g-3 align-items-center mb-3">
                        
                        <div class="col-auto">
                        <form action="{{ route('record-out.index')}}" method="GET">
                        <input type="hidden" name="stock_id" value="{{ app('request')->stock_id }}">
                          <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline" value="{{ app('request')->search }}">
                        </form>
                        </div>
                        
                    </div>

                    <x-col>
                        <x-table :thead="['Tanggal', 'Jenis', 'Merk', 'Nama Barang', 'Jumlah', 'Ukuran', 'Penerima', 'Jabatan', 'Keterangan', 'Aksi']">
                            @foreach($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}</td>
                                    <td>{{ $row->item->kind->name }}</td>
                                    <td>{{ $row->item->merk->name }}</td>
                                    <td>{{ $row->item->name }}</td>
                                    <td>{{ (int) $row->amount }}</td>
                                    <td>{{ $row->item->ukuran }}</td>
                                    <td>{{ $row->reciever }}</td>
                                    <td>{{ $row->role }}</td>
                                    <td>{{ $row->notes }}</td>
                                    <td>
                                        {{-- <a
                                            href="{{ route('item.index', ['stock_id' => $row->id]) }}"
                                            class="btn btn-primary"
                                            title="Ruang Kelas"><i class="fas fa-chalkboard"></i></a>
                                        <a
                                            href="{{ route('stock.show', $row->id) }}"
                                            class="btn btn-warning"
                                            title="Ubah"><i class="fas fa-pencil-alt"></i></a>

                                        <form style=" display:inline!important;" method="POST" action="{{ route('stock.destroy', $row->id) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                                title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </x-table>
                    </x-col>

                    <x-col class="d-flex justify-content-end">
                        {{ $data->links() }}
                    </x-col>
                </x-row>
            </x-card-collapsible>
        </x-row>
    </x-content>

    <x-modal :title="'Tambah Data'" :id="'add-modal'" :size="'xl'">
        <form style="width: 100%" action="{{ route('record-out-non-asset.index') }}" method="POST">
            @csrf
            @method('POST')
            {{-- <input type="hidden" name="type" value="{{ app('request')->input('type') }}"> --}}
            <x-row>
                <x-in-text
                    :label="'Pilih Tanggal'"
                    :placeholder="'Pilih Tanggal'"
                    :col="6"
                    :name="'moved_at'"
                    :type="'date'"
                    :required="true"></x-in-text>
                <x-in-text
                    :label="'Barang'"
                    :placeholder="'Pilih Barang'"
                    :col="6"
                    :name="'item_id'"
                    :required="true"></x-in-text>
                <x-in-text
                    :label="'Jumlah'"
                    :placeholder="'Masukkan Jumlah'"
                    :col="6"
                    :name="'amount'"
                    :required="true"></x-in-text>
                <x-in-text
                    :label="'Penerima'"
                    :placeholder="'Masukkan Nama Penerima'"
                    :col="6"
                    :name="'reciever'"
                    :required="true"></x-in-text>
                <x-in-text
                    :label="'Jabatan'"
                    :placeholder="'Masukkan Jabatan'"
                    :col="6"
                    :name="'role'"
                    :required="true"></x-in-text>
                <x-in-text
                    :label="'Catatan'"
                    :placeholder="'Masukkan catatan'"
                    :col="12"
                    :name="'notes'"
                    :required="true"></x-in-text>
            </x-row>

            <x-col class="text-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </x-col>
        </form>
    </x-modal>
@endsection

@push('js')
    <input type="hidden" id="url-items" value="{{ route('select2.items') }}">
    <input type="hidden" id="stock_id" value="{{ app('request')->input('stock_id') }}">
    <input type="hidden" id="status" value="0">

    <script>
        $(function() {
        // fetch with fetch api and send with query params
        fetch($('#url-items').val() + '?stock_id=' + $('#stock_id').val() + '&status=')
            .then(response => response.json())
            .then(data => {
                let x = $.map(data, function (obj) {
                    return {
                        id: obj.id,
                        text: [obj.ukuran, obj.name, obj.amount].join(' - ')
                    };
                });

                $('#item_id').select2({
                    theme: 'bootstrap4',
                    allowClear: true,
                    placeholder: {
                        id: '',
                        text: 'Pilih Barang'
                    },
                    data: x
                });
            }).catch(error => {
                console.log(error);
            });
        });
    </script>
@endpush
