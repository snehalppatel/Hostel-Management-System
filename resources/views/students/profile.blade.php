@extends('hostel_theme.master')

@section('title') 
    Update Profile
@parent
@section('header-title')
    Update Profile
@endsection
@stop 

@section('content')    
    <div class="py-80">
        <div class="header py-5">
            <h1 class="text-center">@yield('header-title','Dashboard')</h1>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 offset-lg-2">
                    @if (count($errors) > 0)
                         <div class = "alert alert-danger">
                            <ul>
                               @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                               @endforeach
                            </ul>
                         </div>
                      @endif
                    @include('notification')                                        
                    {!! Form::open(['route' => 'user.profile.update', 'files' => true]) !!}
                        <input type="hidden" name="type" value="personal_setting">
                        <div class="white-box rounded-3 mb-5">
                            <div class="mb-3">
                                <label class="form-label">First Name </label><input class="form-control" type="text" name="first_name" value="{{old('first_name',$user->first_name)}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last Name </label><input class="form-control" type="text" name="last_name" value="{{old('last_name',$user->last_name)}}">
                            </div>                            
                            <div class="mb-3"><label class="form-label">Phone</label><input class="form-control" type="text" name="phone" value="{{old('phone',$user->phone)}}"></div>
                            @if(isStudent())
                            <div class="mb-3">
                                <label class="form-label">Roll Number </label><input class="form-control" type="text" readonly value="{{$user->roll_number}}">
                            </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label">Email </label><input class="form-control" type="text" readonly value="{{$user->email}}">
                            </div>                            


                            <div>
                                <label class="form-label">Password</label><input class="form-control @error('password') is-invalid @enderror" type="password" name="password" autocomplete="off">
                            @error('password')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror                                
                            </div>
                            <div>
                                <label class="form-label">Confirm Password</label><input class="form-control" type="password" name="password_confirmation" autocomplete="off">
                            </div>                            
                        </div>
                        <div class="text-center">
                            <button class="btn btn-warning rounded-pill px-4 py-2" type="submit"><strong>Update</strong>
                            </button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection    
@push('js-stack')
    @if (Session::has('success'))
        <script type="text/javascript">
            $(document).ready(function(){
                    alert("Updates Saved!")
                // $("#access_lock_content").modal('show');
            });            
        </script>    
    @endif
@endpush