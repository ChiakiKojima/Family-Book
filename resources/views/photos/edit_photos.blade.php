
    
    @if( $myself->id === $photo->user_id)
        <div class="float-right">
        <button type="button" class="btn btn-secondary my-2 my-sm-0" data-toggle="modal" data-target="#edit">
            <i class="fas fa-pencil-alt"></i>
        </button>
        
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
        </div>
    @endif
