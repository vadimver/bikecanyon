@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <form enctype="multipart/form-data" accept-charset="UTF-8" action="{{ url('/edit_profile_post') }}" method="POST">


              <label for="text" class="col-md-4 control-label">Имя</label>
              <div class="col-md-6">
              <input id="name" type="name" class="form-control" name="name" value="{{ $edit->name_profile }}" required autofocus>
              </div>
          <br>
          <input type="file" name="images">
              <label for="tags" class="col-md-4 control-label">Описание</label>
              <div class="col-md-6">
              <textarea id="description" name="description">{{ $edit->description }}</textarea>
              </div>
          <div>
              <label for="tags" class="col-md-4 control-label">Пол</label>
              <div class="col-md-6">
              <input type="radio" name="sex" value="1">
              <input type="radio" name="sex" value="0">
              </div>
          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="likes" value="{{ $edit->likes }}">
          <input type="hidden" name="id_profile" value="{{ $edit->id_profile }}">
          <input type="hidden" name="subscribes" value="{{ $edit->subscribes }}">
          <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

           <button type="submit" class="btn btn-primary">Изменить</button>

      </form>
    </div>
</div>
@endsection
