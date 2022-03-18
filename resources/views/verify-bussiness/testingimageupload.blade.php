<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
</head>
<body>
    {!! Form::open(['route' => 'test.image','class' => 'text-left verify-business-form','files' => true]) !!}
    {{-- $imageUrl --}}
    {!! Form::file('file', array('class' => 'image')) !!}
    {!! Form::submit('Upload', array('class' => 'upload')) !!}

{!! Form::close() !!}
</body>
</html>