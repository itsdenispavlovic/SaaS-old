@extends('layouts._simple')

@section('content')

    <!-- =========================== section contact -->
    <section class="section is-lg page-404 vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <img class="section-shape2" src="{{ asset('assets/images/others/404.svg') }}" alt="">

                    <h4 class="title">
                        sorry! Page not found
                    </h4>
                    <h2 class="fortyfor">
                        404
                    </h2>
                    <a href="/">back to home</a>
                </div>
            </div>
        </div>
    </section>
@stop
