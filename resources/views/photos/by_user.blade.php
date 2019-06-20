@extends('layout')

@section('content')

    @include('errors.form_errors')
    
   {{ $user->name }}
   
   @foreach($photos as $photo)
       @include('photos.card')
    @endforeach   
@endsection