<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {!! Html::style('https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css') !!}
    {!! Html::style('https://use.fontawesome.com/releases/v5.6.3/css/all.css') !!}
    {!! Html::style('theme/css/style_login.css') !!}
    {!! Html::style('theme/css/style_login_responsive.css') !!}
    <title>Forgot Password</title>
</head>
<body class="mainlogin">
    <div id="wrapper">
        <div class="loginmain">
            <div class="container">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="loginbx col-sm-12 col-md-8">
                        <h1>Forgot Password</h1>
                        {!! Form::open(['route' => 'forgotPassword', 'class' => 'forgot-password-form']) !!}
                        <div class="form-group">
                        {!! Form::text('identifier',null,['class' => 'form-control','placeholder' => 'Email or Customer ID']) !!}
                        {!! $errors->first('identifier') !!}
                        </div>
                        {!! Form::button('<span class="fas fa-arrow-right"></span>',['class' => 'btn btn-primary loginbtn', 'type' => 'submit']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6"></div>
            </div>
        </div>
    </div>
</body>
</html>

@include('layouts.partials._javascript')

<script>
    $(function(){
        $('.forgot-password-form').validate({
            rules: {
                email:{
                    required: true,
                },
            },
            messages: {
                email: {
                    required: "Please enter your email address",
                },
            },

            errorElement: "em",

            errorPlacement: function( error, element ){

                error.addClass('form-text text-muted text-danger');
                error.insertAfter(element);
            },
            success: function( label, element ){
            },
        });

    });
</script>
