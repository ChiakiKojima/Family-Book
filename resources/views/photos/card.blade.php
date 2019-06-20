
<div class="card mb-3" style="max-width: 30rem;">
    <ul class="list-group list-group-flush">
        
        <li class="list-group-item">
            {{ $photo->user->name }}
            {{ $photo->updated_at }}
        </li>
    </ul>
        @if($photo->image_path1)
            <img src="{{ $photo->image_path1 }}" alt="photo">
        @endif
        <a href="{{ url('photo', $photo->id) }}">
        <div class="card-body">
            <p class="card-text">{{ $photo->comment }}</p>
        </div>
    </a>
    
    
    <div class="card-body">
            {{ $photo->comment }}
        <form class="form-inline">
            <div class="form-group">
                {!! Form::open(['url' => 'comment']) !!}
                    {!! Form::label('comment', $user->name) !!}
                    {!! Form::text('comment', null, ['class' => 'form-control border-0','placeholder' => 'コメントを追加する']) !!}
                    {!! Form::submit('投稿する', ['class' => 'btn btn-primary form-control']) !!}
                {!! Form::close() !!} 
            </div>
        </form>
    </div>
</div>