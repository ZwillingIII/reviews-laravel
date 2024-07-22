<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME', 'Laravel')  }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <form id="auth-form" method="post" action="/api/auth">
            @csrf

            <div class="label">
                <label for="phone">Enter your phone</label>
                <input type="text" id="phone" name="phone" placeholder="Your phone">
                <div class="error phone-error hidden"></div>
            </div>
            <div class="label label-code hidden">
                <label for="code">Enter code</label>
                <input type="text" id="code" name="code" placeholder="Code">
                <div class="error code-error hidden"></div>
            </div>

            <button name="next">Enter</button>

            <button class="hidden" type="submit">Log in</button>

        </form>
    </body>
</html>
