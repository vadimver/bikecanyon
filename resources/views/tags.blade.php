@extends('layouts.app')

@section('content')
@if (isset(Auth::user()->id))
      @include('publication')
@endif

<!-- # sort -->
<div class="container accordion">
  <div id="demo" class="collapse">
    <div class="sort">
      <form class="navbar-form">
        <input type="text" class="form-control" placeholder="Поиск">
      </form>
      <hr/>
      <p>Вывод по тегам

    </p>
      <form class="sort_tags">
        <button type="submit" class="btn btn-primary">Рейтинг</button>
        <button type="submit" class="btn btn-primary">Подписчики</button>
        <button type="submit" class="btn btn-primary">Имя</button>
      </form>
    </div>
  </div>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Добавить тег</button>
  </div>

  <!-- / sort -->
  <!-- # content_block -->
  <div class="container content_block">
  <div class="row">
    <div class="col-sm-12">
      <div class="list-group content_head">
        <a href="#" class="list-group-item active">
          <i class="fa fa-user-circle" aria-hidden="true"></i>
          <span>Vadim </span>
          <span>1 час назад</span>
          <span class="content_tags">#Вело #Фото</span>
        </a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <p class="content_text">Припарковал велик ночь</p>
      <img src="../img/bike2.jpg" alt="..." class="img-rounded content_img">
    </div>
  </div>
  <div class="list-group content_footer">
    <div class="list-group-item active">
      <i class="fa fa-plus" aria-hidden="true"> 1 </i>
      <i class="fa fa-minus" aria-hidden="true"> 15 </i>
      <i class="fa fa-comment-o" data-toggle="collapse" data-target="#demo2" aria-hidden="true">15</i>
      <i data-toggle="collapse" data-target="#demo2" aria-hidden="true">Добавить комментарий</i>
    </div>
      <div id="demo2" class="collapse">
          <div class="comment">
             <i class="fa fa-user-circle" aria-hidden="true"></i>
             <span>Vadim </span>
             <i class="fa fa-plus i_comment" aria-hidden="true"> 1 </i><br>
             <i class="fa fa-minus i_comment" aria-hidden="true"> 15 </i>
             <p class="comment_text">Всем привет первый коммент</p>
             <hr>
         </div>
         <div class="comment">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            <span>Vadim </span>
            <i class="fa fa-plus i_comment" aria-hidden="true"> 1 </i><br>
            <i class="fa fa-minus i_comment" aria-hidden="true"> 15 </i>
            <p class="comment_text">Всем привет первый коммент</p>
            <input type="text" class="form-control add_comment" placeholder="Добавить комментарий">
        </div>
      </div>

  </div>
</div>
<!-- / content_block -->
@stop
