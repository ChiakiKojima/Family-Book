@extends('layout')

@section('content')

    @include('errors.form_errors')

    <div class="row">
        
        
        <div class="col-lg-8">
          @foreach ($photos as $photo)
            <div class="card mb-3" style="max-width: 20rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        {{ $photo->user_id }}
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