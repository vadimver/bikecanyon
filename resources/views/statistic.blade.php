@extends('layouts.app')

@section('content')
<div class="content">
    <p> Зарегистрирован -
        @foreach ($date as $dt)
          {{$dt->created_at}}
        @endforeach
    </p>
    <p> Публикаций - {{$publications}}</p>
    <p> Лайков - {{$likes}}</p>
    <p> Комментарии - {{$comments}}</p>
    <p> Профайлов - {{$profiles}}</p>
</div>
@stop
