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
  
<div class="container">
    <div class="row">
      <div class="col-sm-4 col-sm-offset-4">
          <form class="add_profile_form" enctype="multipart/form-data" accept-charset="UTF-8" action="{{ url('/new_profile') }}" method="POST">
               <input type="name" class="form-control" name="name_profile" placeholder="Имя профиля">
               <input class="create_profile_file" type="file" name="images">
               <textarea class="add_profile_textarea form-control" name="description" required autofocus maxlength="200" rows='7' placeholder="Описание профиля. Максимум 200 символов."></textarea><br>
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">

               <button type="submit" class="btn btn-primary">Добавить</button>
          </form>
      </div>
    </div>
</div>
@endsection
