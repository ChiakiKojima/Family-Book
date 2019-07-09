<h1 class="text-primary mt-5">Member</h1>
@foreach ($users as $user)
  <a href="{{ url('user', $user->id) }}">
      <div class="d-flex align-items-center mb-0">
          @if ($user->user_image)
              <img class="mr-3" width="40" height="40" src="{{ $user->user_image }}" alt="プロフィール画像">
          @else
              <h1>
                  <i class="fas fa-user-circle mr-3 text-primary"></i>
              </h1>
          @endif
              <h2>{{ $user->name }}</h2>
      </div>
      <br>
  </a>
@endforeach