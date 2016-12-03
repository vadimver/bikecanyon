@extends('layouts.app')

@section('content')
@if (isset(Auth::user()->id))
      @include('add_publication')
@endif
@include('publications')

@stop
