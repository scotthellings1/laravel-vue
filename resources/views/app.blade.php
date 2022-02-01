<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-gray-100">
    <div id="app" class="container mx-auto p-6">

        <div class="">
            <router-link
                class="nav-link"
                to="/"
                exact
            >Home
            </router-link>
            <router-link
                class="nav-link"
                to="/products"
            >Products
            </router-link>
            <router-link
                class="nav-link"
                to="/quotes"
            >Quotes
            </router-link>

        </div> <router-view></router-view>
    </div>

        <script src="{{asset('js/app.js')}}" ></script>
    </body>
</html>
