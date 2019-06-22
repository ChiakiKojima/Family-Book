    
    
    <div class="modal" id="upload">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">投稿を作成する</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['url' => 'upload', 'files' => true]) !!}
                    <div class="modal-body">
                    
                        <div class="form-group">
                            {!! Html::decode(Form::label('photo','<i class="fas fa-camera"></i>　写真を選択する')) !!}
                            {!! Form::file('photo', ['class' => 'd-none']) !!}
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('comment', 'コメント:') !!}
                            {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::hidden('user_id', Auth::user()->id) !!}

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
    
    
