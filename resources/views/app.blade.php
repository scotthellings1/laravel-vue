<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
    <div id="app" class="container mx-auto p-6">
        <router-view></router-view>
        <router-link to="/">Home</router-link>
        <router-link to="/products">Products</router-link>
    </div>

        <script src="{{asset('js/app.js')}}" ></script>
    </body>
</html>