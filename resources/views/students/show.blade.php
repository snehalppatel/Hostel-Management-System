@extends('hostel_theme.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>My Profile Details</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content">
        <div class="card">
            <div class="card-body">

                    @include('students.show_fields')

            </div>
        </div>
    </div>
@endsection
