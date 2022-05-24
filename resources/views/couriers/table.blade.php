<div class="table-responsive">
    <table class="table" id="couriers-table">
        <thead>
        <tr>
            <th>Name</th>
        <th>Id/Roll Number</th>
        <th>Date</th>
        <!-- <th>Security Id</th> -->
        <th>Hostel Name</th>
        <th>Type</th>
        @if(isSecurity())
            <th colspan="3">Action</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @if(count($couriers) > 0)
        @foreach($couriers as $courier)
            <tr>
                <td>{{ $courier->name }}</td>

            <td>{{ $courier->roll_number }}</td>
            <td>{{ \Carbon::parse($courier->date)->format('d-m-Y') }}</td>
            <!-- <td>{{ $courier->security_id }}</td> -->
            <td>{{ $courier->hostel_name }}</td>
                                            <td>{{ $courier->order_type }}</td>
            @if(isSecurity())
                <td width="120">
                    {!! Form::open(['route' => ['couriers.destroy', $courier->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
<!--                         <a href="{{ route('couriers.show', [$courier->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a> -->
                        <a href="{{ route('couriers.edit', [$courier->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
                @endif
            </tr>
        @endforeach
        @else
            <tr>
                <td colspan="5" style="text-align:center;"> No record found!</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
