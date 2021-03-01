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
                                <li class="breadcrumb-item active" aria-current="page">Configuration</li>
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
                        <h2>You've added the {{ucfirst($plan->title)}}.</h2>
                        <p>You want custom hosting plan. No hidden charge.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">

                @if( !empty($plan) )
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="single-price-plan mb-100">

                            <div class="price-plan-title">
                                <h4>{{$plan->title}}</h4>

                                @if(!empty($plan->discount))
                                    @if($plan->type[0]=='discount')
                                        <p>On discount - Save {{$plan->discount[0]}}%</p>
                                    @else
                                        <p>On sale - Save flat <span>&#8377;</span> {{$plan->discount[0]}}</p>
                                    @endif
                                @endif
                            </div>

                            <div class="price-plan-value">
                                <h2><span>&#8377;</span>{{$plan->price[0]}}</h2>

                                @if( !empty($plan->plan_duration[0]) )
                                    <p>/per @if($plan->plan_duration[0]!=1) {{$plan->plan_duration[0]}} @endif @if($plan->plan_duration[0]==1) {{__('Month')}} @else {{__('Months')}} @endif</p>
                                @endif
                            </div>

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


                <div class="col-12 col-md-6 col-lg-9">
                    <div class="single-price-plan mb-100">

                        <div class="price-plan-value">
                            <h2 style="font-size: 40px;" >{{__('Select term length')}}</h2>
                            <p>{{__('Lock in your savings with a multi-year term.')}}</p>
                        </div>


                        <div class="price-plan-desc">

                            <ul class="list-unstyled">

                                @if(!empty($data))
                                    @foreach($data as $index => $row)
                                        @if( $row['ActualAmount'] != 0 )

                                            <li class="bd-b-1 mb-2 pb-2" style = "text-decoration:blink;" >
                                                <div class="row mr-0 margin-me">
                                                    <div class="text-default col-xs-12 col-sm-8 col-md-8">
                                                        <div>
                                                            <fieldset class="form-group">
                                                                <div class="form-check">
                                                                    <label  >
                                                                        <input type="radio" name="duration[]" class="choooseplan" value="{{$index}}" >
                                                                        <span class="custom-control-indicator"></span>
                                                                        <span class="custom-control-description">{{$row['months']}} months</span>
                                                                    </label>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                    <div class="text-right no-padding col-xs-12 col-sm-4 col-md-4">
                                                        <div>
                                                            <span class="bold h4 price no-wrap-text">₹ {{$row['finalMonthlyAmount']}}</span>
                                                            <span class="text-muted bold">/month</span>
                                                            <div class="text-muted">
                                                                <strike>₹ {{$row['ActualAmount']}}/month</strike>
                                                            </div>
                                                            <div class="text-muted">
                                                                On Sale (Save @if($row['type']=='flat')₹ {{$row['discount']}}@else {{$row['discount']}}%@endif )
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif

                                    @endforeach
                                @endif

                            </ul>
                        </div>
                        <a class="btn view-all-btn add-to-cart-plan disabled" href="">Add to cart</a>
                    </div>
                </div>

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

<script>
    $(document).ready(function() {
        $('input:radio').change(function() {

            var id = $(this).val();
            if(id){
                var route = "{{route('addcart',$plan->id)}}"+"?duration="+id;
                $(".add-to-cart-plan").attr("href", route);
                $(".add-to-cart-plan").removeClass("disabled");
            }

{{--            var route = "{{route('addcart',$plan->id)}}";--}}

        });
    });
</script>

@endsection
