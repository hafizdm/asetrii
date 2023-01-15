@extends('App')

@section('content-header', 'Detail Item')

@section('content')
    <x-content>
        <x-row>
            <x-card-collapsible>
                <x-row>
                    <form style="width: 100%" action="{{ route('item.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <x-in-select
                            :label="'Pilih Jenis'"
                            :placeholder="'Pilih Jenis'"
                            :name="'kind_id'"
                            :value="$data->kind_id"
                            :required="true"></x-in-select>
                        <x-in-select
                            :label="'Pilih Merk'"
                            :placeholder="'Pilih Merk'"
                            :name="'merk_id'"
                            :value="$data->merk_id"
                            :required="true"></x-in-select>
                        <x-in-select
                            :label="'Pilih Satuan'"
                            :placeholder="'Pilih Satuan'"
                            :name="'unit_id'"
                            :value="$data->unit_id"
                            :required="true"></x-in-select>
                        <x-in-text
                            :label="'Nama'"
                            :placeholder="'Masukkan Nama'"
                            :name="'name'"
                            :value="$data->name"
                            :required="true"></x-in-text>
                         <x-in-text
                            :label="'Stock'"
                            :name="'countStock'"
                            :value="$data->countStock()"
                            :disabled="true"
                            :readonly="true"></x-in-text>
                            
                        <x-col class="text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </x-col>
                    </form>
                </x-row>
            </x-card-collapsible>
        </x-row>
    </x-content>
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

