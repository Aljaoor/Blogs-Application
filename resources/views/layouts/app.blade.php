<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle ?: config('app.name', 'Laravel') }}</title>
    <meta name="author" content="Mohammed Aljaoor">
    <meta name="description" content="{{$metaDescription}}">

    {{--  icon  --}}
    <link rel="icon" href="{{asset('logo2.png')}}">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
            integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-50 font-family-karla">

<!-- Top Bar Nav -->
<x-layouts.top-bar/>

<!-- Text Header -->
<header class="w-full container mx-auto">
    <div class="flex flex-col items-center py-12">
        <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="{{route('home')}}">
            Blogs Application
        </a>
    </div>
</header>

<!-- Topic Nav -->
<x-layouts.navbar :categories="$categories"/>


<div class="container mx-auto flex flex-wrap py-6">

    <!-- Posts Section -->
    {{ $slot }}


</div>

<footer class="w-full border-t bg-white pb-12">
    <div class="w-full container mx-auto flex flex-col items-center">
        <div class="uppercase pb-6">&copy; Mohammed Aljaoor</div>
    </div>
</footer>

</body>
</html>
