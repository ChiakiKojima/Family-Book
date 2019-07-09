@extends('layout')

@section('content')

    @include('errors.form_errors')
    <div class="row">
        
        <div class="col-lg-6">
           <div class="d-flex align-items-center mb-3">
                @if ($user->user_image)
                    <img src="{{ $user->user_image }}" alt="プロフィール画像">
                @else
                <h1>
                    <i class="fas fa-user-circle text-primary"></i>
                </h1>
                @endif
                
                <h1 class="text-primary pl-2">{{ $user->name }}</h1>
            </div>
       </div>
       <div class="col-lg-6">
            @foreach($photos as $photo)
                @include('photos.card')
            @endforeach   
        </div>
@endsection