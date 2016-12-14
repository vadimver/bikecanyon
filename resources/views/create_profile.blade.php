@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <form enctype="multipart/form-data" accept-charset="UTF-8" action="{{ url('/new_profile') }}" method="POST">


              <label for="text" class="col-md-4 control-label">Имя</label>
              <div class="col-md-6">
              <input type="name" class="form-control" name="name_profile">
              </div>
        <br>
          <input type="file" name="images">
              <label for="tags" class="col-md-4 control-label">Описание</label>
              <div class="col-md-6">
              <textarea name="description" required autofocus ></textarea>
              </div>
          <div>
              <label for="tags" class="col-md-4 control-label">Пол</label>
              <div class="col-md-6">
              <input type="radio" name="sex" value="1">
              <input type="radio" name="sex" value="0">
              </div>
          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

           <button type="submit" class="btn btn-primary">Добавить</button>

      </form>
    </div>
</div>
@endsection
