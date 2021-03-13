@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Contacts</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             Contacts
                             <div class="pull-right">
                                 <a class="btn btn-info text-white" href="{{ route('admin.contacts.index', ['view_read_messages' => 1]) }}"><i class="fa fa-eye fa-lg"></i> View Read Messages</a>
                                 @if(request()->has('view_read_messages'))
                                     <a href="{{ route('admin.contacts.index') }}">cancel</a>
                                 @endif
                             </div>
                             </div>
                         <div class="card-body">
                             @if(count($contacts) > 0)
                                @include('admin.contacts.table')
                             @else
                                 <div class="alert alert-info">
                                     There are no mails.
                                 </div>
                             @endif
                              <div class="pull-right mr-3">

                              </div>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

