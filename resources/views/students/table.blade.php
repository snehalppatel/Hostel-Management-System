<div class="table-responsive">
    <table class="table" id="students-table">
        <thead>
        <tr>
            <th>#</th>
        <th>Roll Number</th>
            <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Type</th>
        <!-- <th>Pin</th> -->
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $key => $student)
            <tr>
                <td>{{$key+1}}</td>
            <td>{{ ($student->roll_number !=null)?$student->roll_number:'-' }}</td>
                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phone }}</td>

            <td>{{ $student->type }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['students.destroy', $student->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('students.edit', [$student->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
