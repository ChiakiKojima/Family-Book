<h1 class="text-primary mt-5">Member</h1>
@foreach ($users as $user)
  <a href="{{ url('user', $user->id) }}">
      <div class="d-flex">
          @if ($user->user_image)
              <div class="my-box w-25">
                  <img class="rounded w-50" src="{{ asset($user->user_image) }}" alt="プロフィール画像">
              </div>
          @else
              <h2 class="my-box w-25">
                  <i class="fas fa-user-circle text-primary"></i>
              </h2>
          @endif
              <h2 class="my-box">{{ $user->name }}</h2>
      </div>
      <br>
  </a>
@endforeach