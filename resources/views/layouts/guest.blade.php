<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  dir="{{ session()->has('dir') ? session()->get('dir') : 'rtl' , }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="baseUrl" content="{{env('APP_URL')}}" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="shortcut icon" class="site_favicon_preview" href="{{ getSingleMedia(imageSession('get'),'favicon',null) }}" />
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/backend.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fronted-custom.css') }}">



    </head>
    <body class=" " >

        <div class="wrapper">
            {{ $slot }}
        </div>
         @include('partials._scripts')
    </body>
</html>
