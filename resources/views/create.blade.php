@extends('components/layout')
@section('content')
  @auth
    <form 
      class="mt-4"
      method="POST" 
      action="{{ 
        route('send') 
      }}"
    >
      @csrf
        @if ($errors->any())
        @endif
        <textarea
          class="
            w-full
            h-36
          "
          name="content"\
          required
          autofocus
        ></textarea>
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
            type="button"
            onclick="location.href='{{route('list')}}'"
          >취소</button>
          <input type="submit" value="작성하기">
        </div>
    </form>
  @endauth
  @guest
    <h1>잘못된 접근입니다.</h1>
  @endguest

@endsection

@section('footer')
  @include ('components/footer')
@endsection

@section('header')
  @include('components/header')
@endsection