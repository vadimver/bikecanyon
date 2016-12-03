@extends('layouts.app')

@section('content')


<form action='tags' method='POST'>
  <div id="container">
    <div id="content">
      <div class="side-by-side clearfix">
        <div>
          <em>Into This</em>

          <select name='test[]' data-placeholder="Choose a Country..." class="chosen-select" multiple style="width:350px;" tabindex="4">
            <option value=""></option>
            @foreach ($tags as $tag)
            <option value="{{$tag->id_tag}}">{{$tag->name_tag}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type='submit'>
</form>

@include('publications')

@stop
