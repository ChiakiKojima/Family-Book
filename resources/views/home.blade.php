@extends('layout')

@section('content')

    @include('errors.form_errors')

    <div class="row">
        
        
        <div class="col-lg-8">
          @foreach ($photos as $photo)
                
                @include('photos.card')
           
          @endforeach
        </div>
        
        
        <div class="col-lg-4 d-none d-lg-block">
            <!--カレンダー-->
            @include('pages.calender')

            @include('pages.member')
        </div>  
    </div>

@endsection