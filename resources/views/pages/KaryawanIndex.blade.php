@extends ('App')

@section('content-header')

    @section('content')

    <x-content>
        <x-row>
            <x-card-collapsible>
                <x-row>
                    <div class="container">
                        <button type="button" class="btn btn-primary">Tambah Karyawan</button>
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <th scope="col">#</th>                                
                                    <th scope="col">Nik</th>                                
                                    <th scope="col">Nama Pegawai</th>                                
                                    <th scope="col">Alamat</th>                                
                                    <th scope="col">Email</th>                                
                                    <th scope="col">No Handphone</th>                                
                                    <th scope="col">Agama</th>                                
                                    <th scope="col">jabatan</th>                                
                                    <th scope="col">Divisi</th>                                
                                </thead>

                                <tbody>
                                    <tr>
                                        <th></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                  
                </x-row>
            </x-card-collapsible>
        </x-row>
    </x-content>




    @endsection

@endsection
