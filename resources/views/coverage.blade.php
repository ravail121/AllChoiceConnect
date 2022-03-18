@extends('layouts.app')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="price-desk coverage" style="background: url({{ asset('theme/newstyle/img/bg1.png') }})">
        <div class="container">
            <h2 class="animate__animated animate__fadeInDown">Putting excellent coverage on the map</h2>
            <div class="row hero-box destop_hero_slider">

            </div>


        </div>
    </section><!-- End Hero -->

    <section>

        <div class="container coverage-map" >
<iframe src="" style="width:100%; height:100%" id="map-frame"></iframe>

</div>
</section>
@endsection
@push('js')
<script>
    $("document").ready(function() {
            var base_url ='https://maps.t-mobile.com/pcc.html?map=mvno-noroam-5'
            var str = window.location.href;
            var n = str.lastIndexOf('=');
            var frame = document.getElementById('map-frame');
            if (n == -1){
                frame.src = base_url ;
            }else{
                var zipcode = str.substring(n + 1);
                frame.src = base_url + '&search=' + zipcode;
            }

        });

    </script>
@endpush('js')
