@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Newsletters</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <div class="d-flex align-items-center">
                                 <i class="fa fa-align-justify mr-2 mb-1"></i>
                                 <h4>Newsletters</h4>
                             </div>
{{--                             <a class="pull-right" href="{{ route('admin.newsletters.create') }}"><i class="fa fa-plus-square fa-lg"></i></a>--}}
                         </div>
                         <div class="card-body">
                             @if(count($newsletters) > 0)
                                @include('admin.newsletters.table')
                             @else
                                 <div class="alert alert-info">
                                     There are no newsletter.
                                 </div>
                             @endif
                              <div class="pull-right mr-3">

                              </div>
                         </div>
                         <div class="card-footer">
                             {!! $newsletters->links() !!}
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

