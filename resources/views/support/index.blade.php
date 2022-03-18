@extends('layouts.app')

@section('content')

<div class="wrapper supportWrapper">
    <section class="faqs">
        <nav class ="categories-nav">
            <ul>
                @foreach($data['categories'] as $category)
                	<li><a href="#" data-category="{{$category['id']}}">{{$category['name']}}</a></li>
	            @endforeach
            </ul>
        </nav>

        <ul class="questions">
        	@foreach($data['support'] as $support)
                <li data-category="{{$support['category_id']}}" style="display: none;">
                    <h2>{{$support['question']}}<i>.</i></h2>
                    <div class="answer">
                        {!!$support['description']!!}
                    </div>
                </li>
            @endforeach
        </ul>
    </section>

    <aside class="support">
        <div class="info">
            <h3>Got Questions? <span>We’re listening!</span></h3>
            <p><span>Toll Free:</span> (877) 729-7294</p>
            <p><span>Email:</span> support@allchoiceconnect.com </p>
            <p>All Choice Connect<br> 400 Andrew Street Suite 625 <br> Rochester, New York 14604</p>

        </div>
        <form action="support-email" method="post">
            <h6>Send Us a message</h6>
            <input name="contactForm" value="1" type="hidden">
            {!! csrf_field() !!}
            <input name="name" placeholder="Name" value="" type="text">
            <input name="email" placeholder="Email" value="" type="email">
            <input name="subject" placeholder="Subject" value="" type="text">
            <textarea name="message" placeholder="Message"></textarea>
            <input value="Send It" type="submit">
        </form>
    </aside>

</div>


<div class="map">
	<div class="close-map">x</div>
	<iframe src="https://maps.t-mobile.com/" frameborder="0"></iframe>
</div>

<div class="overlay">&nbsp;</div>

<div id="cart-drop-mobile">
    <a href="#" class="btn style1 btn-cart">
        <i class="fa fa-shopping-cart"></i>
        Your Cart {{ session('cart') ? '('.count(session('cart')['order_groups']).')' : '' }}
    </a>
    <a href="#" class="btn style3 place-order-btn">Place Order</a>
    <div class="drop-con">

        <strong>Selected Solutions</strong>
        @section('footerCart')
            @include('cart.footer-mobile-cart-items')
        @endsection
</div>

@endsection

@push('css')
<style>
    strong { font-weight: bold; }
    em { font-style: italic; }
    ol {
        list-style: decimal;
        margin-left:40px;
    }
    .answer i { font-style: italic; }

    .answer ul {
        list-style: disc;
        margin-left:40px;
    }
    .answer li {
        border-bottom: 0px !important;
        padding-bottom: 10px;
    }
</style>
@endpush

@push('js')
<script>
    $(function(){
        $('.categories-nav ul li').first().find('a').click();
    });
</script>
{{-- {!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') !!}
{!! Html::script('js/jquery.marquee.min.js') !!}
{!! Html::script('js/bootstrap.min.js') !!}
{!! Html::script('js/functions.min.js') !!}
{!! Html::script('js/main.js') !!} --}}

@endpush
<!-- end FOOTER -->
