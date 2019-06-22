
<div class="card mb-3" style="max-width: 30rem;">
    <ul class="list-group list-group-flush">
        
        <li class="list-group-item">
            {{ $photo->user->name }} 
            {{ $photo->updated_at }}
            
            @include('photos.edit_photos')
        </li>
    </ul>
        @if($photo->image_path1)
            <img src="{{ '../'.$photo->image_path1 }}" alt="photo">
        @endif
        <div class="card-body">
            <p class="card-text">{{ $photo->comment }}</p>
        </div>

    <div class="card-body">
            @unless ($photo->comments->isEmpty())
                <ul>
                    @foreach($photo->comments as $comment)
                        <li>
                            @if ($comment->user->user_image)
                                <img class="card-img-top col-lg-2" src="{{ $comment->user->user_image }}" alt="イメージ画像">
                            @else
                                <i class="fas fa-user-circle"></i>
                            @endif
                                {{ $comment->user->name }}{{ $comment->comment }}
                        </li>
                    @endforeach
                </ul>
            @endunless
        <div class="form-inline">
            <div class="form-group">
                {!! Form::open(['url' => 'comment']) !!}
                    <div class="form-group">
                        {!! Form::label('comment', $myself->name) !!}
                        {!! Form::text('comment', null, ['class' => 'form-control border-0','placeholder' => 'コメントを追加する']) !!}
                    </div>
                        {!! Form::hidden('user_id', $myself->id) !!}
                        {!! Form::hidden('photo_id', $photo->id) !!}
                    <div class="form-group">
                        {!! Form::submit('投稿する', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                {!! Form::close() !!} 
            </div>
        </div>
    </div>
</div>