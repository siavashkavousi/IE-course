@extends('layouts.base')

@section('element-import')
    <link rel="import" href="elements/home-page.html">
@endsection

@section('content')
    @if (Auth::check())
        <home-page is-logged-in="true"></home-page>
    @else
        <home-page></home-page>
    @endif
@endsection