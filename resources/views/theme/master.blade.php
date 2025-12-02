<!DOCTYPE html>
<html lang="en">
@include('theme.partial.head')
<body>

  @include('theme.partial.header')

    @yield('content')

  @include('theme.partial.footer')

  @include('theme.partial.scripts')

</body>
</html>