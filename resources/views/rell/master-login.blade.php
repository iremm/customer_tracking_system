<!DOCTYPE html>
<html lang="en">
    <!--Header include-->
    @include('rell.layout.src.header')

    <body>
        <div id="particles-js"></div>
        <!--Page content-->
        @yield('content')
        @include('rell.layout.src.footer-login')
    </body>
</html>
