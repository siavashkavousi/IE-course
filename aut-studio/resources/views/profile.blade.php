@extends('layouts.base')

@section('element-import')
    <link rel="import" href="elements/profile-page.html">
@endsection

@section('content')
    @if (Auth::check())
        <profile-page url="{{ asset(Auth::user()->avatar) }}"
                      upload-url="{{ url('/profile/upload-avatar') }}"
                      csrf-token="{{ csrf_token() }}"></profile-page>
    @else
        <home-page></home-page>
    @endif
@endsection