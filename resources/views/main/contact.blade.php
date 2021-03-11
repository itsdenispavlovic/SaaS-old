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
                            <h2 class="section-title ">Contact Form</h2>
                            <p class="section-desc mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, do
                                eius
                                mod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad min im
                                veniam, quis nostrud exercitati ullamco laboris nisi ut aliquip ex ea
                                commodo consequat.</p>
                        </div>
                        <div class="col-lg-12">
                            <div class="contact-item">
                                <h6>Phone Number</h6>
                                <p class="contact-item-info">+212 6 46 05 26 56</p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="contact-item">
                                <h6>Email Adress</h6>
                                <p class="contact-item-info">creabik@gmail.com</p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="contact-item">
                                <h6>Local Adress</h6>
                                <p class="contact-item-info">Morocco, Casablanca, Mohammedia, 72</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form class="contact-form">
                        <div class="form-group">
                            <label>How can I help you?</label>
                            <select required="" name="service-requested" class="form-control has-style1 " id="service">
                                <option value="">Select</option>
                                <option value="Logo Design">Logo Design</option>
                                <option value="Sound Branding">Sound Branding</option>
                                <option value="Front-End Development">Front-End Development</option>
                                <option value="Marketing Digital">Marketing Digital</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Your Name</label>
                            <input name="email" placeholder="ayoub " class="form-control has-style1" id="how"
                                   type="text">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" placeholder=" example@mail.com" class="form-control has-style1" id="how"
                                   type="text">
                        </div>
                        <label>Tell me more about your project</label>
                        <textarea name="textarea" class="textarea has-style1" placeholder="How can we help?"></textarea>
                        <div class="form-group">
                            <button class="btn btn-primary btn-round">
                                <span> Send me → </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- =========================== section map -->

    <div class="section section-map is-sm">
        <div class="container">
            <div class="mapouter">
                <div class="gmap_canvas"><iframe width="100" height="500" id="gmap_canvas"
                                                 src="https://maps.google.com/maps?q=morocco%2C%20casablanca&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
                    <a href="https://www.utilitysavingexpert.com">utilitysavingexpert.com</a></div>
            </div>
        </div>
    </div>
@stop
