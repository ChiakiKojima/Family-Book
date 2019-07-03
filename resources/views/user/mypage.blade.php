
@extends('layout')
@section('title', 'My page')



@section('content')
     @include('flash::message')
    <h1>
        My page
        <a href="{{ route('userEdit') }}" class="btn btn-primary float-right">編集</a>
    </h1>
    <hr/>
<div class="row">
    <div class="col-lg-6">
        <div>
            名前:
            {{ $myself->name }}
        </div>
        <div>
        メールアドレス:
        {{ $myself->email }}
        
        </div>
    </div>
    <div class="col-lg-6">
        
        プロフィール画像：
        
        @if ( $myself->user_image == null )
            登録されていません。
        @else
            <img class="card-img-top col-lg-3" src="{{ $myself->user_image }}" alt="イメージ画像">
        @endif
    </div>
</div>
@endsection

