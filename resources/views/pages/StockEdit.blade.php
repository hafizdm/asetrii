    @extends ('App')

@section('content-header')

    @section('content')

    <x-content>
        <x-row>
            <x-card-collapsible>
                <x-row>

                    <x-col>
                        <form action="{{ route('stock.update') }}" method="POST">
                            @csrf
                            @method('patch')
                            <input type="hidden" value="{{ $data->id }}" name="id">
                            <div class="car-body">
                                <h1 class="mb-5">Edit Stock Asset</h1>
                                <input type="hidden" name="stock_id" value="{{ app('request')->stock_id }}">
                                <div class="form-group col-sm-12">
                                    <label for="label">Nama Stock</label>
                                    <div class="input-group">  
                                        <input type="text" class="form-control" value="{{ $data->name }}" name="name">
                                    </div>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="label">Divisi</label>
                                    <div class="input-group">  
                                        <select name="division_id" class="form-control" >
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">
                                                {{ $division->label }}
                                            </option>
                                        @endforeach    
                                        </select>
                                    </div>
                                </div>
                                

                                <div class="form-group col-sm-12">
                                    <label for="label">Location</label>
                                    <div class="input-group">  
                                        <input type="text" class="form-control" value="{{ $data->location }}" name="location">
                                    </div>
                                </div>


                                <div class="input-group mb-3">
                                    <button class="btn btn-primary col-md-2" type="submit">
                                        Ubah Data <i class="fa fa-"></i>
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
