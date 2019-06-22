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
          <h1 class="text-secondary">Member</h1>
          @foreach ($users as $user)
              <a href="{{ url('user', $user->id) }}">
                  <div class="d-flex">
                      @if ($user->user_image)
                          <div class="my-box w-25">
                              <img class="rounded w-50" src="{{ $user->user_image }}" alt="イメージ画像">
                          </div>
                      @else
                          <h2 class="my-box w-25">
                              <i class="fas fa-user-circle text-primary"></i>
                          </h2>
                      @endif
                          <h2 class="my-box w-25">{{ $user->name }}</h2>
                  </div>
                  <br>
              </a>
          @endforeach
        </div>  
    </div>

@endsection