@extends('App')

@section('content-header', 'Stock')

@section('content')
    <x-content>
        <x-row>
            <x-card-collapsible>
                <x-row>
                    <x-col class="mb-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-modal">Tambah</button>
                    </x-col>

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
                                        </form>
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
        <form style="width: 100%" action="{{ route('stock.store') }}" method="POST">
            @csrf
            @method('POST')
            <input type="hidden" name="type" value="{{ app('request')->input('type') }}">
            <x-row>
                <x-in-select
                    :label="'Divisi'"
                    :placeholder="'Pilih Divisi'"
                    :col="6"
                    :name="'division_id'"
                    :required="true"></x-in-select>
                <x-in-text
                    :label="'Nama Stock'"
                    :placeholder="'Masukkan Nama Stock'"
                    :col="6"
                    :name="'name'"
                    :required="true"></x-in-text>
                <x-in-text
                    :label="'Lokasi'"
                    :placeholder="'Masukkan Lokasi'"
                    :col="12"
                    :name="'location'"
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
    <input type="hidden" id="url-categories" value="{{ route('select2.categories') }}">

    <script>
        $(function() {
            $('#division_id').select2({
                theme: 'bootstrap4',
                allowClear: true,
                placeholder: {
                    id: '',
                    text: 'Pilih Divisi'
                },
                ajax: {
                    url: $('#url-categories').val(),
                    dataType: 'json',
                    delay: 500,
                    data: function (params) {
                        let query = {
                            category: 'divisions',
                            keyword: params.term
                        }

                        return query;
                    },
                    processResults: function (data) {
                        let x = $.map(data, function (obj) {
                            return {
                                id: obj.id,
                                text: [obj.ref_no, obj.name].join(' - ')
                            };
                        });

                        return {
                            results: x
                        };
                    },
                    cache: false
                }
            });

            // $('#division_id').select2({
            //     theme: 'bootstrap4',
            //     allowClear: true,
            //     placeholder: {
            //         id: '',
            //         text: 'Pilih Divisi'
            //     },
            //     ajax: {
            //         url: $('#url-divisions').val(),
            //         dataType: 'json',
            //         delay: 500,
            //         data: function (params) {
            //             let query = {
            //                 keyword: params.term
            //             }

            //             return query;
            //         },
            //         processResults: function (data) {
            //             data = $.map(data.data, function (obj) {
            //                 return {
            //                     id: obj.id,
            //                     text: [obj.ref_no, obj.name].join(' - ')
            //                 };
            //             });

            //             return {
            //                 results: data
            //             };
            //         },
            //         cache: false
            //     }
            // });

            $('#semester_id').select2({
                theme: 'bootstrap4',
                allowClear: true,
                placeholder: {
                    id: '',
                    text: 'Pilih Semester'
                },
                ajax: {
                    url: $('#url-categories').val(),
                    dataType: 'json',
                    delay: 500,
                    data: function (params) {
                        let query = {
                            category: 'semesters',
                            keyword: params.term
                        }

                        return query;
                    },
                    processResults: function (data) {
                        data = $.map(data.data, function (obj) {
                            return {
                                id: obj.id,
                                text: obj.label
                            };
                        });

                        return {
                            results: data
                        };
                    },
                    cache: false
                }
            });
        });
    </script>
@endpush