<div class="table-responsive">
    <table class="table" id="wardens-table">
        <thead>
        <tr>
            <th>First Name</th>
        <th>Last Name</th>
        <th>Phone</th>
        <th>Email Verified At</th>
        <th>Password</th>
        <th>Email</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($wardens as $warden)
            <tr>
                <td>{{ $warden->first_name }}</td>
            <td>{{ $warden->last_name }}</td>
            <td>{{ $warden->phone }}</td>
            <td>{{ $warden->email_verified_at }}</td>
            <td>{{ $warden->password }}</td>
            <td>{{ $warden->email }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['wardens.destroy', $warden->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('wardens.show', [$warden->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('wardens.edit', [$warden->id]) }}"
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
