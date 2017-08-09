<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SL ENTRY </title>

    <!-- Bootstrap Core CSS -->
    <link href="{{URL::asset('/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="{{URL::asset('lib/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('lib/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{URL::asset('lib/device-mockups/device-mockups.min.css')}}">
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    {{--<script type="text/javascript" src="{{ URL::asset('js/jasny-bootstrap.min.js') }}"></script>--}}
    <!-- Theme CSS -->
    <link href="{{URL::asset('css/new-age.css')}}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body id="page-top">

@include("partials.nav")
@include("sections.top-page")
@include("sections.services")
@include("partials.footer")


</body>

</html>