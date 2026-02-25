<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen">
    <header class="grid grid-cols-3 p-6 {{ $header_class ?? 'shadow-md' }}">
        <h1 class="col-start-2 font-faustina text-3xl text-stone-500 font-semibold mx-auto w-fit">FashionablyLate</h1>

        <div class="flex justify-end items-center font-faustina pe-[15%]">
            @yield('header_action')
        </div>
    </header>

    <main class="grow py-12 {{ $main_class ?? '' }}">
        @yield('content')
    </main>
</body>
</html>