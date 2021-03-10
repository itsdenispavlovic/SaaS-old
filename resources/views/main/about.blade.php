@extends('layouts._frontend')

@section('headerAddon')
    <div class="container">
        <div class="header-wrap">
            <h2 class="header-title" data-aos="fade-up" data-aos-delay="500">About Us</h2>
        </div>
    </div>
    <img class="shape" src="../assets/images/others/header-page.svg" alt="">
@stop

@section('content')
    <section class="section section-about section-counter">
        <div class="container">
            <div class="row counters flex center">
                <!-- ==== item -->
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="counter-item">
                        <h5 class="counter-number">+451 000</h5>
                        <p class="counter-name"> Clients </p>
                    </div>
                </div>
                <!-- ==== item -->
                <div class="col-lg-3  col-md-4 col-6">
                    <div class="counter-item">
                        <h5 class="counter-number">+9 500</h5>
                        <p class="counter-name"> jobs </p>
                    </div>
                </div>
                <!-- ==== item -->
                <div class="col-lg-3  col-md-4 col-6">
                    <div class="counter-item">
                        <h5 class="counter-number">+18 000</h5>
                        <p class="counter-name"> invester </p>
                    </div>
                </div>
                <!-- ==== item -->
                <div class="col-lg-3  col-md-4 col-6">
                    <div class="counter-item">
                        <h5 class="counter-number">+70</h5>
                        <p class="counter-name"> worker </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section is-sm section-about">
        <div class="container">
            <div class="row flex vcenter">
                <div class="col-lg-6">
                    <img class="about-img" src="../assets/images/bg/about-illustration2.svg" alt="">
                </div>
                <div class="col-lg-6">
                    <div class="section-head">
                        <h5 class="section-subtitle "> What We Do Best </h5>
                        <h2 class="section-title ">Create Your Own
                            Web Masterpiece</h2>
                        <p class="section-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, do eius mod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad min im
                            veniam, quis nostrud exercitati ullamco laboris nisi ut aliquip ex ea
                            commodo consequat.</p>
                        <a href="#" class="btn btn-primary btn-round">See our stadies</a>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <!-- =========================== section feautures-->
    <section class="section is-sm section-grey">
        <div class="container">
            <div class="lines">
                <img src="../assets/images/others/lines.svg" alt="">
            </div>
            <div class="section-head flex between vcenter wrap">
                <h2 class="section-title ">We've done a lot's,
                    let's check some</h2>
                <a class="btn btn-dark btn-round text-white sm-hidden"> check services </a>
            </div>
            <div class="boxes">
                <div class="row min-30">
                    <div class="col-lg-4 col-md-6">
                        <div class="box has-secondary-bg has-left-icon">
                            <div class="box-particles2">
                                <img src="../assets/images/others/box-particle-2.svg" alt="">
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <div class="box-icon">
                                        <ion-icon name="compass"></ion-icon>
                                    </div>
                                </div>
                                <div class="col">
                                    <h3 class="box-title"> Check website's</h3>
                                    <p class="box-desc">Keep track of all the important KPIs in your organization across
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="box has-shadow has-left-icon">
                            <div class="box-particles2">
                                <img src="../assets/images/others/box-particle-2.svg" alt="">
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <div class="box-icon">
                                        <ion-icon name="cog"></ion-icon>
                                    </div>
                                </div>
                                <div class="col">
                                    <h3 class="box-title">Optimal Choice</h3>
                                    <p class="box-desc">Keep track of all the important KPIs in your organization across
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="box has-secondary-bg has-left-icon">
                            <div class="box-particles2">
                                <img src="../assets/images/others/box-particle-2.svg" alt="">
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <div class="box-icon">
                                        <ion-icon name="brush"></ion-icon>
                                    </div>
                                </div>
                                <div class="col">
                                    <h3 class="box-title"> Design</h3>
                                    <p class="box-desc">Keep track of all the important KPIs in your organization across
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="box has-shadow has-left-icon">
                            <div class="box-particles2">
                                <img src="../assets/images/others/box-particle-2.svg" alt="">
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <div class="box-icon">
                                        <ion-icon name="planet"></ion-icon>
                                    </div>
                                </div>
                                <div class="col">
                                    <h3 class="box-title"> Coding</h3>
                                    <p class="box-desc">Keep track of all the important KPIs in your organization across
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="box has-secondary-bg has-left-icon">
                            <div class="box-particles2">
                                <img src="../assets/images/others/box-particle-2.svg" alt="">
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <div class="box-icon">
                                        <ion-icon name="logo-slack"></ion-icon>
                                    </div>
                                </div>
                                <div class="col">
                                    <h3 class="box-title"> Marketing</h3>
                                    <p class="box-desc">Keep track of all the important KPIs in your organization across
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="box has-shadow has-left-icon">
                            <div class="box-particles2">
                                <img src="../assets/images/others/box-particle-2.svg" alt="">
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <div class="box-icon">
                                        <ion-icon name="archive"></ion-icon>
                                    </div>
                                </div>
                                <div class="col">
                                    <h3 class="box-title"> Testing sites</h3>
                                    <p class="box-desc">Keep track of all the important KPIs in your organization across
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- =========================== section team-->
    <section class="section is-lg section-team">
        <div class="container">
            <div class="section-head">
                <h5 class="section-subtitle is-center"> Meet our team</h5>
                <h2 class="section-title is-center ">We are a smart team of
                    leading digital</h2>
            </div>
            <div class="row min-30">
                <div class="col-lg-3 col-md-6">
                    <div class="team-box flex center">
                        <div class="team-thumb">
                            <img src="../assets/images/bg/member1.png" alt="">
                            <ul class="team-social flex center vcenter">
                                <li> <a href="#"> <i class="fab fa-twitter"></i></a> </li>
                                <li> <a href="#"> <i class="fab fa-facebook-f"></i></a> </li>
                                <li> <a href="#"> <i class="fab fa-quora"></i></a> </li>
                                <li> <a href="#"> <i class="fab fa-reddit"></i></a> </li>
                            </ul>
                        </div>
                        <h4 class="team-name">amira yerden</h4>
                        <p class="team-position">developper</p>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-box flex center">
                        <div class="team-thumb">
                            <img src="../assets/images/bg/member2.png" alt="">
                            <ul class="team-social flex center vcenter">
                                <li> <a href="#"> <i class="fab fa-twitter"></i></a> </li>
                                <li> <a href="#"> <i class="fab fa-facebook-f"></i></a> </li>
                                <li> <a href="#"> <i class="fab fa-quora"></i></a> </li>
                                <li> <a href="#"> <i class="fab fa-reddit"></i></a> </li>
                            </ul>
                        </div>
                        <h4 class="team-name">Mark linomi</h4>
                        <p class="team-position">developper</p>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-box flex center">
                        <div class="team-thumb">
                            <img src="../assets/images/bg/member3.png" alt="">
                            <ul class="team-social flex center vcenter">
                                <li> <a href="#"> <i class="fab fa-twitter"></i></a> </li>
                                <li> <a href="#"> <i class="fab fa-facebook-f"></i></a> </li>
                                <li> <a href="#"> <i class="fab fa-quora"></i></a> </li>
                                <li> <a href="#"> <i class="fab fa-reddit"></i></a> </li>
                            </ul>
                        </div>
                        <h4 class="team-name">ayoub fennouni</h4>
                        <p class="team-position">developper</p>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-box flex center">
                        <div class="team-thumb">

                            <img src="../assets/images/bg/member4.png" alt="">
                            <ul class="team-social flex center vcenter">
                                <li> <a href="#"> <i class="fab fa-twitter"></i></a> </li>
                                <li> <a href="#"> <i class="fab fa-facebook-f"></i></a> </li>
                                <li> <a href="#"> <i class="fab fa-quora"></i></a> </li>
                                <li> <a href="#"> <i class="fab fa-reddit"></i></a> </li>
                            </ul>
                        </div>
                        <h4 class="team-name">Marina mojo</h4>
                        <p class="team-position">developper</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
@stop
