@extends('App')

@php
    $categoryName = '';
    $categoryGroup = '';

    $categories = [
        ['group_by' => 'kinds', 'label' => 'Jenis', 'icon' => 'fas fa-newspaper'],
        ['group_by' => 'merks', 'label' => 'Merk', 'icon' => 'fas fa-newspaper'],
        ['group_by' => 'units', 'label' => 'Satuan', 'icon' => 'fas fa-newspaper'],
        ['group_by' => 'divisions', 'label' => 'Divisi', 'icon' => 'fas fa-newspaper'],
    ];

    foreach ($categories as $category) {
        if ($category['group_by'] == app('request')->input('category')) {
            $categoryName = $category['label'];
            $categoryGroup = $category['group_by'];
            break;
        }
    }

    if($categoryGroup === 'merks') {
        $optionKinds = [];
        $kinds = App\Models\Category::where('group_by', 'kinds')->get()->toArray() ?? [];

        foreach ($kinds as $kind) {
            $optionKinds[] = [
                'value' => $kind['id'],
                'text' => $kind['label'],
            ];
        }
    }
@endphp

@section('content-header', 'Kategori - ' . $categoryName)

@section('content')
    <x-content>
        <x-row>
            <x-card-collapsible>
                <x-row>
                    <x-col class="mb-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-modal">Tambah</button>
                    </x-col>

                    <x-col>
                        @if($categoryGroup == 'merks')
                            <x-table :thead="['Jenis', 'Nama', 'Catatan', 'Aksi']">
                                @foreach($data as $index => $row)
                                    <tr>
                                        <td scope="row">{{ $index + $data->firstItem() }}</td>
                                        <td>{{ $row->parent->label }}</td>
                                        <td>{{ $row->label }}</td>
                                        <td>{{ $row->notes }}</td>
                                        <td>
                                            <a
                                                href="{{ route('category.show', $row->id) }}"
                                                class="btn btn-warning"
                                                title="Ubah"><i class="fas fa-pencil-alt"></i></a>

                                            <form style=" display:inline!important;" method="POST" action="{{ route('category.destroy', $row->id) }}">
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
                        @else
                            <x-table :thead="['Nama', 'Catatan', 'Aksi']">
                                @foreach($data as $index => $row)
                                    <tr>
                                        <td scope="row">{{ $index + $data->firstItem() }}</td>
                                        <td>{{ $row->label }}</td>
                                        <td>{{ $row->notes }}</td>
                                        <td>
                                            <a
                                                href="{{ route('category.show', $row->id) }}"
                                                class="btn btn-warning"
                                                title="Ubah"><i class="fas fa-pencil-alt"></i></a>

                                            <form style=" display:inline!important;" method="POST" action="{{ route('category.destroy', $row->id) }}">
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
                        @endif
                    </x-col>

                    <x-col class="d-flex justify-content-end">
                        {{ $data->links() }}
                    </x-col>
                </x-row>
            </x-card-collapsible>
        </x-row>
    </x-content>

    <x-modal :title="'Tambah Data'" :id="'add-modal'" :size="'lg'">
        <form style="width: 100%" action="{{ route('category.store') }}" method="POST">
            @csrf
            @method('POST')

            <x-row>
                <input type="hidden" name="group_by" value="{{ app('request')->input('category') }}">
                @if($categoryGroup == 'merks')
                    <x-in-select
                        :label="'Jenis'"
                        :name="'category_id'"
                        :options="$optionKinds"
                        :placeholder="'Pilih Jenis'"
                        :required="true">
                    </x-in-select>
                @endif
                <x-in-text
                    :label="'Nama'"
                    :placeholder="'Masukkan Nama kategori'"
                    :col="6"
                    :name="'label'"
                    :required="true">
                </x-in-text>
                <x-in-text
                    :label="'Catatan'"
                    :placeholder="'Masukkan Catatan'"
                    :col="6"
                    :name="'notes'"
                    :required="true">
                </x-in-text>
            </x-row>

            <x-col class="text-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </x-col>
        </form>
    </x-modal>

@endsection