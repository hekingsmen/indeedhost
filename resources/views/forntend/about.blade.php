@extends('forntend.layouts.master')

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
                                <li class="breadcrumb-item active" aria-current="page">About Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- Video Area Start -->
    <div class="hami--video--area section-padding-100-0">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Welcome to Hami</h2>
                        <p>Deploy your service infrastructure on our fully redundant, high performance cloud platform and benefit from its high reliability, security and enterprise feature set. Easily enhance the performance, security and reliability of your services with one of our managed cloud hosting products, free data migration included.</p>
                    </div>
                </div>
            </div>

            <!-- Video Content Area -->
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <div class="video-content-area pr-3 mb-100">
                        <img src="{{ asset('ecohost/img/bg-img/4.jpg') }}" alt="">
                        <a href="https://www.youtube.com/watch?v=Ldd8yjjo6jA" class="video-play-btn"><i class="fa fa-play"></i></a>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="video-text pl-md-3 mb-100">
                        <h2>We Offer Professional Affordable Web Hosting &amp; Related Services</h2>
                        <!-- Description -->
                        <div class="video-desc mb-50">
                            <h6><i class="icon_check"></i> Reliability, Speed and Security</h6>
                            <h6><i class="icon_check"></i> Easy Knowledge Base</h6>
                            <h6><i class="icon_check"></i> Free Web Tools &amp; Applications</h6>
                            <h6><i class="icon_check"></i> 24/7 Award Winning Support</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Area End -->

    <!-- Team Area Start -->
    <section class="hami-team-area mb-70">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Our Management Team</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Team Member Area -->
                <div class="col-12 col-sm-6">
                    <div class="single-team-member-area d-flex align-items-center mb-30">
                        <!-- Team Thumbnail -->
                        <div class="team-thumbnail">
                            <img src="{{ asset('ecohost/img/bg-img/6.jpg') }}" alt="">
                        </div>
                        <!-- Team Content -->
                        <div class="team-content">
                            <h5>Mark Anderson</h5>
                            <span>Chief Executive Officer</span>
                            <p>Lorem Ipsum which looks reasonable generated as default model as and search many web sites pass websites.</p>
                        </div>
                    </div>
                </div>

                <!-- Single Team Member Area -->
                <div class="col-12 col-sm-6">
                    <div class="single-team-member-area d-flex align-items-center mb-30">
                        <!-- Team Thumbnail -->
                        <div class="team-thumbnail">
                            <img src="{{ asset('ecohost/img/bg-img/7.jpg') }}" alt="">
                        </div>
                        <!-- Team Content -->
                        <div class="team-content">
                            <h5>Jason Curry</h5>
                            <span>Support Representative</span>
                            <p>Lorem Ipsum which looks reasonable generated as default model as and search many web sites pass websites.</p>
                        </div>
                    </div>
                </div>

                <!-- Single Team Member Area -->
                <div class="col-12 col-sm-6">
                    <div class="single-team-member-area d-flex align-items-center mb-30">
                        <!-- Team Thumbnail -->
                        <div class="team-thumbnail">
                            <img src="{{ asset('ecohost/img/bg-img/8.jpg') }}" alt="">
                        </div>
                        <!-- Team Content -->
                        <div class="team-content">
                            <h5>Ricardo Coleman</h5>
                            <span>Software Engineer</span>
                            <p>Lorem Ipsum which looks reasonable generated as default model as and search many web sites pass websites.</p>
                        </div>
                    </div>
                </div>

                <!-- Single Team Member Area -->
                <div class="col-12 col-sm-6">
                    <div class="single-team-member-area d-flex align-items-center mb-30">
                        <!-- Team Thumbnail -->
                        <div class="team-thumbnail">
                            <img src="{{ asset('ecohost/img/bg-img/9.jpg') }}" alt="">
                        </div>
                        <!-- Team Content -->
                        <div class="team-content">
                            <h5>Lola Gill</h5>
                            <span>Product Director</span>
                            <p>Lorem Ipsum which looks reasonable generated as default model as and search many web sites pass websites.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Area End -->

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