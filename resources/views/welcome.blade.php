<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta property="og:title" content="didakoo games" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://i.imgur.com/OJddODl.jpeg" />
    <meta property="og:url" content="https://didakoo.com" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.4/lottie.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/abf919e747.js" crossorigin="anonymous"></script>
    <script src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <title>didakoo games</title>
    <link rel="shortcut icon" href="{{asset('images/metamask_login_avatar.png')}}" />
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
{{--    <link rel="shortcut icon" href="https://cdn.iconscout.com/icon/free/png-256/free-avatar-370-456322.png?f=webp&w=256" />--}}
</head>

<body>
    <div id="app">

    </div>
</body>
<script>
    window.laravel_echo_port='{{env("LARAVEL_ECHO_PORT")}}';
</script>
</html>
