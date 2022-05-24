@extends('hostel_theme.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="text-center">Leave Request</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('flash::message')        
        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'leaves.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('leaves.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('leaves.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
