@extends('layout')

@section('content')

    @include('errors.form_errors')
    
   <h3 class="text-primary">{{ $year.'年'.$month.'月'.$day.'日' }}</h3>
   
   @foreach($photos as $photo)
       @include('photos.card')
    @endforeach   
@endsection