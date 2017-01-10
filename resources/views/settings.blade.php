@extends('layouts.app')

@section('content')
<div class="settings-main">
  <form accept-charset="UTF-8" action="{{ url('/update_settings') }}" method="POST">
      @foreach ($settings as $setting)
      <input type="text" name="password" placeholder="***********"><br><br>
      <input type="text" name="name" value="{{$setting->name}}"><br><br>
      <input type="email" name="email" value="{{$setting->email}}"><br><br>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="id_user" value="{{$setting->id}}">
      <button type="submit" class="btn btn-primary">Сохранить изменения</button>
      @endforeach
  </form>
</div>
<div class="statistic-main">
      <p>
      <button class="my_button button_text date_registration" data-toggle="date_registration" title="Дата регистрации">
          @foreach ($date as $dt)
            <i class="fa fa-user-circle setting_circle" aria-hidden="true"></i>
            {{$dt->created_at->format('d/m/Y H:i')}}
          @endforeach
      </button>
      </p>
      <p>
      <button class="my_button button_text quantity_publication" data-toggle="quantity_publication" title="Публикации">
        <i class="fa fa-id-card-o" aria-hidden="true"></i>
        {{$publications}}
      </button>
      </p>
      <p>
      <button class="my_button button_text quantity_profiles" data-toggle="quantity_profiles" title="Профили">
        <i class="fa fa-users" aria-hidden="true"></i>
        {{$profiles}}
      </button>
      </p>
      <p>
      <button class="public_like my_button quantity_likes" data-toggle="quantity_likes" title="Лайки">
        <i class="fa fa-heart" aria-hidden="true"></i><span class="public_like_number">{{$likes}}</span>
      </button>
      </p>
      <p>
      <button class="public_comment my_button quantity_comments" data-toggle="quantity_comments" title="Комментарии">
       <i class="fa fa-comment i_all_comment" aria-hidden="true"></i>
       <span class="public_comment_number">{{$comments}}</span>
     </button>
      </p>

</div>
@stop
