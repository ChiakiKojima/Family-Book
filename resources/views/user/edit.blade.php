@extends('layout')
@section('title', 'My page')

@section('content')
     @include('flash::message')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザー情報の編集</div>
    
                <div class="card-body">
                    <form method="POST" action="＃">
                        @csrf
    
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">名前</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="user_image" class="col-md-4 col-form-label text-md-right">プロフィール画像</label>
    
                            <div class="col-md-6">
                                {!! Form::file('thefile') !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                {!! Form::submit('更新', ['class' => 'btn btn-primary btn-block form-control']) !!}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
