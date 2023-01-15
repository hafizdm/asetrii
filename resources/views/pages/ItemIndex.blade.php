@extends('App')

@php
    $stockId = app('request')->input('stock_id'); // mencari nilai stock_id yang berada di url
    $stock = \App\Models\Stock::find($stockId); // mencari data stock berdasarkan id
    $header = $stock->type == 'asset' ? 'Daftar Asset' : 'Daftar Non-Asset'; // menentukan header yang akan ditampilkan
    $header .= ' : ' . $stock->name; // menambahkan nama stock ke header
@endphp

@section('content-header', $header)

@section('content')
    <x-content>
        <x-row>
            <x-card-collapsible>
                <x-row>
                    <x-col class="mb-3">
                    @if(Auth::user()->role == 'admin')
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-modal">Tambah</button>
                    @endif

                    @if($stock->type == 'asset')
                        <a href="{{ route('item.exports') . '?stock_id=' .  $stockId }}" target="_blank" class="btn btn-info">Export PDF</a>
                    @endif

                    @if($stock->type == 'non-asset')
                    <a href="{{ route('item-non.exports') . '?stock_id=' .  $stockId }}" target="_blank" class="btn btn-info">Export PDF</a>
                    @endif

                    </x-col>



                    {{-- Index View untuk asset --}}
                    @if($stock->type == 'asset')
                        <x-col>
                            <x-table :thead="['Code', 'Jenis', 'Merk', 'Nama Barang', 'Satuan', 'Status', 'Aksi']">
                                @foreach($data as $index => $row)
                                    <tr>
                                        <td scope="row">{{ $index + $data->firstItem() }}</td>
                                        <td>{{ $row->code }}</td>
                                        <td>{{ $row->kind->label }}</td>
                                        <td>{{ $row->merk->label }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->unit->label }}</td>
                                        <td>{{ $row->status == 1 ? "Tersedia" : "Tidak tersedia" }}</td>
                                        
                                        @if(Auth::user()->role == 'admin')
                                        <td>
                                            <a
                                                href="{{ route('item.update', $row->id) }}"
                                                class="btn btn-warning"
                                                title="Ubah"><i class="fas fa-pencil-alt"></i></a>

                                            <form style=" display:inline!important;" method="POST" action="{{ route('item.destroy', $row->id) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                                    title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                        @endif

                                    </tr>
                                @endforeach
                            </x-table>
                            {{ $data->links()}}
                        </x-col>
                    @endif

                    {{-- index View untuk non-asset --}}
                    @if($stock->type == 'non-asset')
                        <x-col>
                            <x-table :thead="['Jenis', 'Merk', 'Nama Barang', 'Stok', 'Ukuran', 'Satuan', 'Aksi']">
                                @foreach($data as $index => $row)
                                    <tr>
                                        <td scope="row">{{ $index + $data->firstItem() }}</td>
                                        <td>{{ $row->kind->label }}</td>
                                        <td>{{ $row->merk->label }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->countStock() }}</td>
                                        <td>{{ $row->ukuran }}</td>
                                        <td>{{ $row->unit->label }}</td>
                                        <td>
                                            <a
                                                href="{{ route('item-noasset.show', $row->id) }}"
                                                class="btn btn-warning"
                                                title="Ubah"><i class="fas fa-pencil-alt"></i></a>

                                            <form style=" display:inline!important;" method="POST" action="{{ route('item.destroy', $row->id) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                                    title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-table>
                            {{ $data->links() }}
                        </x-col>
                    @endif

                    <x-col class="d-flex justify-content-end">

                    </x-col>
                </x-row>
            </x-card-collapsible>
        </x-row>
    </x-content>

    {{-- modal tambah untuk asset --}}
    @if($stock->type == 'asset')
        <x-modal :title="'Tambah Data'" :id="'add-modal'" :size="'xl'">
            <form style="width: 100%" action="{{ route('item.store') }}" method="POST">
                @csrf
                @method('POST')

                <input type="hidden" name="stock_id" value="{{ app('request')->input('stock_id') }}">

                <x-row>
                    <x-in-select
                        :label="'Pilih Jenis'"
                        :placeholder="'Pilih Jenis'"
                        :col="6"
                        :name="'kind_id'"
                        :required="true"></x-in-select>
                    <x-in-select
                        :label="'Pilih Merk'"
                        :placeholder="'Pilih Merk'"
                        :col="6"
                        :name="'merk_id'"
                        :required="true"></x-in-select>
                    <x-in-select
                        :label="'Pilih Satuan'"
                        :placeholder="'Pilih Satuan'"
                        :col="6"
                        :name="'unit_id'"
                        :required="true"></x-in-select>
                    <x-in-text
                        :label="'Nama'"
                        :placeholder="'Masukkan Nama'"
                        :col="6"
                        :name="'name'"
                        :required="true"></x-in-text>
                    <x-in-text
                        :label="'Kode'"
                        :placeholder="'Masukkan Kode Barang'"
                        :col="6"
                        :name="'code'"
                        :required="true"></x-in-text>
                </x-row>

                <x-col class="text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </x-col>
            </form>
        </x-modal>
    @endif

    {{-- modal tambah untuk non asset --}}
    @if($stock->type == 'non-asset')
        <x-modal :title="'Tambah Data'" :id="'add-modal'" :size="'xl'">
            <form style="width: 100%" action="{{ route('item.store') }}" method="POST">
                @csrf
                @method('POST')

                <input type="hidden" name="stock_id" value="{{ app('request')->input('stock_id') }}">

                <x-row>
                    <x-in-select
                        :label="'Pilih Jenis'"
                        :placeholder="'Pilih Jenis'"
                        :col="6"
                        :name="'kind_id'"
                        :required="true"></x-in-select>
                    <x-in-select
                        :label="'Pilih Merk'"
                        :placeholder="'Pilih Merk'"
                        :col="6"
                        :name="'merk_id'"
                        :required="true"></x-in-select>
                    <x-in-select
                        :label="'Pilih Satuan'"
                        :placeholder="'Pilih Satuan'"
                        :col="6"
                        :name="'unit_id'"
                        :required="true"></x-in-select>
                    <x-in-text
                        :label="'Nama'"
                        :placeholder="'Masukkan Nama'"
                        :col="6"
                        :name="'name'"
                        :required="true"></x-in-text>
                    <x-in-text
                        :type="'number'"
                        :label="'Stock'"
                        :placeholder="'Jumlah Stock'"
                        :col="6"
                        :name="'amount'"
                        :required="true"></x-in-text>
                    <x-in-text
                        :label="'Ukuran Barang'"
                        :placeholder="'Masukkan Ukuran'"
                        :col="6"
                        :name="'ukuran'"
                        :required="true"></x-in-text>
                </x-row>

                <x-col class="text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </x-col>
            </form>
        </x-modal>
    @endif
