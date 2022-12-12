@extends ('App')

@section('content-header')

    @section('content')

    <x-content>
        <x-row>
            <x-card-collapsible>
                <x-row>

                    <x-col>
                        <form action="/record-non-in-pertanggal" method="GET" target="_blank">
                            @csrf
                            <div class="car-body">
                                <h1 class="mb-5">CETAK PERTANGGAL</h1>
                                <div class="input-group mb-3">

                                    <label for="label">Tanggal Awal</label>
                                    <input type="date" name="tglawal" id="tglawal" class="form-control" />

                                </div>

                                <div class="input-group mb-3">
                                    <label for="label">Tanggal Akhir</label>
                                    <input type="date" name="tglakhir" id="tglakhir" class="form-control" />

                                </div>

                                <div class="input-group mb-3">
                                    <button class="btn btn-primary col-md-2" type="submit">
                                        Cetak Laporan <i class="fa fa-print"></i>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </x-col>


                </x-row>
            </x-card-collapsible>
        </x-row>
    </x-content>




    @endsection

@endsection
