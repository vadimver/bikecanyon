@extends('layouts.app')

@section('content')
  <a href="{{ url('create_profile') }}">Создать профиль</a>
    <!-- # profiles_block -->
    <div class="container profiles_block">
      @foreach ($profiles as $profile)
      <!-- # profile -->
          <div class="row profile">
            <div class="col-sm-3 profile_ava">
              <img src="../images/profiles/{{$profile->avatar}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="col-sm-3 profile_info">
              <p><strong>{{$profile->name_profile}}</strong></p>
              <p>{{$profile->description}}</p>
            </div>
            <div class="col-sm-3 profile_stat">
              <p>Лайки {{$profile->likes}}</p>
              <p>Подписки {{$profile->subscribes}}</p>
            </div>
            <a href="{{ url('edit_profile/'.$profile->id_profile) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <a href="{{ url('my_destroy/'.$profile->id_profile) }}"><i class="fa fa-window-close" aria-hidden="true"></i></span></a>

          </div>
      <!-- / profile -->
      @endforeach
    </div>
    <!-- / profiles_block -->
@stop
