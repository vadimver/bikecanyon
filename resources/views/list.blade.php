@extends('layouts.app')

@section('content')

    <!-- # profiles_block -->
    <div class="container profiles_block">
      <form accept-charset="UTF-8" action="{{ url('/list') }}" method="GET" class="navbar-form profiles_search">
        <input type="text" name="search" class="form-control" placeholder="Поиск по профилям">
      </form>
      <hr/>
      <p>Сортировать по:</p>
      <form accept-charset="UTF-8" action="{{ url('/list') }}" method="GET" class="profiles_sort">
        <button type="submit" name="sort" value="likes" class="btn btn-primary">Рейтинг</button>
        <button type="submit" name="sort" value="subscribes" class="btn btn-primary">Подписчики</button>
        <button type="submit" name="sort" value="name_profile" class="btn btn-primary">Название</button>
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
              <img src="../images/profiles/{{$profile->avatar}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="col-sm-3 profile_info">
              <p><strong>{{$profile->name_profile}}</strong></p>
              <p>{{$profile->description}}</p>
            </div>
            <div class="col-sm-3 profile_stat">
              <p>
                <button class="public_like my_button quantity_likes" data-toggle="quantity_likes" title="Лайки">
                  <i class="fa fa-heart" aria-hidden="true"></i>
                  <span class="public_like_number">
                      <?php $col = 0;?>
                      @foreach ($likes as $like)
                          @if ($profile->id_profile == $like->id_profile)
                            <?php $col = $col + $like['likes'];?>
                          @endif
                      @endforeach
                      {{$col}}
                  </span>
                </button>
              </p>
              <p>
                <button class="profile_subscribes my_button button_text" data-toggle="subscribes" title="Подписчики">
                      <i class="fa fa-check-square-o" aria-hidden="true"></i><span class="subscribe_number">{{$profile->subscribes}}</span>
                </button>
              </p>
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
      <hr>
      @endforeach
    </div>
    <!-- / profiles_block -->


@stop
