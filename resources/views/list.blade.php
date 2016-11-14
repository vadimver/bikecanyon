@extends('app')

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
      <div class="row profile">
        <div class="col-sm-3 profile_ava">
          <img src="../img/bike.jpg" alt="..." class="img-circle profile_img">
        </div>
        <div class="col-sm-3 profile_info">
          <p><strong>Найнеры</strong></p>
          <p>Материалы о Украинский найнерах</p>
        </div>
        <div class="col-sm-3 profile_stat">
          <p>Лайки 15</p>
          <p>Подписки 3</p>
        </div>
        <div class="col-sm-3 profile_subscribe">
          <button type="submit" class="btn btn-primary profile_button">Подписаться</button>
        </div>
      </div>
    </div>
    <!-- / profiles_block -->
@stop
