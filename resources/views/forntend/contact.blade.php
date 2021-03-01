@extends('forntend.layouts.master')
<link rel="stylesheet" href="{{ asset('ecohost/contact/css/style.css') }}">
@section('content')


    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon_house_alt"></i> Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Contact Us</h2>
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p> -->
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">
                    <div class="wrapper">
                        <div class="row no-gutters">
                            <div class="col-md-7 d-flex align-items-stretch">
                                <div class="contact-wrap w-100 p-md-5 p-4">
                                    <h3 class="mb-4">Get in touch</h3>
                                    <div id="form-message-warning" class="mb-4"></div>

                                    <div class="row" >
                                        <div class="col-12">
                                            @include('layouts.flashmessages')
                                        </div>
                                    </div>

                                    <div id="form-message-success" class="mb-4">
                            Your message was sent, thank you!
                            </div>
                                    <form method="POST" id="contactForm" action="{{ route('save.contact.detail')  }}" name="contactForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                                </div>
                                                <div class="error" style="color: red; margin-bottom: 12px;" >{{ $errors->first('name') }}</div>
                                            </div>
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                                                </div>
                                                <div class="error" style="color: red; margin-bottom: 12px;" >{{ $errors->first('email') }}</div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="subject" class="form-control" name="subject" id="subject" placeholder="Subject">
                                                </div>
                                                <div class="error" style="color: red; margin-bottom: 12px;" >{{ $errors->first('subject') }}</div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea name="message" class="form-control" id="message" cols="30" rows="7" placeholder="Message"></textarea>
                                                </div>
                                                <div class="error" style="color: red; margin-bottom: 12px;" >{{ $errors->first('message') }}</div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="submit" value="Send Message" class="btn btn-primary">
                                                    <div class="submitting"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5 d-flex align-items-stretch">
                                <div class="info-wrap bg-primary w-100 p-lg-5 p-4">
                                    <h3 class="mb-4 mt-md-4">Contact us</h3>
                            <div class="dbox w-100 d-flex align-items-start">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-map-marker"></span>
                                </div>
                                <div class="text pl-3">
                                <p style="color: whitesmoke" ><span>Address:</span>{{ $contactDetails->address  }}</p>
                              </div>
                          </div>
                            <div class="dbox w-100 d-flex align-items-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-phone"></span>
                                </div>
                                <div class="text pl-3">
                                <p><span>Phone:</span> <a href="tel://{{ $contactDetails->phone  }}">{{ $contactDetails->phone  }}</a></p>
                              </div>
                          </div>
                            <div class="dbox w-100 d-flex align-items-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-paper-plane"></span>
                                </div>
                                <div class="text pl-3">
                                <p><span>Email:</span> <a href="mailto:{{ $contactDetails->email  }}">{{ $contactDetails->email  }}</a></p>
                              </div>
                          </div>
                            <div class="dbox w-100 d-flex align-items-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-globe"></span>
                                </div>
                                <div class="text pl-3">
                                <p><span>Website</span> <a href="{{ $contactDetails->website  }}" target="_blank" >{{ $contactDetails->website  }}</a></p>
                              </div>
                          </div>
                      </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Area Start -->
    <section class="hami-testimonial-area section-padding-0-100">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>What Clients Say?</h2>
                        <p>Our extensive expertise will make sure that yours is a SUCCESS STORY once again!</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-slide owl-carousel">

                        <!-- Single Testimonial Area -->
                        <div class="single-testimonial-area">
                            <div class="testimonial-content">
                                <!-- Ratings & Quote -->
                                <div class="ratings-icon d-flex align-items-center justify-content-between">
                                    <div class="rating">
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                    </div>
                                    <div class="quote-icon">
                                        <img src="{{ asset('ecohost/img/core-img/quote.png') }}" alt="">
                                    </div>
                                </div>
                                <h5>By switching to Hami Anycast DNS system we were able to decrease the worldwide app latency immensely.</h5>
                            </div>
                            <!-- Testimonial -->
                            <div class="testimonial-thumbnail-title d-flex align-items-center">
                                <div class="testimonial-thumbnail">
                                    <img src="{{ asset('ecohost/img/bg-img/10.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-title">
                                    <h5>Beatrice Vega</h5>
                                    <span>CEO DeerCreative</span>
                                </div>
                            </div>
                        </div>

                        <!-- Single Testimonial Area -->
                        <div class="single-testimonial-area">
                            <div class="testimonial-content">
                                <!-- Ratings & Quote -->
                                <div class="ratings-icon d-flex align-items-center justify-content-between">
                                    <div class="rating">
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                    </div>
                                    <div class="quote-icon">
                                        <img src="{{ asset('ecohost/img/core-img/quote.png') }}" alt="">
                                    </div>
                                </div>
                                <h5>By switching to Hami Anycast DNS system we were able to decrease the worldwide app latency immensely.</h5>
                            </div>
                            <!-- Testimonial -->
                            <div class="testimonial-thumbnail-title d-flex align-items-center">
                                <div class="testimonial-thumbnail">
                                    <img src="{{ asset('ecohost/img/bg-img/11.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-title">
                                    <h5>Roy Long</h5>
                                    <span>CEO Colorlib</span>
                                </div>
                            </div>
                        </div>

                        <!-- Single Testimonial Area -->
                        <div class="single-testimonial-area">
                            <div class="testimonial-content">
                                <!-- Ratings & Quote -->
                                <div class="ratings-icon d-flex align-items-center justify-content-between">
                                    <div class="rating">
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                    </div>
                                    <div class="quote-icon">
                                        <img src="{{ asset('ecohost/img/core-img/quote.png') }}" alt="">
                                    </div>
                                </div>
                                <h5>By switching to Hami Anycast DNS system we were able to decrease the worldwide app latency immensely.</h5>
                            </div>
                            <!-- Testimonial -->
                            <div class="testimonial-thumbnail-title d-flex align-items-center">
                                <div class="testimonial-thumbnail">
                                    <img src="{{ asset('ecohost/img/bg-img/12.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-title">
                                    <h5>Stephen Colon</h5>
                                    <span>CEO google</span>
                                </div>
                            </div>
                        </div>

                        <!-- Single Testimonial Area -->
                        <div class="single-testimonial-area">
                            <div class="testimonial-content">
                                <!-- Ratings & Quote -->
                                <div class="ratings-icon d-flex align-items-center justify-content-between">
                                    <div class="rating">
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                    </div>
                                    <div class="quote-icon">
                                        <img src="{{ asset('ecohost/img/core-img/quote.png') }}" alt="">
                                    </div>
                                </div>
                                <h5>By switching to Hami Anycast DNS system we were able to decrease the worldwide app latency immensely.</h5>
                            </div>
                            <!-- Testimonial -->
                            <div class="testimonial-thumbnail-title d-flex align-items-center">
                                <div class="testimonial-thumbnail">
                                    <img src="{{ asset('ecohost/img/bg-img/13.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-title">
                                    <h5>Kevin Castro</h5>
                                    <span>CEO facebook</span>
                                </div>
                            </div>
                        </div>

                        <!-- Single Testimonial Area -->
                        <div class="single-testimonial-area">
                            <div class="testimonial-content">
                                <!-- Ratings & Quote -->
                                <div class="ratings-icon d-flex align-items-center justify-content-between">
                                    <div class="rating">
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                    </div>
                                    <div class="quote-icon">
                                        <img src="{{ asset('ecohost/img/core-img/quote.png') }}" alt="">
                                    </div>
                                </div>
                                <h5>By switching to Hami Anycast DNS system we were able to decrease the worldwide app latency immensely.</h5>
                            </div>
                            <!-- Testimonial -->
                            <div class="testimonial-thumbnail-title d-flex align-items-center">
                                <div class="testimonial-thumbnail">
                                    <img src="{{ asset('ecohost/img/bg-img/10.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-title">
                                    <h5>Beatrice Vega</h5>
                                    <span>CEO DeerCreative</span>
                                </div>
                            </div>
                        </div>

                        <!-- Single Testimonial Area -->
                        <div class="single-testimonial-area">
                            <div class="testimonial-content">
                                <!-- Ratings & Quote -->
                                <div class="ratings-icon d-flex align-items-center justify-content-between">
                                    <div class="rating">
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                    </div>
                                    <div class="quote-icon">
                                        <img src="{{ asset('ecohost/img/core-img/quote.png') }}" alt="">
                                    </div>
                                </div>
                                <h5>By switching to Hami Anycast DNS system we were able to decrease the worldwide app latency immensely.</h5>
                            </div>
                            <!-- Testimonial -->
                            <div class="testimonial-thumbnail-title d-flex align-items-center">
                                <div class="testimonial-thumbnail">
                                    <img src="{{ asset('ecohost/img/bg-img/11.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-title">
                                    <h5>Roy Long</h5>
                                    <span>CEO Colorlib</span>
                                </div>
                            </div>
                        </div>

                        <!-- Single Testimonial Area -->
                        <div class="single-testimonial-area">
                            <div class="testimonial-content">
                                <!-- Ratings & Quote -->
                                <div class="ratings-icon d-flex align-items-center justify-content-between">
                                    <div class="rating">
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                    </div>
                                    <div class="quote-icon">
                                        <img src="{{ asset('ecohost/img/core-img/quote.png') }}" alt="">
                                    </div>
                                </div>
                                <h5>By switching to Hami Anycast DNS system we were able to decrease the worldwide app latency immensely.</h5>
                            </div>
                            <!-- Testimonial -->
                            <div class="testimonial-thumbnail-title d-flex align-items-center">
                                <div class="testimonial-thumbnail">
                                    <img src="{{ asset('ecohost/img/bg-img/12.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-title">
                                    <h5>Stephen Colon</h5>
                                    <span>CEO google</span>
                                </div>
                            </div>
                        </div>

                        <!-- Single Testimonial Area -->
                        <div class="single-testimonial-area">
                            <div class="testimonial-content">
                                <!-- Ratings & Quote -->
                                <div class="ratings-icon d-flex align-items-center justify-content-between">
                                    <div class="rating">
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                    </div>
                                    <div class="quote-icon">
                                        <img src="{{ asset('ecohost/img/core-img/quote.png') }}" alt="">
                                    </div>
                                </div>
                                <h5>By switching to Hami Anycast DNS system we were able to decrease the worldwide app latency immensely.</h5>
                            </div>
                            <!-- Testimonial -->
                            <div class="testimonial-thumbnail-title d-flex align-items-center">
                                <div class="testimonial-thumbnail">
                                    <img src="{{ asset('ecohost/img/bg-img/13.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-title">
                                    <h5>Kevin Castro</h5>
                                    <span>CEO facebook</span>
                                </div>
                            </div>
                        </div>

                        <!-- Single Testimonial Area -->
                        <div class="single-testimonial-area">
                            <div class="testimonial-content">
                                <!-- Ratings & Quote -->
                                <div class="ratings-icon d-flex align-items-center justify-content-between">
                                    <div class="rating">
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                    </div>
                                    <div class="quote-icon">
                                        <img src="{{ asset('ecohost/img/core-img/quote.png') }}" alt="">
                                    </div>
                                </div>
                                <h5>By switching to Hami Anycast DNS system we were able to decrease the worldwide app latency immensely.</h5>
                            </div>
                            <!-- Testimonial -->
                            <div class="testimonial-thumbnail-title d-flex align-items-center">
                                <div class="testimonial-thumbnail">
                                    <img src="{{ asset('ecohost/img/bg-img/10.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-title">
                                    <h5>Beatrice Vega</h5>
                                    <span>CEO DeerCreative</span>
                                </div>
                            </div>
                        </div>

                        <!-- Single Testimonial Area -->
                        <div class="single-testimonial-area">
                            <div class="testimonial-content">
                                <!-- Ratings & Quote -->
                                <div class="ratings-icon d-flex align-items-center justify-content-between">
                                    <div class="rating">
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                    </div>
                                    <div class="quote-icon">
                                        <img src="{{ asset('ecohost/img/core-img/quote.png') }}" alt="">
                                    </div>
                                </div>
                                <h5>By switching to Hami Anycast DNS system we were able to decrease the worldwide app latency immensely.</h5>
                            </div>
                            <!-- Testimonial -->
                            <div class="testimonial-thumbnail-title d-flex align-items-center">
                                <div class="testimonial-thumbnail">
                                    <img src="{{ asset('ecohost/img/bg-img/11.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-title">
                                    <h5>Roy Long</h5>
                                    <span>CEO Colorlib</span>
                                </div>
                            </div>
                        </div>

                        <!-- Single Testimonial Area -->
                        <div class="single-testimonial-area">
                            <div class="testimonial-content">
                                <!-- Ratings & Quote -->
                                <div class="ratings-icon d-flex align-items-center justify-content-between">
                                    <div class="rating">
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                    </div>
                                    <div class="quote-icon">
                                        <img src="{{ asset('ecohost/img/core-img/quote.png') }}" alt="">
                                    </div>
                                </div>
                                <h5>By switching to Hami Anycast DNS system we were able to decrease the worldwide app latency immensely.</h5>
                            </div>
                            <!-- Testimonial -->
                            <div class="testimonial-thumbnail-title d-flex align-items-center">
                                <div class="testimonial-thumbnail">
                                    <img src="{{ asset('ecohost/img/bg-img/12.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-title">
                                    <h5>Stephen Colon</h5>
                                    <span>CEO google</span>
                                </div>
                            </div>
                        </div>

                        <!-- Single Testimonial Area -->
                        <div class="single-testimonial-area">
                            <div class="testimonial-content">
                                <!-- Ratings & Quote -->
                                <div class="ratings-icon d-flex align-items-center justify-content-between">
                                    <div class="rating">
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                        <i class="icon_star" aria-hidden="true"></i>
                                    </div>
                                    <div class="quote-icon">
                                        <img src="{{ asset('ecohost/img/core-img/quote.png') }}" alt="">
                                    </div>
                                </div>
                                <h5>By switching to Hami Anycast DNS system we were able to decrease the worldwide app latency immensely.</h5>
                            </div>
                            <!-- Testimonial -->
                            <div class="testimonial-thumbnail-title d-flex align-items-center">
                                <div class="testimonial-thumbnail">
                                    <img src="{{ asset('ecohost/img/bg-img/13.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-title">
                                    <h5>Kevin Castro</h5>
                                    <span>CEO facebook</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Area End -->

    <!-- Support Area Start -->
    <section class="hami-support-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="support-text">
                        <h2>Need help? Call our award-winning support team 24/7: +65 1234-6868</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Support Pattern -->
        <div class="support-pattern" style="background-image: url({{ asset('ecohost/img/core-img/support-pattern.png')  }});"></div>
    </section>
    <!-- Support Area End -->

    <!-- Call To Action Area Start -->
    <section class="hami-cta-area">
        <div class="container">
            <div class="cta-text">
                <h2>Proudly Hosting Over <span class="counter">800,000</span> Websites Since 2000</h2>
            </div>
        </div>
    </section>
    <!-- Call To Action Area End -->

@endsection

@section('scripts')

@endsection