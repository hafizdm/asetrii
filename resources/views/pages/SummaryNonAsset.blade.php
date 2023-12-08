@extends('App')

@php
    $stockCategoryId = app('request')->input('stock_id');

    $stockCategory = \App\Models\Stock::find($stockCategoryId);
@endphp

@section('content-header', 'Summary Inventory Barang:')


@section('content')
    {{-- {{ dd(App\Models\Item::all()) }} --}}
    <x-content>
        <x-row>
            <x-card-collapsible>
                <x-row>
                   
                    <div class="row g-3 align-items-center mb-3">
                        
                        <div class="col-auto">
                            <form action="{{ route('record-in.index')}}" method="GET">
                            <input type="hidden" name="stock_id" value="{{ app('request')->stock_id }}">
                            <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline" value="{{ app('request')->search }}">
                            </form>
                        </div>

                        <div>
                            <a href="#" class="btn btn-info" title="Cetak"><i class="fas fa-print"></i></a>
                        </div>
                    </div>

                    <x-col>
                        <x-table :thead="['Tanggal', 'Jenis', 'Merk', 'Nama Barang', 'Ukuran', 'Stock Sebelumnya', 'Barang Masuk', 'Barang Keluar', 'Total Stok' ]">
                            @foreach($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->date}}</td>
                                    <td>{{ $row->kind_name}}</td>
                                    <td>{{ $row->merk_name}}</td>
                                    <td>{{ $row->item_name}}</td>
                                    <td>{{ $row->ukuran}}</td>
                                    <td>{{ $row->last_stock}}</td>
                                    <td>{{ $row->in}}</td>
                                    <td>{{ $row->out}}</td>
                                    <td>{{ $row->current_stock}}</td>   
                                </tr>
                            @endforeach
                        </x-table>
                    </x-col>

                    <x-col class="d-flex justify-content-end">
                        
                    </x-col>
                </x-row>
            </x-card-collapsible>
        </x-row>
    </x-content>

 
@endsection
