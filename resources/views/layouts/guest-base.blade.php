<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Reliant Pay</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('auth/images/favicon.ico') }}">

		<!-- Theme Config Js -->
		<script src="{{ asset('auth/js/head.js') }}"></script>

		<!-- Bootstrap css -->
		<link href="{{ asset('auth/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

		<!-- App css -->
		<link href="{{ asset('auth/css/app.min.css') }}" rel="stylesheet" type="text/css" />

		<!-- Icons css -->
		<link href="{{ asset('auth/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

       

        @livewireStyles

    </head>

    <body class="auth-fluid-pages pb-0">

       
        @yield('content')


       

        <!-- scripts js -->
        @livewireScripts

        @stack('scripts')

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <!-- Authentication js -->
        <script src="{{ asset('auth/js/pages/authentication.init.js') }}"></script>
	    <script>
            window.addEventListener('swal', function(e) {
			Swal.fire(e.detail);
		});
	    </script>

    </body>
</html>