<!DOCTYPE html>
<html>
  <head>
    @vite('resources/css/app.css')
  </head>
  <body>
    @yield('header')
    <div
      class='mx-auto
          max-w-screen-xl
          pt-12
          px-12'
    >
      @yield('content')
    </div>
    @yield('footer')
  <body>
</html>