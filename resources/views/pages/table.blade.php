<div class="table-responsive">
    <table class="table" id="pages-table">
        <thead>
        <tr>
            <th>Title</th>
        <th>Slug</th>
        {{--<th>Description</th>--}}
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pages as $pages)
            <tr>
                <td>{{ $pages->title }}</td>
            <td>{{ $pages->slug }}</td>
            {{--<td>{!! $pages->description !!}</td>--}}
            <td>{{ $pages->status }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['pages.destroy', $pages->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('pages.show', [$pages->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('pages.edit', [$pages->id]) }}"
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
