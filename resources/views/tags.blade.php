@extends('layouts.app')

@section('content')


<!-- # sort -->
<div class="container accordion">
  <div id="demo123" class="collapse">
    <div class="sort">
      <form class="navbar-form">
        <input type="text" class="form-control" placeholder="Поиск">
      </form>
      <hr/>
      <p>Вывод по тегам

    </p>
      <form class="sort_tags">
        @foreach ($tags as $tag)
        <button type="submit" class="btn btn-primary">{{$tag->name_tag}}</button>
        @endforeach
      </form>
    </div>
  </div>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo123">Добавить тег</button>
  </div>

  <!-- / sort -->
@include('publications')
@stop
