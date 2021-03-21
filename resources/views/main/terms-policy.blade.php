@extends('layouts._frontend')

@section('headerAddon')
    <div class="container">
        <div class="header-wrap pb-0">
            <h2 class="header-title  text-center" data-aos="fade-up" data-aos-delay="500"> {!! $node->name !!}
            </h2>
        </div>
    </div>
    <img class="shape" src="{{ asset('assets/images/others/shape2.svg') }}" alt="">
@stop

@section('content')
    <section class="section sm section-blog2 mt-0">
        <div class="container mb-3">
{{--            <img class="img-post" src="../assets/images/bg/header-2.png" alt="">--}}
            <div class="content-post">
                {!! str_replace("\$appName", config('app.name'), $node->content) !!}
            </div>
        </div>
    </section>
@stop
