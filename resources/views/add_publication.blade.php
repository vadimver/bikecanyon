@extends('layouts.app')
@section('content')
     <form enctype="multipart/form-data" accept-charset="UTF-8" action="{{ url('/new_publication') }}" method="POST">
         <div>
             <div class="col-md-12">
                 <select name="tags">
                     @foreach ($tags as $tag)
                     <option value="{{$tag->id_tag}}">{{$tag->name_tag}}</option>
                     @endforeach
                 </select>
             </div>
         </div><br>
         <div>
             <div class="col-md-12">
             <input type="text" name="text" class="form-control"  placeholder="Текст">
             </div>
         </div>

         <div>
             <input type="radio" name="visual" value="img">
             <input type="radio" name="visual" value="video">
             <input type="radio" name="visual" value="non">
         </div>

         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

         <input type="file" name="images">
         <input class="video" type="text" name="video" placeholder="Ссылка на видео">
         <button type="submit" class="btn btn-primary">Добавить</button>
     </form>
  </div>

  @stop
