@extends('components/layout')
@section('content')
  @auth
    @if (Auth::user()->google_id == $post->google_id)
      <form
        class="
          mt-4
        "
        method="post"
        action="/update/{{$post->post_id}}"
      >
        @method('PUT')
        @csrf
          @if ($errors->any())
          @endif
          <textarea 
            class="
              w-full
            "
            name="content"
            required
            autofocus
          >
            {{$post->content}}
          </textarea>
          <div
            class="
              items-start
              justify-between
              flex
              mt-2
              mb-4
            "
          >
            <button 
              onclick="location.href='{{route('show', ['id'=>$post->post_id])}}'"
            >
              취소
            </button>
            <input type="submit" value="수정하기">
          </div>
      </form>
    @endif
  @endauth
@endsection

@section('footer')
  @include('components/footer')
@endsection

@section('header')
  @include('components/header')
@endsection