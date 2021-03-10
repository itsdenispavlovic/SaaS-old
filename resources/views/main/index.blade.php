@extends('layouts._frontend')

{{-- Create an if --}}
@section('headerAddon')
    <div class="container">
        <div class="header-wrap">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="header-title" data-aos="fade-up" data-aos-delay="500">We Build Teams That
                        Build Your Software</h2>
                    <p class="header-desc" data-aos="fade-up" data-aos-delay="600">Behind the word mountains, far
                        from
                        the countries Vokalia and Conson antiaaa,
                        there
                        seedBehind the word mountains, far from the countries Vokalia and Conson antia, there seed
                    </p>
                    <a href="#" class="btn btn-green btn-round" data-aos="fade-up" data-aos-delay="700">Let's Get
                        Started<ion-icon name="arrow-forward"></ion-icon></a>
                </div>
                <div class="col-lg-6">
                    <div class="header-img">
                        <img data-aos="fade-left" data-aos-delay="700" src="../assets/images/others/hero-grad.svg"
                             alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@section('content')

    @foreach ($sections as $section)
        @includeIf($section->property("section"))
    @endforeach
{{--    @include('sections.features')--}}

{{--    @include('sections.about-img-right')--}}

{{--    @include('sections.services')--}}

{{--    @include('sections.about-img-left')--}}

    @include('sections.testimonial')
@stop
