@extends('layouts.base')

@section('element-import')
    <link rel="import" href="elements/game-page.html">
@endsection

@section('content')
    @if (Auth::check())
        <game-page is-logged-in="true" csrf-token="{{ csrf_token() }}"></game-page>
    @else
        <game-page></game-page>
    @endif
@endsection