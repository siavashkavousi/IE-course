@extends('layouts.base')

@section('element-import')
    <link rel="import" href="elements/register-page.html">
@endsection

@section('content')
    <register-page url="{{ url('/register') }}" csrf-token="{{ csrf_token() }}"></register-page>
@endsection