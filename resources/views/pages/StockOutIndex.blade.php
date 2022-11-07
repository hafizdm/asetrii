@extends('App')

@section('content-header', 'Stock')

@section('content')
    <x-content>
        <x-row>
            <x-card-collapsible>
                <x-row>
                    <x-col>
                        <x-table :thead="['Nama Stok', 'Divisi', 'Responsible', 'Lokasi', 'Aksi']">
                            @foreach($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->division->label }}</td>
                                    <td>{{ $row->responsible->name }}</td>
                                    <td>{{ $row->location }}</td>
                                    <td>
                                        <a
                                            href="{{ route('record-out.index', ['stock_id' => $row->id]) }}"
                                            class="btn btn-primary"
                                            title="Detail Asset"><i class="fas fa-chalkboard"></i></a>
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
@endsection