@extends('layouts.admin-base')

@section('title')
    ویرایش بازی
@stop

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>

        @if (isset($errors) && $errors->has(''))
            @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{{ $error }}</div>
            @endforeach
        @endif

        <h1><i class='fa fa-user'></i> ویرایش بازی</h1>

        {{ Form::model($game, ['role' => 'form', 'url' => 'game/' . $game->id . '/edit', 'method' => 'PUT']) }}

        <div class='form-group'>
            {{ Form::label('title', 'عنوان') }}
            {{ Form::text('title', null, ['placeholder' => 'عنوان', 'class' => 'form-control', 'required' => '']) }}
        </div>

        <div class='form-group'>
            {{ Form::label('abstract', 'چکیده') }}
            {{ Form::text('abstract', null, ['placeholder' => 'چکیده', 'class' => 'form-control', 'required' => '']) }}
        </div>

        <div class='form-group'>
            {{ Form::label('info', 'اطلاعات') }}
            {{ Form::text('info', null, ['placeholder' => 'اطلاعات', 'class' => 'form-control', 'required' => '']) }}
        </div>

        <div class='form-group'>
            {{ Form::label('large_image', 'عکس بزرگ') }}
            {{ Form::file('large_image', ['placeholder' => 'عکس بزرگ ', 'class' => 'form-control']) }}
        </div>

        <div class='form-group'>
            {{ Form::label('small_image', 'عکس کوچک') }}
            {{ Form::file('small_image', null, ['placeholder' => 'عکس کوچک', 'class' => 'form-control']) }}
        </div>

        <div class='form-group'>
            {{ Form::submit('ویرایش', ['class' => 'btn btn-primary']) }}
        </div>

        {{ Form::close() }}

    </div>

@stop