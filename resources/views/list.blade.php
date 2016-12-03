@extends('layouts.app')

@section('content')
    <!-- # profiles_block -->
    <div class="container profiles_block">
      <form class="navbar-form profiles_search">
        <input type="text" class="form-control" placeholder="Поиск">
      </form>
      <hr/>
      <p>Сортировать по:</p>
      <form class="profiles_sort">
        <button type="submit" class="btn btn-primary">Рейтинг</button>
        <button type="submit" class="btn btn-primary">Подписчики</button>
        <button type="submit" class="btn btn-primary">Имя</button>
      </form>
      <hr/>
      @foreach ($profiles as $profile)
      <!-- # profile -->
      <div class="row profile">
        <div class="col-sm-3 profile_ava">
          <img src="../img/bike.jpg" alt="..." class="img-circle profile_img">
        </div>
        <div class="col-sm-3 profile_info">
          <p><strong>{{$profile->name_profile}}</strong></p>
          <p>{{$profile->description}}</p>
        </div>
        <div class="col-sm-3 profile_stat">
          <p>Лайки {{$profile->likes}}</p>
          <p>Подписки {{$profile->subscribes}}</p>
        </div>
        <div class="col-sm-3 profile_subscribe">
          <button type="submit" class="btn btn-primary profile_button">Подписаться</button>
        </div>
      </div>
      <!-- / profile -->
      @endforeach
    </div>
    <!-- / profiles_block -->
@stop
