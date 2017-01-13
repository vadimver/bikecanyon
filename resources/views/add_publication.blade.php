@extends('layouts.app')
@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ url('create_profile') }}" class="my_profiles_new">
    <button class="btn btn-primary btn-sm">Создать профиль</button>
</form>

     <form enctype="multipart/form-data" accept-charset="UTF-8" action="{{ url('/new_publication') }}" method="POST">
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
             <div class="col-md-12">

                 <select name="id_profile" v-model="selected" class="form-control">
                     <option selected value="non" disabled>Выберите профиль</option>
                     @foreach ($profiles as $profile)
                     <option value="{{$profile->id_profile}}">{{$profile->name_profile}}</option>
                     @endforeach

                 </select>
             </div>
         <!-- # before-choise -->

         <div class="before-choise-@{{selected}} col-md-12">
           <div class="form-group-add">
                <select name='list_tags[]' data-placeholder="Выбрать тег" class="chosen-select" multiple>
                  <option value=""></option>
                  @foreach ($tags as $tag)
                  <option>{{$tag->name_tag}}</option>
                  @endforeach
                </select>
          </div>

        <div class="add_visual_block">
               <div class="radio">
                <label>
                  <input type="radio" id="optionsRadios1" name="visual" value="img_pick" v-model="picked" checked>
                  Вставить фото
                </label>
               </div>
               <div class="radio">
                <label>
                  <input type="radio" id="optionsRadios1" name="visual" value="video_pick" v-model="picked" checked>
                  Вставить видео
                </label>
               </div>
               <div class="radio">
                <label>
                  <input type="radio" id="optionsRadios1" name="visual" value="non_pick" v-model="picked" checked>
                  Только текст
                </label>
               </div>

               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

               <input class="image_hide" id="i@{{picked}}" type="file" name="images">
               <input class="form-control video_hide" id="v@{{picked}}" type="text" name="video" placeholder="Ссылка на видео">
               <textarea name="text" class="form-control" maxlength="3000" rows='10' placeholder="Максимум 3000 символов"></textarea>
               <button type="submit" class="btn btn-primary add_pub_button">Добавить</button>
        </div>

        <!-- / before-set -->
        </div>
      </div>
    </form>


  @stop
