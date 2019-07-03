
<div class="card mb-3" style="max-width: 30rem;">
    <ul class="list-group list-group-flush">
        
        <li class="list-group-item">
            {{ $photo->user->name }}
            {{ Carbon\Carbon::parse($photo->updated_at)->diffForHumans() }}
            
            <!--編集ボタン-->
            @include('photos.edit_photos')
        </li>
    </ul>
    
    @if($photo->image_path1)
        <img src="{{ '../../'.$photo->image_path1 }}" alt="photo">
    @endif
    <div class="card-body">
        <p class="card-text">{{ $photo->comment }}</p>

        @unless ($photo->comments->isEmpty())
            <ul class="list-unstyled mb-0">
                @foreach($photo->comments as $comment)
                    <li class="row">
                        @if ($comment->user->user_image)
                            <img class="mw-100 mr-3 mb-1" width="40" height="40" src="{{ asset($comment->user->user_image) }}" alt="イメージ画像">
                        @else
                            <i class="fas fa-user-circle"></i>
                        @endif
                            <p class="mr-3">{{ $comment->user->name }}</p>
                            <p class="text-left">{!! nl2br(e($comment->comment)) !!}</p>
                    </li>
                @endforeach
            </ul>
        @endunless
        
        {!! Form::open(['url' => 'comment']) !!}
            <div class="form-group">
                {!! Html::decode(Form::label('comment', $myself->name.' <i class="far fa-comment"></i>')) !!}
                {!! Form::textarea('comment', null, ['class' => 'form-control border-0','placeholder' => 'コメントを追加する', 'maxlength' => '100', 'rows' => "1" ]) !!}
            </div>
            {!! Form::hidden('user_id', $myself->id) !!}
            {!! Form::hidden('photo_id', $photo->id) !!}
            <div class="form-group">
                {!! Form::submit('投稿する', ['class' => 'btn btn-outline-primary']) !!}
            </div>
        {!! Form::close() !!} 
    </div>
</div>