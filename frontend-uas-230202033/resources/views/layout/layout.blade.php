<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
        {{-- FONTS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Sansation:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    {{-- FONTS --}}

    {{-- ICONS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    
    {{-- ICONS --}}
  </head>
  <body class="">
    @include('components/sidebar')
    @include('components/header')
     <div class="ml-64 pt-16 bg-gray-900 min-h-screen text-white">
        <div class="w-full p-6">
          @yield('content')
        </div>
    </div>
  </body>
</html>