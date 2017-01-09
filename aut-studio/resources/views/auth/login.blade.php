@extends('layouts.base')

@section('element-import')
    <link rel="import" href="elements/login-page.html">
@endsection

@section('content')
    <login-page url="{{ url('/login') }}" csrf_token="{{ csrf_token() }}"></login-page>
@endsection