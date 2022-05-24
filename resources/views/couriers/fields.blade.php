<!-- Name Field -->
</div>
<div class="row">
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Roll Number Field -->
<div class="form-group col-sm-4">
    {!! Form::label('roll_number', 'ID / Roll Number:') !!}
    {!! Form::text('roll_number', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::text('date', null, ['class' => 'form-control','id'=>'date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date').datetimepicker({
            format: 'DD-MM-YYYY',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush
</div>
<!-- Hostel Name Field -->
<div class="row">
<div class="form-group col-sm-4">
    {!! Form::label('hostel_name', 'Hostel Name:') !!}<Br>
    <label><input type="radio" name="hostel_name" value="Hostel 1" {{(isset($courier) && $courier->hostel_name == 'Hostel 1')?'checked':'checked'}}> Hostel 1</label>&nbsp;&nbsp;&nbsp;<Br>
    <label><input type="radio" name="hostel_name" value="Hostel 2" {{(isset($courier) && $courier->hostel_name == 'Hostel 2')?'checked':null}}> Hostel 2</label>&nbsp;&nbsp;&nbsp;<Br>
    <label><input type="radio" name="hostel_name" value="Hostel 3" {{(isset($courier) && $courier->hostel_name == 'Hostel 3')?'checked':null}}> Hostel 3</label>&nbsp;&nbsp;&nbsp;       
</div>

<div class="form-group col-sm-4">
    {!! Form::label('order_type', 'Order Type:') !!}<Br>
    <label><input type="radio" name="order_type" value="Amazone" {{(isset($courier) && $courier->order_type == 'Amazone')?'checked':'checked'}}> Amazone</label>&nbsp;&nbsp;&nbsp;<Br>
    <label><input type="radio" name="order_type" value="Flipkart" {{(isset($courier) && $courier->order_type == 'Flipkart')?'checked':null}}> Flipkart</label>&nbsp;&nbsp;&nbsp;<Br>
    <label><input type="radio" name="order_type" value="Others" {{(isset($courier) && $courier->order_type == 'Others')?'checked':null}}> Others</label>&nbsp;&nbsp;&nbsp;       
</div>