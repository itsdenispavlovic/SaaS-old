@extends('layouts._frontend')

@section('content')
    <!-- =========================== section contact -->
    <section class="section is-sm section-contact">
        <img class="section-particle top-0" src="../assets/images/others/particle.svg" alt="">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class=" items-contact">
                        <div class="section-head">
                            <h2 class="section-title ">{{ $node->name }}</h2>
                            <p class="section-desc mb-0">{{ $node->short_description }}</p>
                        </div>
                        @foreach($node->subnodes as $subnode)
                            @if($subnode->published)
                                <div class="col-lg-12">
                                    <div class="contact-item">
                                        <h6>{{ $subnode->name }}</h6>
                                        <p class="contact-item-info">{{ $subnode->short_description }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">
                    @livewire('contact-form')
                </div>
            </div>
        </div>
    </section>
{{--    <!-- =========================== section map -->--}}

{{--    <div class="section section-map is-sm">--}}
{{--        <div class="container">--}}
{{--            <div class="mapouter">--}}
{{--                <div class="gmap_canvas"><iframe width="100" height="500" id="gmap_canvas"--}}
{{--                                                 src="https://maps.google.com/maps?q=morocco%2C%20casablanca&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>--}}
{{--                    <a href="https://www.utilitysavingexpert.com">utilitysavingexpert.com</a></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@stop
