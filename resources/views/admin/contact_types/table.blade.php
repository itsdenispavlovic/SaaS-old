<div class="table-responsive-sm">
    <table class="table table-striped" id="contactTypes-table">
        <thead>
            <tr>
                <th>Name</th>
                <th class="text-center">Active</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($contactTypes as $contactType)
            <tr>
                <td>{{ $contactType->name }}</td>
                <td class="text-center">
                    <i class="fa fa-{{ ($contactType->active) ? 'check-circle' : 'minus-circle' }}"></i>
                </td>
                <td>
                    {!! Form::open(['route' => ['admin.contactTypes.destroy', $contactType->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('admin.contactTypes.show', [$contactType->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.contactTypes.edit', [$contactType->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
