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
    <title>Reset Password</title>
</head>
<body class="mainlogin">   
    <div id="wrapper">
        <div class="loginmain">
            <div class="container">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="loginbx col-sm-12 col-md-8">
                        <h1>Reset Password</h1>
                        {!! $errors->first('token') !!}
                        {!! Form::open(['route' => 'reset.password', 'class' => 'reset-password-form']) !!}
                        <div class="form-group">
                        {!! Form::password('password', [ 'class'=>"form-control",'placeholder' => 'Password', 'id' => 'password']) !!}
                        {!! $errors->first('password') !!}
                        </div>
                        <div class="form-group">
                        {!! Form::password('password_confirmation', [ 'class'=>"form-control",'placeholder' => 'Confirm Password']) !!}
                        {!! $errors->first('password_confirmation') !!}
                        </div>
                        {!! Form::text('token', $token , [ 'class'=>"reset-token"]) !!}

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

@include('layouts.partials._javascript');

<script>
    $(function(){
        $('.reset-password-form').validate({
            rules: {
                password:     {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo:'#password'
                },
                token: {
                    required:  true,
                },  
            },
            messages: {
                password:{
                    required:  "Please provide your password",
                    minlength: "Your password must be atleast 6-characters long"
                },     
                token: {
                    required:  "Sorry link is Not valid",
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

<style>
.reset-token{
  visibility: hidden!important;
  position:absolute;
}
</style>