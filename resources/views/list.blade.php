@extends('layouts.app')

@section('content')
    <!-- # profiles_block -->
    <div class="container profiles_block">
      <form accept-charset="UTF-8" action="{{ url('/list') }}" method="GET" class="navbar-form profiles_search">
        <input type="text" name="search" class="form-control" placeholder="Поиск">
      </form>
      <hr/>
      <p>Сортировать по:</p>
      <form accept-charset="UTF-8" action="{{ url('/list') }}" method="GET" class="profiles_sort">
        <button type="submit" name="sort" value="likes" class="btn btn-primary">Рейтинг</button>
        <button type="submit" name="sort" value="subscribes" class="btn btn-primary">Подписчики</button>
        <button type="submit" name="sort" value="name_profile" class="btn btn-primary">Имя</button>
      </form>
      <hr/>
      @foreach ($profiles as $profile)

      <!-- # profile -->
      @if (isset($profile->my_profile))
      <form accept-charset="UTF-8" action="{{ url('/unsubscribe') }}" method="POST">

      @else
      <form accept-charset="UTF-8" action="{{ url('/subscribe') }}" method="POST">
      @endif

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
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type='hidden' name="id_profile" value="{{$profile->id_profile}}">
              @if (isset($profile->my_profile))
              <button type="submit" name="unsub" value="{{$profile->id_sub}}" class="btn btn-success profile_button">Отписаться</button>
              @else
              <button type="submit" name="sub" class="btn btn-primary profile_button">Подписаться</button>
              @endif
            </div>
          </div>
      </form>
      <!-- / profile -->

      @endforeach
    </div>
    <!-- / profiles_block -->
@stop
