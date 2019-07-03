<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">Family Book</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                @guest
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('register') }}">新規ユーザー登録</a>
                </li>
                @endguest
                @auth
                <li class="nav-item active">
                    <a class="nav-link" href="/"><i class="fas fa-home"></i><span class="sr-only">(current)</span></a>
                </li>
                
                
                <!-- ドロップダウンメニュー -->
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $myself->name }} <span class="caret"></span>
                    </a>
                
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        {{-- ⑥ --}}
                        <a class="dropdown-item" href="{{ route('mypage') }}">プロフィール</a>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        {{-- ⑦ --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </div>
                </li>
                
                 {{Form::open(['url' => 'searched/result', 'class' => 'form-inline my-2 my-lg-0'])}}
                
                <div class="form-group">
                    {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => '投稿を検索']) !!}
                </div>
                <div class="form-group">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                </div>
            {!! Form::close() !!}
            </ul>
            
             
            
            
            <button type="button" class="btn btn-secondary my-2 my-sm-0" data-toggle="modal" data-target="#upload">投稿を作成</button>
            @include('photos.create')
            
            @endauth
        </div>
        
        
        
    </div>
</nav>