@extends('layout')

@section('content')

    @include('errors.form_errors')
    
    @if($result->isEmpty())
        「{{ $keyword['search'] }}」に一致する結果はありませんでした
    @else
        @foreach ($result as $photo)
                
            @include('photos.card')
           
        @endforeach
    @endif
    
@endsection