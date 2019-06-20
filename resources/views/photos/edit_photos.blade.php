@extends('layout')

@section('content')

    @include('errors.form_errors')
    
    @include('photos.card')
    
    @if( $user->id === $photo->user_id )
        <button type="button" class="btn btn-secondary my-2 my-sm-0" data-toggle="modal" data-target="#edit">
            <i class="fas fa-pencil-alt"></i>
        </button>
        投稿を編集する
        
        <div class="modal" id="edit">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">投稿を編集する</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {!! Form::model($photo, ['method' => 'PATCH', 'url' => ['photo/edit', $photo->id], 'files' => true]) !!}
                            <div class="modal-body">
                            
                                <div class="form-group">
                                    写真：
                                    {!! Form::file('photo') !!}
                                </div>
                                
                                <div class="form-group">
                                    {!! Form::label('comment', 'コメント:') !!}
                                    {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
                                </div>
                                
                                {!! Form::hidden('user_id', $user->id) !!}
        
                            </div>
                        
                            <div class="modal-footer">
                                <div class="form-group">
                                    {!! Form::submit('シェア', ['class' => 'btn btn-primary form-control']) !!}
                                </div>
                                 
                            </div>
                        {!! Form::close() !!}    
                    </div>
                </div>
        </div>
        
        
        <form action="{{ route('destroy',$photo->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endif
@endsection