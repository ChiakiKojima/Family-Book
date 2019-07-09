
<div class="card ml-lg-3 mb-3 mx-auto" style="max-width: 30rem;">
    <ul class="list-group list-group-flush">
        
        <li class="list-group-item">
            @if ($photo->user->user_image)
                <img width="35" height="35" src="{{ $photo->user->user_image }}" alt="プロフィール画像">
            @else
                <i class="fas fa-user-circle mr-1"></i>
            @endif
            {{ $photo->user->name }}
            
            <div class="float-right">
                {{ Carbon\Carbon::parse($photo->updated_at)->diffForHumans() }}
            <!--編集ボタン-->
            @if( $myself->id === $photo->user_id)
                <button type="button" class="btn btn-secondary my-2 my-sm-0" data-toggle="modal" data-target="#{{ 'edit'.$photo->id }}" >
                    <i class="fas fa-pencil-alt"></i>
                </button>
                
                <div class="modal" id="{{ 'edit'.$photo->id }}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">投稿を編集する</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            {!! Form::model($photo, ['method' => 'PATCH', 'url' => ['photo/edit', $photo->id], 'files' => true]) !!}
                                @component('photos.form')
                                    <div id="editForm">
                                        <edit-form></edit-form>
                                    </div>
                                @endcomponent
                            {!! Form::close() !!}
                            
                            <div class="modal-footer">
                                <form action="{{ route('destroy',$photo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    投稿を削除する
                                </form>    
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </li>
    </ul>
    
    @if($photo->image_path1)
        <img src="{{ $photo->image_path1 }}" alt="photo">
    @endif
    <div class="card-body">
        <p class="card-text">{{ $photo->description }}</p>
    
        @unless ($photo->comments->isEmpty())
        <div class="card-text">
            <ul class="mb-0">
                @foreach($photo->comments as $comment)
                    <li class="row">
                        @if ($comment->user->user_image)
                            <img class="mw-100 mr-1 mb-1" width="30" height="30" src="{{ $comment->user->user_image }}" alt="プロフィール画像">
                        @else
                            <p class="mr-1"><i class="fas fa-user-circle"></i></p>
                        @endif
                            <p class="mr-3">{{ $comment->user->name }}</p>
                            <p class="text-left">{!! nl2br(e($comment->comment)) !!}</p>
                    </li>
                @endforeach
            </ul>
        </div>
        @endunless
        
        {!! Form::open(['url' => 'comment']) !!}
            <div class="form-group text-primary">
                {!! Html::decode(Form::label($photo->id, $myself->name.' <i class="far fa-comment"></i>')) !!}
                {!! Form::textarea('comment', null, ['class' => 'form-control border-0','placeholder' => 'コメントを追加する', 'maxlength' => '100', 'rows' => "1", 'id' => $photo->id ]) !!}
            </div>
            {!! Form::hidden('user_id', $myself->id) !!}
            {!! Form::hidden('photo_id', $photo->id) !!}
            <div class="form-group">
                {!! Form::submit('投稿する', ['class' => 'btn btn-outline-primary']) !!}
            </div>
        {!! Form::close() !!} 
    </div>
</div>