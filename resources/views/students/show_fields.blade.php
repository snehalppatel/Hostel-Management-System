<div class="row">
<!-- Name Field -->
<div class="col-sm-4">
    {!! Form::label('name', 'Name:') !!}
   <p> {{ $student->first_name }} {{ $student->last_name }}</p>
</div>
@if(isStudent())
<div class="col-sm-4">
    {!! Form::label('Roll Number', 'Roll Number:') !!}
    <p>{{ $student->roll_number }}</p>
</div>
@endif
<!-- Email Field -->
<div class="col-sm-4">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $student->email }}</p>
</div>

</div>
<!-- Phone Field -->
<div class="row">
<!-- Phone Field -->
<div class="col-sm-4">
    {!! Form::label('phone', 'Phone:') !!}
    <p>{{ $student->phone }}</p>
</div>
</div>
<div class="row">
<!-- Created At Field -->
<div class="col-sm-4">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $student->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-4">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $student->updated_at }}</p>
</div>

</div>