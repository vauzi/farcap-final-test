<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{asset('logo/logo.svg')}}">
    <title>App</title>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    @livewireStyles
    @vite('resources/css/app.css')
    
</head>
<body class="bg-gray-50" >
    
    @if (session()->has('success'))
        @livewire('component.alert', [
            'status' => 'succes',
            'message' => session('success'),
        ])
    @endif

    <div class="flex">

        <!-- component -->
        @if (Auth::user())
            @livewire('component.nav.sidebar')
        @endif
        {{$slot}}
    </div>
    
    
    @livewireScripts
</body>
</html>