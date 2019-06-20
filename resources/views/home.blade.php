@extends('layout')

@section('content')

    @include('errors.form_errors')

    <div class="row">
        
        
        <div class="col-lg-8">
          @foreach ($photos as $photo)
            
                @include('photos.card')
            </a>
          @endforeach
        </div>
        
        <div class="col-lg-4">
          @foreach ($users as $user)
              <a href="{{ url('user', $user->id) }}">
                  {{ $user->id }}
                  {{ $user->name }}<br>
              </a>
          @endforeach
        </div>  
    </div>

@endsection