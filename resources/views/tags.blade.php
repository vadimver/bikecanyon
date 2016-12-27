@extends('layouts.app')

@section('content')


<form action='tags' method='POST'>
  <div id="container">
    <div id="content">
      <div class="side-by-side clearfix">
        <div class="form-group">

          <select name='test[]' data-placeholder="Выбрать тег" class="chosen-select" multiple tabindex="4">
            <option value=""></option>
            @foreach ($tags as $tag)
            <option value="{{$tag->id_tag}}">{{$tag->name_tag}}</option>
            @endforeach
          </select>

          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button class="btn btn-sm btn-primary">Выбрать</button>
        </div>
      </div>
          <p>Выбранные теги:</p>
          <?php
          if( isset($_POST['test'])) {
             $tags_select = $_POST['test'];

          ?>
          @foreach ($tags_select as $tag_select)
              @foreach ($tags as $tag)
                 @if ($tag_select == $tag->id_tag)
                   {{$tag->name_tag}} <br>
                 @endif
              @endforeach
          @endforeach
        <?php
        }
        ?>
    </div>
  </div>
</form>
<div class="selected_tags">

</div>
@include('publications')

@stop
