@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <form>

          <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
              <label for="text" class="col-md-4 control-label">Имя</label>
              <div class="col-md-6">
              <input id="name" type="name" class="form-control" name="text" value="{{ old('name') }}" required autofocus>

              @if ($errors->has('name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
              @endif
              </div>
          </div><br>

          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
              <label for="tags" class="col-md-4 control-label">Описание</label>
              <div class="col-md-6">
              <textarea id="description" name="description" required autofocus ></textarea>
              @if ($errors->has('description'))
                  <span class="help-block">
                      <strong>{{ $errors->first('description') }}</strong>
                  </span>
              @endif
              </div>
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
