@extends('layouts.app')

@section('content')

<form action='tags' method='POST'>
   <div class="row">
     <div class="col-sm-8 col-sm-offset-4 col-xs-12 tags-select">
      <div class="side-by-side clearfix">
        <div class="form-group">
          <select name='list_tags[]' data-placeholder="Выбрать тег" class="chosen-select tags_selecter" multiple tabindex="4">
            <option v-cloak value=""></option>
            @foreach ($tags as $tag)
            <option v-cloak>{{$tag->name_tag}}</option>
            @endforeach
          </select>

          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button class="btn btn-sm btn-primary">Выбрать</button>
        </div>
      </div>

          <p>Выбранные теги:</p>
          <?php
          if( isset($_POST['list_tags'])) {
             $tags_select = $_POST['list_tags'];

          ?>
          @foreach ($tags_select as $tag_select)
              <button class="btn btn-default btn-xs">{{$tag_select}}</button>
          @endforeach
          <?php
          }
          ?>

    </div>

  </div>
</form>

@include('publications')

@stop
