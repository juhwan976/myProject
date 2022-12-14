@section('header')
  <div 
    class="w-full 
      bg-blue-400 
        h-12 
        items-center 
        justify-between
        flex
        fixed top-0
        ">
    <button
      class="
        mx-4
        font-bold
      "
      onclick="location.href='{{route('list')}}'"
    >
      홈
    </button>
    @guest
      <div>
        <button
          class="mx-4"
          onclick="location.href='{{route('login_select')}}'"
        >
          로그인
        </button>
      </div>
    @endguest
    @auth
      <div>
        <button
          class="mx-4"
          onclick="location.href='{{route('create')}}'"
        >
          글쓰기
        </button>
        <button
          class="mx-4"
          onclick="location.href='{{route('logout')}}'"
        >
          로그아웃
        </button>
      </div>
    @endauth
  </div>
@endsection