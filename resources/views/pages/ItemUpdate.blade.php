@extends('App')

@section('content-header', 'Detail Account')

@section('content')
    <x-content>
        <x-row>
            <x-card-collapsible>
                <x-row>
                    <form style="width: 100%" action="{{ route('item.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <x-in-select
                            :label="'Role'"
                            :name="'role'"
                            :options="$roles"
                            :value="$data->role"
                            :placeholder="'Pilih Role'"
                            :required="true"></x-in-select>
                        <x-in-text
                            :label="'Nama'"
                            :placeholder="'Masukkan Nama'"
                            :name="'name'"
                            :value="$data->name"
                            :required="true"></x-in-text>
                        <x-in-text
                            :label="'Jabatan'"
                            :placeholder="'Masukkan Jabatan'"
                            :name="'position'"
                            :value="$data->name"
                            :required="true"></x-in-text>
                        <x-in-text
                            :label="'Email'"
                            :type="'email'"
                            :placeholder="'Masukkan Email'"
                            :name="'email'"
                            :value="$data->email"
                            :required="true"></x-in-text>
                        <x-in-text
                            :label="'Username'"
                            :placeholder="'Masukkan Username'"
                            :name="'username'"
                            :value="$data->username"
                            :required="true"></x-in-text>
                        <x-in-text
                            :label="'Password'"
                            :type="'password'"
                            :placeholder="'Masukkan Password'"
                            :name="'password'"></x-in-text>
                        <x-in-text
                            :label="'Konfirmasi Password'"
                            :type="'password'"
                            :placeholder="'Masukkan Konfirmasi Password'"
                            :name="'password_confirmation'"></x-in-text>

                        <x-col class="text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </x-col>
                    </form>
                </x-row>
            </x-card-collapsible>
        </x-row>
    </x-content>
@endsection
