@extends('layouts.admin-base')

@section('title')
    اضافه کردن بازی
@stop

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>

        @if (isset($errors) && $errors->has(''))
            @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{{ $error }}</div>
            @endforeach
        @endif

        <h1><i class='fa fa-user'></i> اضافه کردن بازی</h1>

        {{ Form::open(['role' => 'form', 'url' => 'game/create']) }}

        {{ Form::token() }}

        <div class='form-group'>
            {{ Form::label('title', 'عنوان') }}
            {{ Form::text('title', null, ['placeholder' => 'عنوان', 'class' => 'form-control', 'required' => '']) }}
        </div>

        <div class='form-group'>
            {{ Form::label('abstract', 'چکیده') }}
            {{ Form::text('abstract', null, ['placeholder' => 'چکیده', 'class' => 'form-control','required' => '']) }}
        </div>

        <div class='form-group'>
            {{ Form::label('info', 'اطلاعات') }}
            {{ Form::text('info', null, ['placeholder' => 'اطلاعات', 'class' => 'form-control','required' => '']) }}
        </div>

        <div class='form-group'>
            {{ Form::label('large_image', 'عکس بزرگ') }}
            {{ Form::file('large_image',null,['required' => '']) }}
        </div>

        <div class='form-group'>
            {{ Form::label('small_image', 'عکس کوچک') }}
            {{ Form::file('small_image',null, ['required' => '']) }}
        </div>

        <div class='form-group'>
            {{ Form::submit('ایجاد', ['class' => 'btn btn-primary']) }}
        </div>

        {{ Form::close() }}

    </div>

@stop