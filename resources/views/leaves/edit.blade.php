@extends('hostel_theme.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @if(isWarden())
                    <h1 class="text-center">Edit Status for Leave</h1>
                    @else
                    <h1 class="text-center">Edit Leave Request</h1>
                    @endif

                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($leave, ['route' => ['leaves.update', $leave->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('leaves.edit_fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('leaves.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
