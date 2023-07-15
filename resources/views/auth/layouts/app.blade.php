<!DOCTYPE html>
<html lang="en">

{{-- Head Before AUTH--}}
@include('auth.includes.head')


<body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container"> 

        {{-- Content Goes Here FOR Before AUTH --}}
        @yield('content')

        </div>
    </div>
    <!-- end account-pages -->

    {{-- Scripts Before AUTH --}}
    @include('auth.includes.scripts')

</body>

</html>