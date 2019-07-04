    
    
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
                
                    @component('photos.form')
                        <div id="fileInput">
                            <upload-form name="photo"></upload-form>
                        </div>
                        
                    @endcomponent
                    
                {!! Form::close() !!}    
            </div>
        </div>
    </div>
    
    
