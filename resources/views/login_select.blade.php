@extends('components/layout')
@section('content')
  @guest
    <div 
      class='
        max-w-full h-96 
        justify-center 
        items-center
        flex 
        '
      >
      <a 
        class =''
        href="http://127.0.0.1:8000/auth/login/google"
      >
        <img src="{{URL::asset('/images/google_btn.png')}}" alt="">
      </a>
    </div>
  @endguest
@endsection

@section('footer')
  @include('components/footer')
@endsection

@section('header')
  @include('components/header')
@endsection
