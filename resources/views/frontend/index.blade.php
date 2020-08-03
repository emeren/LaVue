<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset('js/frontend.js') }}" defer></script>
        <link href="{{ asset('/frontend/css/app.css') }}" rel="stylesheet">
</head>

<body>
            <div id="app" class="p-3 mx-auto cover-container d-flex w-100 h-100 flex-column">
                <frontend></frontend>
            </div>
</body>

</html>