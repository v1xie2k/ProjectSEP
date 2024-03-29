<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ProjectMVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/mycss.css') }}" media="screen">
    {{-- <link rel="stylesheet" href="{{ asset('css/mycssadmin.css') }}" media="screen"> --}}
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" media="screen">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    {{-- <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-3pvddp1GPtAATWkY"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
</head>
<body>
    <div>
        @yield('content')
    </div>
    <div class="foot">
        <p class="copy">Copyright 2022 © Amazake</p>
    </div>

    @yield('adminlte_js')
</body>
</html>
