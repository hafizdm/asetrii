@extends('App')

@php
    $categories = [
        ['group_by' => 'kinds', 'label' => 'Jenis', 'icon' => 'fas fa-newspaper'],
        ['group_by' => 'merks', 'label' => 'Merk', 'icon' => 'fas fa-newspaper'],
        ['group_by' => 'units', 'label' => 'Satuan', 'icon' => 'fas fa-newspaper'],
        ['group_by' => 'divisions', 'label' => 'Divisi', 'icon' => 'fas fa-newspaper'],
    ];

    $no = 1;
@endphp

@section('content-header', 'Daftar Kategori')

@section('content')
    <x-content>
        <x-row>
            <x-card-collapsible>
                <x-row>
                    <x-col>
                        <x-table :thead="['Kategori']">
                            @foreach($categories as $data)
                                @if(Auth::user()->role == 'admin')
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <a
                                                href="{{ route('category.index', ['category' => $data['group_by']]) }}">
                                                <i class="{{ $data['icon'] }}"></i> {{ $data['label'] }}
                                                </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </x-table>
                    </x-col>
                </x-row>
            </x-card-collapsible>
        </x-row>
    </x-content>
@endsection