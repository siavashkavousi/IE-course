@extends('layouts.base')

@section('element-import')
    <link rel="import" href="elements/games-page.html">
@endsection

@section('content')
    @if (Auth::check())
        <games-page is-logged-in="true" csrf-token="{{ csrf_token() }}"></games-page>
    @else
        <games-page></games-page>
    @endif
@endsection