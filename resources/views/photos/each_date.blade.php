@extends('layout')

@section('content')

    @include('errors.form_errors')
    
   {{ $year.'年'.$month.'月'.$day.'日' }}
   
   @foreach($photos as $photo)
       @include('photos.card')
    @endforeach   
@endsection