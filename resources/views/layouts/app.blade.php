<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>myMap</title>
    </head>
    <body>
        <ul>
            <li><a href="/">홈</a></li>
            <li><a href="/addCamp">캠핑장 등록</a></li>
        </ul>
        <div id="contents">
            @section('content')
                This is the master content.
            @show
        </div>
    </body>
</html>