@endsection

@push('js')
    <input type="hidden" id="url-categories" value="{{ route('select2.categories') }}">

    <script>
        $(function() {
            $('#kind_id').select2({
                theme: 'bootstrap4',
                allowClear: true,
                placeholder: {
                    id: '',
                    text: 'Pilih Jenis'
                },
                ajax: {
                    url: $('#url-categories').val(),
                    dataType: 'json',
                    delay: 500,
                    data: function (params) {
                        let query = {
                            category: 'kinds',
                            keyword: params.term
                        }

                        return query;
                    },
                    processResults: function (data) {
                        let x = $.map(data, function (obj) {
                            return {
                                id: obj.id,
                                text: obj.name
                            };
                        });

                        return {
                            results: x
                        };
                    },
                    cache: false
                }
            });

            $('#merk_id').select2({
                theme: 'bootstrap4',
                allowClear: true,
                placeholder: {
                    id: '',
                    text: 'Pilih Merk'
                },
                ajax: {
                    url: $('#url-categories').val(),
                    dataType: 'json',
                    delay: 500,
                    data: function (params) {
                        let query = {
                            category_id: $('#kind_id').val(),
                            category: 'merks',
                            keyword: params.term
                        }

                        return query;
                    },
                    processResults: function (data) {
                        let x = $.map(data, function (obj) {
                            return {
                                id: obj.id,
                                text: obj.name
                            };
                        });

                        return {
                            results: x
                        };
                    },
                    cache: false
                }
            });

            $('#unit_id').select2({
                theme: 'bootstrap4',
                allowClear: true,
                placeholder: {
                    id: '',
                    text: 'Pilih Satuan'
                },
                ajax: {
                    url: $('#url-categories').val(),
                    dataType: 'json',
                    delay: 500,
                    data: function (params) {
                        let query = {
                            category: 'units',
                            keyword: params.term
                        }

                        return query;
                    },
                    processResults: function (data) {
                        let x = $.map(data, function (obj) {
                            return {
                                id: obj.id,
                                text: obj.name
                            };
                        });

                        return {
                            results: x
                        };
                    },
                    cache: false
                }
            });

            // on change kind
            $('#kind_id').on('change', function() {
                $('#merk_id').val(null).trigger('change');
            });
        });
    </script>
@endpush

