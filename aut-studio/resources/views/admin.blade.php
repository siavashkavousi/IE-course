@extends('layouts.admin-base')

@section('title')
    بازی‌ها
@stop

@section('styles')
    <style>
        th {
            text-align: right;
        }
    </style>
@stop

@section('content')

    <div class="col-lg-10 col-lg-offset-1">

        <h1><i class="fa fa-users pull-right"></i>
            <p class="pull-right">مدیریت بازی‌ها</p>
            {{ Form::open(['url' => 'logout' ,'method' => 'POST']) }}
            {{ Form::submit('خروج', ['class' => 'btn pull-left'])}}
            {{ Form::close() }}
        </h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>عنوان</th>
                    <th>چکیده</th>
                    <th>اطلاعات</th>
                    <th>امتیاز</th>
                    <th>عکس بزرگ</th>
                    <th>عکس کوچک</th>
                    <th>تعداد نظرات</th>
                    <th>اضافه شده در</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach ($games as $game)
                    <tr>
                        <td>{{ $game->title }}</td>
                        <td>{{ $game->abstract }}</td>
                        <td>{{ $game->info }}</td>
                        <td>{{ $game->rate }}</td>
                        <td>{{ $game->large_image }}</td>
                        <td>{{ $game->small_image }}</td>
                        <td>{{ $game->number_of_comments }}</td>
                        <td>{{ $game->created_at }}</td>
                        <td>
                            <a href="/game/{{ $game->id }}/edit" class="btn btn-info pull-left"
                               style="margin-right: 3px;">ویرایش</a>
                            {{ Form::open(['url' => 'game/' . $game->id, 'method' => 'DELETE']) }}
                            {{ Form::submit('حذف', ['class' => 'btn btn-danger'])}}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

        <a href="{{ url('game/create') }}" class="btn btn-success">ایجاد بازی جدید</a>

    </div>

@stop