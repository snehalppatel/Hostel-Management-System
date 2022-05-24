@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Pages</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'pages.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('pages.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('pages.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
@push('page_scripts')
<script>
  $('#title').change(function(e) {
    // console.log("working");
    $.get('{{ route('api.pages.check_slug') }}', 
      { 'title': $(this).val() }, 
      function(data) {
        $('#slug').val(data.slug);
        console.log(data.error);
        if(data.error ==null){            
            $('#error_message').html('');
        }else{
            $('#error_message').html(data.error)
        }
      }
    );
  });
</script>
@endpush
