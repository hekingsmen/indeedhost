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
                                <li class="breadcrumb-item active" aria-current="page">Hosting</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- Price Plan Area Start -->
    <section class="hami-price-plan-area section-padding-100-0"  >
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
    <section class="hami-call-to-action">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <div class="cta-thumbnail pr-3 mb-100">
                        <img src="{{ asset('ecohost/img/bg-img/3.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="cta--content pl-3 mb-100">
                        <h2>Optimized Hosting For WordPress</h2>
                        <p>Deploy your service infrastructure on our fully redundant, high performance cloud platform and benefit from its high reliability, security and enterprise feature set. Easily enhance the performance, security and reliability of your services with one of our managed cloud hosting products, free data migration included.</p>
                        <!-- Button -->
                        <a href="#" class="btn hami-btn mt-50">Get Start Now!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call To Action Area End -->

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
