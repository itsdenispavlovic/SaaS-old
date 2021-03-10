<div class="table-responsive-sm">
    <table class="table table-striped" id="newsletters-table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th colspan="3" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($newsletters as $newsletter)
            <tr>
                <td>
                    {{ (!empty($newsletter->first_name) ? $newsletter->first_name : '-') }}
                </td>
                <td>
                    {{ (!empty($newsletter->last_name) ? $newsletter->last_name : '-') }}
                </td>
                <td>{{ $newsletter->email }}</td>
                <td class="text-center">
                    {!! Form::open(['route' => ['admin.newsletters.destroy', $newsletter->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('admin.newsletters.show', [$newsletter->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.newsletters.edit', [$newsletter->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
