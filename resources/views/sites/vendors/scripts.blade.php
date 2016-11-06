<!-- jQuery -->
<script src="{{ url('site/vendor/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ url('site/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Contact Form JavaScript -->
<script src="{{ url('site/js/jqBootstrapValidation.js') }}"></script>
<script src="{{ url('site/js/contact_me.js') }}"></script>

<!-- Theme JavaScript -->
<script src="{{ url('site/js/clean-blog.min.js') }}"></script>
{{--<script src="{{ asset('/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>--}}

<!-- Include this after the sweet alert js file -->
@include('sweet::alert')
        <!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->

@stack('scripts')

<script>



</script>