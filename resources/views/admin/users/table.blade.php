<div class="table-responsive-sm">
    <table class="table table-striped" id="users-table">
        <thead>
            <tr>
                <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Type</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->type }}</td>
                <td>
                    @if($user->id != auth()->id())
                        {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'delete']) !!}
                    @endif
                    <div class='btn-group'>
                        <a href="{{ route('admin.users.show', [$user->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.users.edit', [$user->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', ($user->id == auth()->id() ? 'disabled' : ''), 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    @if($user->id != auth()->id())
                        {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
