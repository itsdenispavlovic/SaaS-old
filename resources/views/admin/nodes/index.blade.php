@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Nodes</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             Nodes
                             <a class="pull-right" href="{{ route('admin.nodes.create', ['parent' => request()->get('parent')]) }}"><i class="fa fa-plus-square fa-lg"></i></a>
                         </div>
                         <div class="card-body">
                             @include('admin.nodes.table')
                              <div class="pull-right mr-3">

                              </div>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            $("#nodes-table").tableDnD({
                onDrop: function(table, row)
                {
                    var pos = 1;
                    var rows = table.tBodies[0].rows;
                    /*
                    for (var i = 0; i < rows.length; i++)
                        if (rows[i].id != '')
                            $('#' + rows[i].id.replace('row', 'position')).val(pos++);
                    */
                    $.ajax({
                        url: "/admin/nodes/reorder",
                        data: $.tableDnD.serialize() + '&class=nodes&dataset=nodes-table&_token=' + $('meta[name=_token]').attr('content'),
                        type: 'POST',
                        success: function() {}
                    });
                }
            });
        })
    </script>
@endpush
