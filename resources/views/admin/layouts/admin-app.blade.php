<!DOCTYPE html>
<html lang="en">
@include('admin.vendor.head')
<body>
<section>
    <div id="wrapper">
            @include('admin.vendor.header')
            @yield('content')

    </div>s
</section>
@include('admin.vendor.script')
</body>
</html>
