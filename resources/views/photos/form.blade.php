


<div class="modal-body">
                    
    <div class="form-group">

        {{ $slot }}
        
    </div>
    
    <div class="form-group">
        {!! Form::label('description', 'コメント:') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
    {!! Form::hidden('user_id', Auth::user()->id) !!}

    <div class="form-group">
        {!! Form::submit('シェア', ['class' => 'btn btn-primary form-control']) !!}
    </div>    
</div>
