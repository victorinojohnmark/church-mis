<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    @vite(['resources/sass/app.scss'])
    @vite(['resources/css/app.css'])
    @vite(['resources/css/dashboard.css'])
    @stack('css')
</head>

<body>
    @include('layouts.admin-navbar')

    <div class="container-fluid">
        <div class="row">
            @include('layouts.admin-sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
                <h1></h1>
                <div class="d-flex justify-content-between align-items-center">
                    <h1>@yield('title')</h1>
                    <!-- Bell Icon with Notification Count -->
                    @if (isset($notificationCount))
                    <a href="{{ route('admin-notificationlist') }}" class="">
                        <div class="position-relative" style="padding-right: 12px;">
                            <i class="fas fa-bell pr-3" style="font-size: 25px;"></i>
                            <span class="notification-pill badge bg-danger rounded-circle">{{ $notificationCount }}</span>
                        </div>
                        
                    </a>
                    @endif
                    
                </div>
                <hr> @include('layouts.message')

                @yield('content')
                
            </main>

            
        </div>
    </div>
    @vite(['resources/js/app.js'])
    @vite(['resources/js/custom.js'])
    @stack('scripts')

    <script>
        function hideMenu(elementID) {
            var el = document.getElementById(elementID);
            if (el.style.display === "none") {
            el.style.display = "block";
            } else {
            el.style.display = "none";
            }
        }
    </script>
</body>

</html>
