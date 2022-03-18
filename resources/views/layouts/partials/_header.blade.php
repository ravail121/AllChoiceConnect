
	 <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-none d-lg-flex align-items-center fixed-tops topbar-transparent">
    <div class="container flex-wi text-left">
      <span>Need help?<strong> call us 877-729-7294</strong></span>
    </div>
    <div class="container flex-wi text-right">
      <!--<a href="#" style="color:#fff;">
        <span>Login</span>
			<img src="{{ asset('theme/newstyle/img/user.png') }}" alt="" class="img-fluid">
	  </a>-->
	   @if (session('id'))
		<div class="loggedin" style="float: right;">
			<a href="{{ route('account') }}" class="header-btn">My Account <i>U</i></a>
			<span> &nbsp;&nbsp;</span>
			<a href="{{ route('sign-out') }}" class="header-btn"> Log off</a>
		</div>
		@else
		<div class="dropdown" style="float: right;">
			<a type="button"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="login-link"><span>Login</span>
		
			<img src="{{ asset('theme/newstyle/img/user.png') }}" alt="" class="img-fluid"></a>
			

			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<div class="loginPre showing">
					<h3>Sign into your account</h3>
				{!! Form::open(['route' => 'signOn', 'class' => 'login-form']) !!}
					{!! Form::text('identifier',null,['placeholder' => 'Email or Customer ID', 'id' => 'identifier']) !!}

					{!! $errors->first('identifier') !!}
					<br><br>

					<div class="password-field">
						{{ Form::password('password', ['placeholder' => 'Password', 'id' => 'password_login']) }}
						<a class="forgot-btn" href="{{ route('forgot-password') }}">Forgot?</a>
						{!! $errors->first('password') !!}
						<br><br>
					</div>
					@if (session('login-status'))
						{{ session('login-status') }}
						<br><br>
					@endif
					{!! Form::button('SIGN IN',['class' => 'signin-btn', 'type' => 'submit', 'id' => 'sign-in-button']) !!}
				{!! Form::close() !!}
				</div>
			</div>
		</div>
		@endif
	
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-tops d-flex align-items-center header-transparent">
  
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
         <!-- Uncomment below if you prefer to use an image logo 
        <h1 class="text-light"><a href="index.html"><span>Teltik</span></a></h1>
       -->
        <a href="{{ url('/') }}"><img src={{ asset('theme/newstyle/img/logo.png') }} alt="" class="img-fluid"></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
		  	<li class="mobile-logo">
				<a href="{{ url('/') }}">
				<img src={{ asset('theme/newstyle/img/f-logo.png') }} alt="" class="img-fluid">
				</a>
				<button type="button" class="mobile-nav-toggle d-lg-none"><i class="icofont-navigation-menu"></i></button>
			</li>
          <li class = "{{ setActive('features', 'active') }}" ><a href="{{ url('/features') }}">Features</a></li>
          <li class = "{{ setActive('plans', 'active') }}" ><a href="{{ route('plans.index') }}">Plans</a></li>
          <li class = "{{ setActive('devices', 'active') }}" ><a href="{{ route('devices.index') }}">Devices</a></li>
          <li class = "{{ setActive('support', 'active') }}" ><a href="{{ url('/support')}}">Support</a></li>
          <li class = "{{ setActive('coverage', 'active') }}" ><a href="{{ url('/coverage')}}">Coverage</a></li>
		  <li class = "login_pop" >@if (session('id'))
		<div class="loggedin" style="float: right;">
			<a href="{{ route('account') }}" class="header-btn">My Account <i>U</i></a>
			<span> &nbsp;&nbsp;</span>
			<a href="{{ route('sign-out') }}" class="header-btn"> Log off</a>
		</div>
		@else
		<div class="dropdown" style="">
			<a type="button"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=""><span>Login</span>
			<img src="{{ asset('theme/newstyle/img/user.png') }}" alt="" class="img-fluid"></a>
			

			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<div class="loginPre showing">
					<h3>Sign into your account</h3>
				{!! Form::open(['route' => 'signOn', 'class' => 'login-form']) !!}
					{!! Form::text('identifier',null,['placeholder' => 'Email or Customer ID', 'id' => 'identifier']) !!}

					{!! $errors->first('identifier') !!}
					<br><br>

					<div class="password-field">
						{{ Form::password('password', ['placeholder' => 'Password', 'id' => 'password_login']) }}
						<a class="forgot-btn" href="{{ route('forgot-password') }}">Forgot?</a>
						{!! $errors->first('password') !!}
						<br><br>
					</div>
					@if (session('login-status'))
						{{ session('login-status') }}
						<br><br>
					@endif
					{!! Form::button('SIGN IN',['class' => 'signin-btn', 'type' => 'submit', 'id' => 'sign-in-button']) !!}
				{!! Form::close() !!}
				</div>
			</div>
		</div>
		@endif</li>
		  
		  
		  
         <!-- <li class="header_cart_se"><a href="#"><i class="icofont-shopping-cart"></i>My Cart</a></li>---> <li class="header_cart_se">@include('cart.header-cart-items')</li>
		 
		
        </ul>
		
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->
    @push('js')
        <script>
            const sideBar = $('#mySidebar'),
                  menuButton = $('#menu-button');

            function openNav() {
                sideBar.css('width', '250px');
                sideBar.css('z-index', '99');
                sideBar.addClass('active');
            }

            function closeNav() {
                sideBar.css('width', '0px');
                sideBar.css('z-index', '0');
                sideBar.removeClass('active');
            }
            menuButton.click(function(e) {
                e.stopPropagation();
                openNav();
            });
            $('body,html').click(function (e) {
                if (!sideBar.is(e.target)) {
                    closeNav();
                }
            });
        </script>
    @endpush
<!-- end header -->

