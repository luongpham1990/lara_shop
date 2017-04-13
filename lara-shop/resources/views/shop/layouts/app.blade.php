<!DOCTYPE html>
<html lang="en">
@include('shop.vendor.head')

<body>
@include('shop.vendor.header')

@yield('slider')

<section>
    <div class="container">
        <div class="row">
            @yield('content')

        </div>
    </div>
</section>

@include('shop.vendor.footer')
@include('shop.vendor.script')
</body>
</html>
