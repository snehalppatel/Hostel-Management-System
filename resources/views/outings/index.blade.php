@extends('hostel_theme.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-11">
                    <h1 class="text-center">Outing Details</h1>
                </div>
                @if(isStudent())
                <div class="col-sm-1" style="text-align:right; margin-top: 0.3rem !important;">
                    <a class="btn btn-primary float-right"
                       href="{{ route('outings.create') }}">
                        Add New
                    </a>
                </div>
                @endif
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')
        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('outings.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

