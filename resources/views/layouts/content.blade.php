@include('layouts.header')
<main class="main container">
    @include('messages')

    @yield('content')
</main>
@include('layouts.footer')