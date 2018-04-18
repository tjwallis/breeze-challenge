@extends( 'layout' )

@section( 'content' )
        <div class="row">
            <div class="col">
                <div class="card bg-light" id="csv_panel">
                    <div class="card-header">CSV Import</div>
                    <div class="card-body">

@if($errors)
   @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
  @endforeach
@endif

                        <form id="import_csv" class="form-horizontal" method="POST" action="{{ route('handle_import_form') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                                <div class="input-group mb-3">
                                  <div class="custom-file">
                                    <input id="csv_file" type="file" class="custom-file-input" name="csv_file" required>
<label class="custom-file-label" for="csv_file">Choose file</label>
                                  </div>
                                    @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="has_header" name="has_header" checked>                      
                              <label class="form-check-label" for="has_header">File contains header row? </label>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Import CSV
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
