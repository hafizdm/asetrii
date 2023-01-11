@extends ('App')

@section('content-header')

@section('content')
<x-content>
    <x-row>
        <x-card-collapsible>
          <form action="{{route('upload.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ app('request')->loan_record_id }}" name="loan_record_id">
            <div class="form-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="customFile" name="upload_file">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
              </div>
           
            {{-- <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name="upload_file">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                  </div>
                </div>
              </div> --}}
            
            <button class="btn btn-primary">Save</button>
          </form>
        </x-card-collapsible>
    </x-row>
</x-content>
@endsection
