@extends('App')

@php
    $roles = [
        ['value' => 'superadmin', 'text' => 'Super Admin'],
        ['value' => 'admin', 'text' => 'Admin'],
        ['value' => 'director', 'text' => 'Direktur'],
        ['value' => 'hrd', 'text' => 'Admin Hrd'],
    ];

    $accountId = Auth::user()->id;
@endphp

@section('content-header', 'Daftar Akun')

@section('content')
    <x-content>
        <x-row>
            <x-card-collapsible>
                <x-row>
                    <x-col class="mb-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-modal">Tambah</button>
                    </x-col>

                    <x-col>
                        <x-table :thead="['Nama', 'Jabatan', 'Role', 'Email', 'Username', 'Aksi']">
                            @foreach($data as $row)
                                @php
                                    $role = '';
                                    if($row->role == 'superadmin') $role = 'Super Admin';
                                    else if($row->role == 'admin') $role = 'Admin';
                                    else if($row->role == 'director') $role = 'Direktur';
                                    else if($row->role == 'hrd') $role = 'Admin Hrd';
                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->position }}</td>
                                    <td>{{ $role }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->username }}</td>
                                    <td>
                                        <a
                                            href="{{ route('account.show', $row->id) }}"
                                            class="btn btn-warning"
                                            title="Ubah"><i class="fas fa-pencil-alt"></i></a>

                                        @if($row->id != $accountId)
                                            <form style=" display:inline!important;" method="POST" action="{{ route('account.destroy', $row->id) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                type="submit"
                                                class="btn btn-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                                title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        @endif
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

    <x-modal :title="'Tambah Data'" :id="'add-modal'" :size="'lg'">
        <form style="width: 100%" action="{{ route('account.store') }}" method="POST">
            @csrf
            @method('POST')

            <x-row>
                <x-in-select
                    :label="'Role'"
                    :name="'role'"
                    :options="$roles"
                    :col="6"
                    :placeholder="'Pilih Role'"
                    :required="true"></x-in-select>
                <x-in-text
                    :label="'Nama'"
                    :placeholder="'Masukkan Nama'"
                    :col="6"
                    :name="'name'"
                    :required="true"></x-in-text>
                <x-in-text
                    :label="'Jabatan'"
                    :placeholder="'Masukkan Jabatan'"
                    :col="6"
                    :name="'position'"
                    :required="true"></x-in-text>
                <x-in-text
                    :label="'Email'"
                    :type="'email'"
                    :placeholder="'Masukkan Email'"
                    :col="6"
                    :name="'email'"
                    :required="true"></x-in-text>
                <x-in-text
                    :label="'Username'"
                    :placeholder="'Masukkan Username'"
                    :col="6"
                    :name="'username'"
                    :required="true"></x-in-text>
                <x-in-text
                    :label="'Password'"
                    :type="'password'"
                    :placeholder="'Masukkan Password'"
                    :col="6"
                    :name="'password'"
                    :required="true"></x-in-text>
                <x-in-text
                    :label="'Konfirmasi Password'"
                    :type="'password'"
                    :placeholder="'Masukkan Konfirmasi Password'"
                    :col="6"
                    :name="'password_confirmation'"
                    :required="true"></x-in-text>
            </x-row>

            <x-col class="text-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </x-col>
        </form>
    </x-modal>

@endsection
