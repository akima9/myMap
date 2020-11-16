@extends('layouts.app')

@section('content')
    <form>
        <label for="campName">캠핑장 이름</label>
        <input type="text" id="campName" name="campName">
        <button type="button">중복확인</button>

        <label for="campAddress">캠핑장 주소</label>
        <input type="text" id="campAddress" name="campAddress">
        <button type="button">주소검색</button>

        <label for="campTel">캠핑장 연락처</label>
        <input type="text" id="campTel" name="campTel">
    </form>
@endsection