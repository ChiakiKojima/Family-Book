
@extends('layout')
@section('title', 'My page')



@section('content')
     @include('flash::message')
    <h1>My page
        <a href="{{ route('userEdit') }}" class="btn btn-primary float-right">編集</a>
    </h1>
    <hr/>
<div class="row">
    <div class="col-lg-6">
        <p>名前: {{ $myself->name }}</p>
        <p>メールアドレス: {{ $myself->email }}</p>
    </div>
    <div class="col-lg-6">
        
        プロフィール画像：
        
        @if ( $myself->user_image == null )
            登録されていません。
        @else
            <img class="col-3" src="{{ $myself->user_image }}" alt="イメージ画像">
        @endif
    </div>
</div>

<div class="float-right">
    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#destroyUser">退会する</button>
</div>                
 
<div class="modal" id="destroyUser">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong>本当によろしいですか？</strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>ユーザー情報、今までの投稿を全て削除します。</p>
                    
                    <button type="button" class="btn btn-info float-right" data-dismiss="modal">削除をキャンセル</button>
                    
                    {{ Form::open((['method' => 'delete', 'route' => 'deleteUserAccount'])) }}
                        <button type="submit" class="btn btn-outline-danger">削除</button>
                    {!! Form::close() !!}
                </div>
            </div>
    </div>
</div>
@endsection

