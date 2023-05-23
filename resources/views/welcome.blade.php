<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  @vite(['resources/sass/app.scss'])
</head>
<body>

<body>
    @include('layouts.navbar')

    <h1>Welcome Page</h1>
    @vite(['resources/js/app.js'])
</body>

</html>
