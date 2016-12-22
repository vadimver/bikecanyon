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
             <input type="radio" name="visual" value="img_pick" v-model="picked">
             <input type="radio" name="visual" value="video_pick" v-model="picked">
             <input type="radio" name="visual" value="non_pick" v-model="picked">
         </div>

         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

         <input class="image_hide" id="i@{{picked}}" type="file" name="images">
         <input class="video_hide" id="v@{{picked}}" type="text" name="video" placeholder="Ссылка на видео">
         <button type="submit" class="btn btn-primary">Добавить</button>
     </form>
  </div>


</th>

  @stop
