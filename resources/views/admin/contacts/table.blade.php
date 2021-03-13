<div class="table-responsive-sm">
    <table class="table table-striped" id="contacts-table">
        <thead>
            <tr>
                <th>Reason</th>
                <th>Name</th>
                <th>Email</th>
                <th>Content</th>
                <th class="text-center">Have Read</th>
                <th colspan="3" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
            <tr id="row{{ $contact->id }}">
                <td>{{ $contact->reason }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->content }}</td>
                <td class="text-center">
                    <a href='#menu' data-rel="{{ $contact->id }}" class='mb-1 togglepublish fa fa-{{ ($contact->have_read == 1 ? "check-circle" : "minus-circle") }}'></a>
                </td>
                <td class="text-center">
{{--                    {!! Form::open(['route' => ['admin.contacts.destroy', $contact->id], 'method' => 'delete']) !!}--}}
                    <div class='btn-group'>
                        <a href="{{ route('admin.contacts.show', [$contact->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.contacts.edit', [$contact->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
{{--                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                    </div>
{{--                    {!! Form::close() !!}--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
        $('.togglepublish').click(function()
        {
            var id = $(this).attr("data-rel");
            var row = $('#row' + id);


            var stat = ($(this).hasClass("fa-check-circle") ? 0 : 1);
            var $a = $(this);

            jQuery.get('/admin/contacts/toggle', {
                    id: id,
                    status: stat,
                    field: 'have_read',
                    _token: $('meta[name=_token]').attr('content')
                },
                function(data, textStatus, xhr)
                {
                    if (data.status === "ok")
                    {
                        row.remove();
                        $a.removeClass((stat === 0 ? "fa-check-circle" : "fa-minus-circle"));
                        $a.addClass((stat === 1 ? "fa-check-circle" : "fa-minus-circle"));
                    }
                });

            return false;
        });
    </script>
@endpush
