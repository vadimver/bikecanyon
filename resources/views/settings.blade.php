@extends('layouts.app')

@section('content')
<div>
  <form accept-charset="UTF-8" action="{{ url('/update_settings') }}" method="POST">
      @foreach ($settings as $setting)
      <input type="text" name="password" placeholder="***********"><br><br>
      <input type="text" name="name" value="{{$setting->name}}"><br><br>
      <input type="email" name="email" value="{{$setting->email}}"><br><br>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="id_user" value="{{$setting->id}}">
      <button type="submit" class="btn btn-success">Сохранить изменения</button>
      @endforeach
  </form>
</div>
@stop
