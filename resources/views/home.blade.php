@extends('layout')

@section('content')

    @include('errors.form_errors')

    <div class="row">
        
        
        <div class="col-lg-8">
          @foreach ($photos as $photo)
                
                @include('photos.card')
           
          @endforeach
        </div>
        
        <div class="col-lg-4">
          @foreach ($users as $user)
              <a href="{{ url('user', $user->id) }}">
                  <h2>{{ $user->id }}{{ $user->name }}</h2>
                  @if ($user->user_image)
                      <img class="card-img-top col-lg-3" src="{{ $user->user_image }}" alt="イメージ画像">
                  @else
                      <i class="fas fa-user-circle fa-4x"></i>
                  @endif
                  <br>
              </a>
          @endforeach
        </div>  
    </div>

@endsection