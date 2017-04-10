<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kursusin</title>

    <!-- Bootstrap Core CSS -->

    <link href="{{ HTML::style('vendor/bootstrap/css/bootstrap.min.css', array(), true) }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ HTML::style('vendor/font-awesome/css/font-awesome.min.css', array(), true) }}"
    rel="stylesheet" type="text/css">
    <link href="/public/css/kursusin.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">    
        @include('layouts.nav')
    <div class="container">
        @yield('content')
    </div>
        @include('layouts.footer')

    <!-- jQuery -->
    <script src="{{ HTML::style('vendor/jquery/jquery.min.js', array(), true) }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/public/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

</body>

</html>
