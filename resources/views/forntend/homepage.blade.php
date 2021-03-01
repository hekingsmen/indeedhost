@extends('forntend.layouts.master')

@section('content')

    <!-- Welcome Area Start -->
    <section class="welcome-area">

        <!-- Welcome Pattern -->
        <div class="welcome-pattern">
            <img src="{{ asset('ecohost/img/core-img/welcome-pattern.png') }}" alt="">
        </div>

        <!-- Welcome Slide -->
        <div class="welcome-slides owl-carousel">

            
            @if(count($sliders) > 0)

                @foreach($sliders as $index => $slider)

                    <div class="single-welcome-slide">
                        <!-- Welcome Content -->
                        <div class="welcome-content h-100">
                            <div class="container h-100">
                                <div class="row h-100 align-items-center">
                                    <!-- Welcome Text -->
                                    <div class="col-12 col-md-9 col-lg-7">
                                        <div class="welcome-text mb-50">
                                            
                                            <h2 data-animation="fadeInLeftBig" data-delay="200ms" data-duration="1s">{{ $slider->heading_first }}</h2>
                                            
                                            <h3 data-animation="fadeInLeftBig" data-delay="400ms" data-duration="1s">{{ $slider->heading_second }}</span> $2.95/month*</h3>
                                            <p data-animation="fadeInLeftBig" data-delay="600ms" data-duration="1s">{{ $slider->text }}</p>

                                            <a href="#" class="btn hami-btn btn-2" data-animation="fadeInLeftBig" data-delay="800ms" data-duration="1s">Get Start Now!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Welcome Thumbnail -->
                        <div class="welcome-thumbnail">
                            <img src="{{ asset('sliders') }}/{{$slider->image}}" alt="">
                        </div>
                    </div>
                @endforeach
            @else
                

                <div class="single-welcome-slide">
                    
                    <div class="welcome-content h-100">
                        <div class="container h-100">
                            <div class="row h-100 align-items-center">
                    
                                <div class="col-12 col-md-9 col-lg-7">
                                    <div class="welcome-text mb-50">
                                        <h2 data-animation="fadeInUpBig" data-delay="200ms" data-duration="1s">The Best <br> Web Hosting</h2>
                                        <h3 data-animation="fadeInUpBig" data-delay="400ms" data-duration="1s">Starting at <span>$7.99</span> $2.95/month*</h3>
                                        <p data-animation="fadeInUpBig" data-delay="600ms" data-duration="1s">Everything you will EVER need to Host and Manage your Website!</p>
                                        <a href="#" class="btn hami-btn btn-2" data-animation="fadeInUpBig" data-delay="800ms" data-duration="1s">Get Start Now!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="welcome-thumbnail">
                        <img src="{{ asset('ecohost/img/bg-img/2.png') }}" alt="">
                    </div>
                </div>


            @endif
            

        </div>

        <!-- Clouds -->
        <div class="clouds">
            <img src="{{ asset('ecohost/img/core-img/cloud-1.png') }}" alt="" class="cloud-1">
            <img src="{{ asset('ecohost/img/core-img/cloud-2.png') }}" alt="" class="cloud-2">
            <img src="{{ asset('ecohost/img/core-img/cloud-3.png') }}" alt="" class="cloud-3">
            <img src="{{ asset('ecohost/img/core-img/cloud-4.png') }}" alt="" class="cloud-4">
            <img src="{{ asset('ecohost/img/core-img/cloud-5.png') }}" alt="" class="cloud-5">
        </div>
    </section>
    <!-- Welcome Area End -->

    <!-- Find Domain Area Start -->
    <section class="find-domain-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-4">
                    <div class="domain-text mb-100">
                        <h2>Find Your Perfect Domain Name</h2>
                        <h6>Only $7 for the first year</h6>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="domain-search-form mb-100">
                        <!-- Search Form -->
                        <form action="#" method="post" class="form-inline">
                            <input type="search" placeholder="Enter Your Domain Name Here">
                            <select name="domain-extension" id="domainExtension">
                                <option value=".com">.COM</option>
                                <option value=".com">.NET</option>
                                <option value=".com">.ORG</option>
                                <option value=".com">.US</option>
                                <option value=".com">.BIZ</option>
                                <option value=".com">.CO</option>
                            </select>
                            <button type="submit">Search Domain</button>
                        </form>

                        <!-- Domain Price Help -->
                        <div class="domain-price-help mt-50 d-flex align-items-center justify-content-between">
                            <p>.COM $5.75</p>
                            <p>.NET $9.45</p>
                            <p>.ORG $7.50</p>
                            <p>.US $5.99</p>
                            <p>.BIZ $9.99</p>
                            <p>.CO $6.0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Find Domain Area End -->

    <!-- Features Area Start -->
    <section class="hami-features-area bg-gray section-padding-100">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Overall Features</h2>
                        <p>Our revolutionary Cloud solution is powerful, simple, and surprisingly affordable.</p>
                    </div>
                </div>
            </div>

            <div class="row">

                
                @if(count($feature)>0)
                    @foreach($feature as $index => $featur)

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-feature-area d-flex mb-50">
                                <div class="feature-icon">
                                    <img src="{{ asset('features') }}/{{ $featur->image }}" alt="" class="cloud-1">
                                </div>
                                <div class="feature-text">
                                    <h5>{{ $featur->title }}</h5>
                                    <p>{{ $featur->description }}</p>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @else
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-feature-area d-flex mb-50">
                            <div class="feature-icon" style=" padding-right: 4px;" >
                                <i class="icon_cloud-upload_alt"></i>
                            </div>
                            <div class="feature-text">
                                <h5>Auto Updates</h5>
                                <p>Don't be distracted by criticism. Remember the only taste of success some people.</p>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <!-- Feature Pattern -->
        <div class="feature-pattern">
            <img src="{{ asset('ecohost/img/core-img/welcome-pattern.png') }}" alt="">
        </div>
    </section>
    <!-- Features Area End -->

    <!-- Price Plan Area Start -->
    <section class="hami-price-plan-area mt-50">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Choose Your Web Hosting Plan</h2>
                        <p>You want custom hosting plan. No hidden charge.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">


                @if(!empty($plans) && count($plans)>0 )
                    @foreach($plans as $index =>$plan)
                        @if( $plan->price[0] != 0 || $plan->price[0] != null )
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="single-price-plan mb-100">
                                    <!-- Title -->
                                    <div class="price-plan-title">

                                        <h4>{{$plan->title}}</h4>

                                        @if(!empty($plan->discount))
                                            @if($plan->type[0]=='percentage')
                                                <p>On discount - Save {{$plan->discount[0]}}%</p>
                                            @else
                                                <p>On sale - Save flat <span>&#8377;</span> {{$plan->discount[0]}}</p>
                                            @endif
                                        @endif
                                    </div>
                                    <!-- Value -->
                                    <div class="price-plan-value">

                                        <h2><span>&#8377;</span>{{$plan->price[0]}}</h2>

                                        @if( !empty($plan->plan_duration) )
                                            <p>/per @if($plan->plan_duration[0]!=1) {{$plan->plan_duration[0]}} @endif @if($plan->plan_duration[0]==1) {{__('Month')}} @else {{__('Months')}} @endif</p>
                                        @endif

                                    </div>

                                    <a href="{{route('plan.configure',$plan->id)}}" class="btn hami-btn w-100 mb-30">{{ __('Add to cart') }}</a>

                                    <div class="price-plan-desc">
                                        <p><i class="icon_check"></i> {{ $plan->storage }} GB Storage </p>
                                        <p><i class="icon_check"></i> {{ $plan->bandwidth}} Bandwidth </p>
                                        <p><i class="icon_check"></i> {{ $plan->ram}}GB RAM </p>
                                        <p><i class="icon_check"></i> {{ $plan->db }} Database </p>
                                        <p><i class="icon_check"></i> {{ $plan->emails}} Emails </p>
                                        <p><i class="icon_check"></i> {{ $plan->support}} Support </p>
                                    </div>

                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

              
            </div>
        </div>
    </section>
    <!-- Price Plan Area End -->

    <!-- Call To Action Area Start -->
    <section class="hami-call-to-action bg-gray section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <div class="cta-thumbnail mb-100">
                        <img src="{{ asset('ecohost/img/bg-img/2.png') }}" alt="">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="cta--content mb-100">
                        <h2>Up to 70% Discount with FREE Domain Name Registration Included!</h2>
                        <!-- Description -->
                        <div class="cta-desc mb-50">
                            <h6><i class="icon_check"></i> FREE Domain Name</h6>
                            <h6><i class="icon_check"></i> FREE Email Address</h6>
                            <h6><i class="icon_check"></i> Plenty of Disk Space</h6>
                            <h6><i class="icon_check"></i> FREE Website Builder</h6>
                            <h6><i class="icon_check"></i> FREE Marketing Tools</h6>
                            <h6><i class="icon_check"></i> 1-Click WordPress Install</h6>
                        </div>
                        <!-- Button -->
                        <a href="#" class="btn hami-btn">Get Start Now!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call To Action Area End -->

    <!-- Support Area Start -->
    <section class="hami-support-area bg-gray">
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