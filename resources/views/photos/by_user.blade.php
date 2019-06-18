@extends('layout')

@section('content')

    @include('errors.form_errors')
    
   {{ $user->name }}
   
   @foreach($photos as $photo)
       <div class="card mb-3" style="max-width: 20rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        {{ $photo->updated_at }}
                    </li>
                </ul>
                
                <img src="" alt="photo">
                <div class="card-body">
                    <p class="card-text">{{ $photo->comment }}</p>
                </div>
                
                
                <div class="card-body">
                    <form class="form-inline">
                        <div class="form-group">
                            <label class="col-form-label" for="inputDefault">{{ $user->name }}</label>
                            <input type="text" class="form-control border-0" placeholder="コメントを追加する" id="inputDefault">
                        </div>
                    </form>
                </div>
            </div>
    @endforeach   
@endsection