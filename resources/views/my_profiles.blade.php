@extends('layouts.app')

@section('content')
  <form action="{{ url('create_profile') }}" class="my_profiles_new">
      <button class="btn btn-primary btn-sm">Создать профиль</button>
  </form>
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
              <p>
                <button class="public_like my_button quantity_likes" data-toggle="quantity_likes" title="Лайки">
                  <i class="fa fa-heart" aria-hidden="true"></i><span class="public_like_number">{{$profile->likes}}</span>
                </button>
              </p>
              <p>
                <button class="profile_subscribes my_button button_text" data-toggle="subscribes" title="Подписчики">
                      <i class="fa fa-check-square-o" aria-hidden="true"></i><span class="subscribe_number">{{$profile->subscribes}}</span>
                </button>
              </p>
            </div>
            <div class="col-sm-3 profile_action">
              <a class="profile-edit" data-toggle="edit_profile" title="Редактировать профиль" href="{{ url('edit_profile/'.$profile->id_profile) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              <a class="profile-delete" data-toggle="delete_profile" title="Удалить профиль" href="{{ url('my_destroy/'.$profile->id_profile) }}"><i class="fa fa-window-close" aria-hidden="true"></i></span></a>
            </div>
          </div>
      <!-- / profile -->
      <hr>
      @endforeach
    </div>
    <!-- / profiles_block -->
    <div class="pagination_block">
        {{ $profiles->links() }}
    </div>
@stop
