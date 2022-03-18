@extends('layouts.app')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="price-desk" style="background-image: url({{ asset('theme/newstyle/img/bg1.png') }})">
        <div class="container">
            <h1 class="l-title title-medium animate__animated animate__fadeInDown">Pick Your Perfect Plan</h1>
            <p class="l-subtitle subtitle">Includes The OneTouch Family Safety APP</p>
            <div class="row hero-box destop_hero_slider">
            @foreach($voicePlans->take(3) as $key => $plan)
            <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="box d-flex flex-column">
                        <h3 class='box-plan'>{{$plan['name']}}</h3>
                        <div class="box-price"><span class="box-price-currency">$</span>{{$plan['amount_recurring']}}<span class="box-price-month">/mo</span></div>
                        <div class='box-desc'>
                        {!! $plan['description'] !!}
                        </div>
                        <div class='btn-wrap'>
                            <a class="l-btn btn-purple" href="{{url('/plans')}}?planid={{ $plan['id'] }}">Get Started</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>


            </div>


        </div>
    </section><!-- End Hero -->

    <!-- Flickity HTML init -->
    <section id="hero" class="price-mob" style="background-image: url({{ asset('theme/newstyle/img/bg1.png') }})">
        <div class="container">
            <h1 class="l-title title-medium animate__animated animate__fadeInDown">Pick Your Perfect Plan</h1>
            <p class="l-subtitle subtitle">Includes The OneTouch Family Safety APP</p>
            <div class="price-tabs">
            @php
                $class = ''; //Initialize variable
            @endphp
            @foreach($voicePlans->take(3) as $key => $plan)
                    @if ($loop->first)
                        @php
                            $class = 'button active'
                        @endphp
                    @else
                        @php
                            $class = 'button'
                        @endphp
                    @endif

                @if($plan['data_limit'] == '999')
                    <a href="javascript:void(0);" class="{{$class}}" id="tab-{{$plan['id']}}" >Unlimited</a>
                @else
                    <a href="javascript:void(0);" class="{{$class}}" id="tab-{{$plan['id']}}">{{$plan['data_limit']}}GB</a>

                @endif

            @endforeach

            </div>
            <!-- <div class="carousel"
                data-flickity='{ "pageDots": false,"prevNextButtons":false,"freeScroll": true, "freeScrollFriction": 0.03,"adaptiveHeight": true,"hash":false }'> -->
                <div class="carousel">
                @foreach($voicePlans->take(3) as $key => $plan)

                <div class="carousel-cell hero-box" id="carousel-cell-{{$plan['id']}}">
                    <div class="box d-flex flex-column">
                        <h3 class='box-plan'>{{$plan['name']}}</h3>
                        <div class="box-price"><span class="box-price-currency">$</span>{{$plan['amount_recurring']}}<span class="box-price-month">/mo</span></div>
                        <div class='box-desc'>
                        {!! $plan['description'] !!}
                        </div>
                        <div class='btn-wrap'>
                            <a class="l-btn btn-purple" href="{{url('/plans')}}?planid={{ $plan['id'] }}">Get Started</a>
                        </div>
                    </div>
                </div>

                @endforeach
                </div>

        </div>
    </section>


    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about" style="background-image: url( {{ asset('theme/newstyle/img/bg2.png') }} )">
            <div class="container">

                <div class="row">

                    <div class="col-lg-5 col-md-5 video-box">
                        <img src="{{ asset('theme/newstyle/img/mob.png') }}" class="mob-img">
                        <img src="{{ asset('theme/newstyle/img/dot.svg') }}" class="dot-img">
                    </div>

                    <div class="col-lg-7 col-lg-7 col-md-7 d-flex flex-column justify-content-center align-items-stretch">
                        <div class="content">
                            <h2 class="l-title title-medium">Family Safety Service</h2>
                            <p class="text">
                                We take family safety to a whole new level. Meet the OneTouchGPS Family Safety service.
                                Enjoy total peace of mind for your family knowing help is always just a touch away included
                                with all plans.
                            </p>
                            <p class="text">
                                Ensures total peace of mind designed for modern life, including a full range of support from
                                live agents, certified specialists, and 24/7
                            </p>
                            <div class='btn-wrap'>
                                <a class="l-btn btn-transparent" href="{{url('/features')}}">Learn More</a>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section><!-- End About Section -->
        <!-- ======= nationwide Section ======= -->
        <section id="nationwide" class="about" style='background-image: url( {{ asset('theme/newstyle/img/bg3.png') }})'>
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 d-flex flex-column justify-content-center ">
                        <div class="content">
                           <h2 class="l-title title-medium">Nationwide</br>5G & 4G Coverage</h2>
                        </div>
                    </div>
                    <div class="col-lg-5 d-flex flex-column justify-content-center coverage-box">
                        <!-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a> -->
                        <div class="form-zip">
                            <img src="{{ asset('theme/newstyle/img/cloud.png') }}" class="cloud">
                            <div class="form-zip-inner">
                                <h4 class="l-title title-small">Check Your Coverage Now</h4>
                                 <div class="input-box">
                                     <i class="icofont-location-pin"></i>
                                     <input type="text" placeholder="Enter Zip" id='coverage-zip-code' class="cus-inp">
                                     <input type="button" class="l-btn btn-purple" id='coverage-btn' value="Go">
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End nationwide Section -->

        <!-- ======= Whu Us Section ======= -->
        <section id="why-us" class="why-us" style='background-image: url({{ asset('theme/newstyle/img/bg4.png') }})'>
            <div class="container">
                <div class="title-wrap">
                    <h2 class="l-title title-medium">How it Works</h2>
                    <p class="l-subtitle subtitle">3 Simple Steps To Porches Your Internet Connection</p>
                </div>
                <div class="steps-container">
                    <div class="step-box">
                        <img src="{{ asset('theme/newstyle/img/w1.png') }}" class="step-img">
                        <h3 class="l-title step-title">Select Your Plan</h3>
                        <!-- <p>Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p> -->
                     </div>
                    <div class="step-box _arrow">
                        <img src="{{ asset('theme/newstyle/img/arrow.png') }}" class="arrow-img">
                    </div>
                    <div class="step-box">
                        <img src="{{ asset('theme/newstyle/img/w2.png') }}" class="step-img">
                        <h3 class="l-title step-title">Checkout</h3>
                        <!-- <p>Dolorem est fugiat occaecati voluptate velit esse. Dicta veritatis dolor quod et vel dire leno para dest</p> -->
                        </div>
                    <div class="step-box _arrow">
                        <img src="{{ asset('theme/newstyle/img/arrow.png') }}" class="arrow-img">
                    </div>
                    <div class="step-box">
                        <img src="{{ asset('theme/newstyle/img/w3.png') }}" class="step-img">
                        <h3 class="l-title step-title">Order Complete</h3>
                        <!-- <p>Molestiae officiis omnis illo asperiores. Aut doloribus vitae sunt debitis quo vel nam quis</p> -->
                    </div>
                </div>

            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= bring Section ======= -->
        <section id="bring" class="about bring" style='background-image: url({{ asset('theme/newstyle/img/girl.png') }});'>
            <div class="container">

                <div class="row">
                    <div class="col-lg-9 d-flex flex-column justify-content-center align-items-stretch">
                        <div class="content">
                            <h2 class="l-title title-medium">Bring Your Own Phone + </br>Keep Your Number</h2>
                            <p class="text">
                                Hate it when carriers force you to buy their phones when your current phone works just fine?
                                So do we. Bring along your existing phone, keep your existing number and all the "stuff"
                                already on your phone. We promise to make this simple.
                            </p class="text">
                            <div class="btn-wrap">
                                <a class="l-btn btn-purple" href="{{ url('/compatible') }}">Check Compatibility</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End bring Section -->


        <!-- ======= Features Section ======= -->
        <section id="features" class="why-us feat"
            style='background-image: url( {{ asset('theme/newstyle/img/bg6.png') }} );'>
            <div class="container">

                <div class="section-title">
                    <h2>Features</h2>
                    <p class="steps">We belive in keeping things simple. So all voice plans come</br>with these great
                        features</p>
                </div>

                <div class="row desctop_feature_slider">

                    <div class="col-lg-4">
                        <div class="box">
                            <img src="{{ asset('theme/newstyle/img/f1.png') }}" class="work-img">
                            <h4>Wifi calling</h4>

                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="box">
                            <img src="{{ asset('theme/newstyle/img/f2.png') }}" class="work-img">
                            <h4>Mobile Hotspot</h4>

                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="box">
                            <img src="{{ asset('theme/newstyle/img/f3.png') }}" class="work-img">
                            <h4>24x7 Customer</br>Support</h4>

                        </div>
                    </div>


                </div>




                <div class="row desctop_feature_slider">

                    <div class="col-lg-6">
                        <div class="box">
                            <img src="{{ asset('theme/newstyle/img/f4.png') }}" class="work-img">
                            <h4>5G Network</br>Nationwide Access</h4>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="box">
                            <img src="{{ asset('theme/newstyle/img/f5.png') }}" class="work-img">
                            <h4>Includes calls to</br>Canada & Mexico</h4>

                        </div>
                    </div>


                </div>
                <!----------------------mobile feature------------------------>
                <div class="row mobile_feature_slider">

                    <div id="carousel_feature_slider" class="carousel slide mobile_review_slider" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="box">
                                        <img src="{{ asset('theme/newstyle/img/f1.png') }}" class="work-img">
                                        <h4>Wifi calling</h4>

                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="box">

                                        <img src="{{ asset('theme/newstyle/img/f2.png') }}" class="work-img">
                                        <h4>Mobile Hotspot</h4>


                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="box">
                                        <img src="{{ asset('theme/newstyle/img/f3.png') }}" class="work-img">
                                        <h4>24x7 Customer</br>Support</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="box">
                                        <img src="{{ asset('theme/newstyle/img/f4.png') }}" class="work-img">
                                        <h4>5G Network</br>Nationwide Access</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="box">
                                        <img src="{{ asset('theme/newstyle/img/f2.png') }}" class="work-img">
                                        <h4>Mobile Hotspot</h4>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="controls testimonial_control col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <a class="left fa fa-chevron-left btn btn-default testimonial_btn" href="#carousel_feature_slider"
                            data-slide="prev"></a>

                        <a class="right fa fa-chevron-right btn btn-default testimonial_btn" href="#carousel_feature_slider"
                            data-slide="next"></a>
                    </div>

                </div>



            </div>
        </section><!-- End features Section -->

        <!-- ======= stars Section ======= -->
        <section id="stars" class="why-us">
            <div class="container">
                <div class="bg-imgs">
                    <img src="{{ asset('theme/newstyle/img/recta.png') }}" alt="" class="rect" />
                    <img src="{{ asset('theme/newstyle/img/dots.png') }}" alt="" class="dots" />
                </div>
                <div class="section-title">
                    <h2>We're seeing stars</h2>
                </div>

                <div class="row testi">

                    <div class="col-lg-3 mt-4 mt-lg-0">
                        <a href="https://www.google.com/search?rlz=1C1CHBF_enUS932US933&sxsrf=ALeKk023FSJpe4D35j8FwXD6iT9zDcfyIw%3A1609345802163&ei=CqvsX6XCCYuZ4-EP_Yy1qAo&q=Teltik+Communications&oq=Teltik+Communications&gs_lcp=CgZwc3ktYWIQAzIFCAAQyQMyAggAOgQIABBHULWZAVi1mQFg3JsBaABwAXgAgAF8iAF8kgEDMC4xmAEAoAECoAEBqgEHZ3dzLXdpesgBCMABAQ&sclient=psy-ab&ved=0ahUKEwil7-6mkPbtAhWLzDgGHX1GDaUQ4dUDCA0&uact=5#lrd=0x89c3cf6cc5976b63:0x9c49f2820e55108,1,,," target="_blank" rel="noreferrer">
                            <div class="box">
                                <div class="img-group">
                                    <img src="{{ asset('theme/newstyle/img/g1-c.png') }}" class="brand-img">
                                    <img src="{{ asset('theme/newstyle/img/s1.png') }}" class="star-img">
                                </div>
                                <div class="rating">
                                    <p>4.6</p>
                                </div>
                                <strong>+70 review</strong>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-3 mt-4 mt-lg-0">
                        <a href="https://www.facebook.com/TeltikCommunications/reviews/" target="_blank" rel="noreferrer">
                            <div class="box">
                                <div class="img-group">
                                    <img src="{{ asset('theme/newstyle/img/fb.png') }}" class="brand-img">
                                    <img src="{{ asset('theme/newstyle/img/s2.png') }}" class="star-img">
                                </div>
                                <div class="rating">
                                    <p>4.3</p>
                                </div>
                                <strong>+40 review</strong>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-3 mt-4 mt-lg-0">

                        <div class="box">
                            <div class="img-group">
                                <img src="{{ asset('theme/newstyle/img/b1.png') }}" class="brand-img">
                                <img src="{{ asset('theme/newstyle/img/s3.png') }}" class="star-img">
                            </div>
                            <div class="rating">
                                <p>3.8</p>
                            </div>
                            <strong><a href="https://www.business.org/services/phone/best-business-cell-phone-plans/#Teltik" target="_blank" rel="noreferrer" style="text-decoration:underline;">Best inexpensive plans</a></strong>
                        </div>
                    </div>
                    <div class="col-lg-3 mt-4 mt-lg-0">
                        <a href="https://www.trustpilot.com/review/teltik.com" target="_blank" rel="noreferrer">
                            <div class="box">
                                <div class="img-group">
                                    <img src="{{ asset('theme/newstyle/img/tr-c.png') }}" class="brand-img">
                                    <img src="{{ asset('theme/newstyle/img/s4.png') }}" class="star-img">
                                </div>
                                <div class="rating">
                                    <p>3.8</p>
                                </div>
                                <strong>2 review</strong>
                            </div>
                        </a>
                    </div>

                </div>


                <!--second row-->
                <div class="row reviews destop_review_slider">

                    <div class="col-lg-4 mt-4 mt-lg-0">
                        <div class="box grey">
                            <div class="img-group">
                                <img src="{{ asset('theme/newstyle/img/g1.png') }}" class="brand-img">
                                <img src="{{ asset('theme/newstyle/img/s.png') }}" class="star-img">
                            </div>
                            <div class="name">
                                <strong>Roger Steward</strong>
                            </div>
                            <p>Recently switched my business. So far everything has been great!</p>
                        </div>

                        <div class="box grey m-top">
                            <div class="img-group">
                                <img src="{{ asset('theme/newstyle/img/fb1.png') }}" class="brand-img">
                                <img src="{{ asset('theme/newstyle/img/s.png') }}" class="star-img">
                            </div>
                            <div class="name">
                                <strong>Patrick McCullough</strong>
                            </div>
                            <p>Switching to Teltik has allowed me cut my cost for wireless service by about two thirds, and
                                given me access to a great network that covers everywhere I go. It is one of the best
                                decisions I've made.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0">
                        <div class="box grey">
                            <div class="img-group">
                                <img src="{{ asset('theme/newstyle/img/b1.png') }}" class="brand-img">
                                <img src="{{ asset('theme/newstyle/img/s.png') }}" class="star-img">
                            </div>
                            <div class="name">
                                <strong>Bill Frost</strong>
                            </div>
                            <p>T-Mobile and Sprint have officially merged, so we updated this page to reflect everything we
                                know about the merger so far. We will continue to monitor the situation and let you know if
                                either service changes its plans, prices, or product offerings.</p>
                        </div>
                        <div class="box grey m-top">
                            <div class="img-group">
                                <img src="{{ asset('theme/newstyle/img/g1.png') }}" class="brand-img">
                                <img src="{{ asset('theme/newstyle/img/s.png') }}" class="star-img">
                            </div>
                            <div class="name">
                                <strong>Michael Muldoon</strong>
                            </div>
                            <p>Awesome prices and very good customer service that responds within a few minutes via email!
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0">
                        <div class="box grey">
                            <div class="img-group">
                                <img src="{{ asset('theme/newstyle/img/g1.png') }}" class="brand-img">
                                <img src="{{ asset('theme/newstyle/img/s.png') }}" class="star-img">
                            </div>
                            <div class="name">
                                <strong>Neil K</strong>
                            </div>
                            <p>Excellent customer service very fast replay with awesome network for cheapest price highly
                                recommend it to everyone who likes T-Mobile’s service !</p>
                        </div>
                        <div class="box grey m-top">
                            <div class="img-group">
                                <img src="{{ asset('theme/newstyle/img/t1.png') }}" class="brand-img">
                                <img src="{{ asset('theme/newstyle/img/s.png') }}" class="star-img">
                            </div>
                            <div class="name">
                                <strong>Tyler Caudle</strong>
                            </div>
                            <p>Teltik is awesome, I know people tend to throw that word around a lot but Teltik desrves
                                it...</p>
                        </div>
                    </div>

                </div>


                <div class="mobile_sli_rev">
                    <div id="carousel-example-generic" class="carousel slide mobile_review_slider" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="row">
                                    <div class="box grey">
                                        <div class="img-group">
                                            <img src="{{ asset('theme/newstyle/img/g1.png') }}" class="brand-img">
                                            <img src="{{ asset('theme/newstyle/img/s.png') }}" class="star-img">
                                        </div>
                                        <div class="name">
                                            <strong>Roger Steward</strong>
                                        </div>
                                        <p>Recently switched my business. So far everything has been great!</p>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="row">
                                    <div class="box grey m-top">
                                        <div class="img-group">
                                            <img src="{{ asset('theme/newstyle/img/fb1.png') }}" class="brand-img">
                                            <img src="{{ asset('theme/newstyle/img/s.png') }}" class="star-img">
                                        </div>
                                        <div class="name">
                                            <strong>Patrick McCullough</strong>
                                        </div>
                                        <p>Switching to Teltik has allowed me cut my cost for wireless service by about two
                                            thirds, and given me access to a great network that covers everywhere I go. It
                                            is one of the best decisions I've made.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="row">
                                    <div class="box grey">
                                        <div class="img-group">
                                            <img src="{{ asset('theme/newstyle/img/b1.png') }}" class="brand-img">
                                            <img src="{{ asset('theme/newstyle/img/s.png') }}" class="star-img">
                                        </div>
                                        <div class="name">
                                            <strong>Bill Frost</strong>
                                        </div>
                                        <p>T-Mobile and Sprint have officially merged, so we updated this page to reflect
                                            everything we know about the merger so far. We will continue to monitor the
                                            situation and let you know if either service changes its plans, prices, or
                                            product offerings.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="row">
                                    <div class="box grey m-top">
                                        <div class="img-group">
                                            <img src="{{ asset('theme/newstyle/img/g1.png') }}" class="brand-img">
                                            <img src="{{ asset('theme/newstyle/img/s.png') }}" class="star-img">
                                        </div>
                                        <div class="name">
                                            <strong>Michael Muldoon</strong>
                                        </div>
                                        <p>Awesome prices and very good customer service that responds within a few minutes
                                            via email!</p>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="row">
                                    <div class="box grey">
                                        <div class="img-group">
                                            <img src="{{ asset('theme/newstyle/img/g1.png') }}" class="brand-img">
                                            <img src="{{ asset('theme/newstyle/img/s.png') }}" class="star-img">
                                        </div>
                                        <div class="name">
                                            <strong>Neil K</strong>
                                        </div>
                                        <p>Excellent customer service very fast replay with awesome network for cheapest
                                            price highly recommend it to everyone who likes T-Mobile’s service !</p>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="row">
                                    <div class="box grey m-top">
                                        <div class="img-group">
                                            <img src="{{ asset('theme/newstyle/img/t1.png') }}" class="brand-img">
                                            <img src="{{ asset('theme/newstyle/img/s.png') }}" class="star-img">
                                        </div>
                                        <div class="name">
                                            <strong>Tyler Caudle</strong>
                                        </div>
                                        <p>Teltik is awesome, I know people tend to throw that word around a lot but Teltik
                                            desrves it...</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="controls testimonial_control pull-right">
                        <a class="left fa fa-chevron-left btn btn-default testimonial_btn" href="#carousel-example-generic"
                            data-slide="prev"></a>

                        <a class="right fa fa-chevron-right btn btn-default testimonial_btn"
                            href="#carousel-example-generic" data-slide="next"></a>
                    </div>
                </div>





                <!--third row-->
                <div class="row review-row">
                    <a class="get-started text-center btn-hov" href="https://www.google.com/search?rlz=1C1CHBF_enUS932US933&sxsrf=ALeKk023FSJpe4D35j8FwXD6iT9zDcfyIw%3A1609345802163&ei=CqvsX6XCCYuZ4-EP_Yy1qAo&q=Teltik+Communications&oq=Teltik+Communications&gs_lcp=CgZwc3ktYWIQAzIFCAAQyQMyAggAOgQIABBHULWZAVi1mQFg3JsBaABwAXgAgAF8iAF8kgEDMC4xmAEAoAECoAEBqgEHZ3dzLXdpesgBCMABAQ&sclient=psy-ab&ved=0ahUKEwil7-6mkPbtAhWLzDgGHX1GDaUQ4dUDCA0&uact=5#lrd=0x89c3cf6cc5976b63:0x9c49f2820e55108,1,,," target="_blank" rel="noreferrer">See More Reviews</a>
                </div>

            </div>
        </section><!-- End stars Section -->

    </main><!-- End #main -->
