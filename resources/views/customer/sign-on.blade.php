@extends('layouts.app')
@push('css')
    {!! Html::style('https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css') !!}
    {!! Html::style('https://use.fontawesome.com/releases/v5.6.3/css/all.css') !!}
    {!! Html::style('theme/css/style_login.css') !!}
    {!! Html::style('theme/css/style_login_responsive.css') !!}
@endpush('css')

@section('content')

<div class="mainlogin">

<div id="wrapper">
    <div class="loginmain">
        <div class="container">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="loginbx col-sm-12 col-md-8">
                    <h1>Login</h1>
                    @if (session('login-status'))
                        {{ session('login-status') }}
                        <br><br>
                    @endif
                    {!! Form::open(['route' => 'signOn', 'class' => 'login-page-form']) !!}
                    <div class="form-group">
                        {!! Form::text('identifier',null,['class' => 'form-control','placeholder' => 'Email or Customer ID', 'id' => 'identifier']) !!}
                        {!! $errors->first('identifier') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::password('password', [ 'class'=>"form-control",'placeholder' => 'Password', 'id' => 'password']) }}
                        {!! $errors->first('password') !!}
                    </div>
                    {!! Form::button('<span class="fas fa-arrow-right"></span>',['class' => 'btn btn-primary loginbtn', 'type' => 'submit']) !!}
                    <div class="form-group mt-3">
                        <a href="{{ route('forgot-password') }}" class="forgotbtn">Forgot Password?</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6"></div>
        </div>
    </div>
</div>
</div>
@endsection
@include('layouts.partials._javascript')

<script>
    $(function(){
        $('.login-page-form').validate({
            rules: {
                password:     "required",
                identifier:{
                    required: true,
                },
            },
            messages: {
                password:     "Please provide your password",
                identifier: {
                    required: "Please enter your Email ID or Customer ID",
                },
            },

            errorElement: "em",

            errorPlacement: function( error, element ){

                error.addClass('form-text text-muted text-danger');
                error.insertAfter(element);
            },
        });

    });
</script>
