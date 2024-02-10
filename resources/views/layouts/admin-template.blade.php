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
</head>

<body id="app">
    @include('layouts.admin-navbar')

    <div class="container-fluid">
        <div class="row">
            @include('layouts.admin-sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>Title</h1>
                <hr> @include('layouts.message')
                
            </main>
        </div>
    </div>

    @vite(['resources/js/app.js'])
</body>

</html>
