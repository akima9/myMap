<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>myMap</title>
    </head>
    <body>
        <h1>index</h1>
        <form action="/search" method="get">
            <input type="text" name="searchKeyword" placeholder="검색어를 입력해주세요." value="{{ $searchKeyword ?? '' ?? '' }}">
            <button type="submit">검색</button>
        </form>
        <a href="/myMap">마이맵</a>
    </body>
</html>