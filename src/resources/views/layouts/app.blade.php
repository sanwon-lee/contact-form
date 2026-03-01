<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>@yield("title")</title>

        @vite(["resources/css/app.css", "resources/js/app.js"])
    </head>
    <body class="flex min-h-screen flex-col">
        <header
            class="{{ $header_class ?? "shadow-md" }} grid grid-cols-3 p-6"
        >
            <h1
                class="font-faustina col-start-2 mx-auto w-fit text-3xl font-semibold text-stone-500"
            >
                FashionablyLate
            </h1>

            <div class="font-faustina flex items-center justify-end pe-[15%]">
                @yield("header_action")
            </div>
        </header>

        <main class="{{ $main_class ?? "" }} grow pbs-12">
            @yield("content")
        </main>
    </body>
</html>
