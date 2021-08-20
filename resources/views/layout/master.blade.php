<!DOCTYPE html>
<html lang="en">
@include('layout.header')

<body>  


    @include('layout.menu')
{{-- 
    <div id="load" class="spinner-border text-primary" role="status" style="visibility: hidden">
        <span class="sr-only"></span>
    </div> --}}

    <div id="wrapper">
        <div class="container">
            @yield('content')
        </div>
    </div>
    @include('layout.footer')

    @include('layout.pagescript')

</body>
</html>