@endsection
@push('js')
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#twogb").addClass("active" );
            var $carousel = $('.carousel').flickity({
                adaptiveHeight: true,
                prevNextButtons: false,
                pageDots: false
            });
            var flkty = $carousel.data('flickity');
            var $cellButtonGroup = $('.price-tabs');
            var $cellButtons = $cellButtonGroup.find('.button');

            $carousel.on( 'select.flickity', function() {
                $cellButtons.filter('.active')
                    .removeClass('active');
                $cellButtons.eq( flkty.selectedIndex )
                    .addClass('active');
            });

            $cellButtonGroup.on( 'click', '.button', function() {
                var index = $(this).index();
                $carousel.flickity( 'select', index );
            });

            $carousel.on( 'change.flickity', function( event, index ) {
                console.log( 'Flickity change ' + index );
                @foreach($voicePlans->take(3) as $key => $plan)
                if ($("#carousel-cell-{{$plan['id']}}").hasClass("is-selected")) {
                    $(".price-tabs a").removeClass("active" );
                    $("#tab-{{$plan['id']}}").addClass("active" );
                }
                @endforeach

            });

    $('#coverage-btn').on('click',function(){
        var value = $('#coverage-zip-code').val();
        var isValidZipcode = /(^\d{5}$)|(^\d{5}-\d{4}$)/.test(value);
        if (!isValidZipcode){
            alert('Please enter valid zip code.')
        }else{
            window.location.href = `{{ url('/coverage')}}?zipcode=${value}`;
        }

    })


        });


    </script>
@endpush('js')
