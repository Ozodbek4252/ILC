<!-- JAVASCRIPT -->
<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>

<!-- apexcharts -->
{{--  <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>  --}}

{{--  <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>  --}}
<script src="{{ asset('assets/libs/toastr/toastr.js') }}"></script>

<!-- ckeditor -->
<script src="{{ asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

<!-- init js -->
<script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>

{{--  Pdf  --}}
<script src="{{ asset('assets/libs/pdf/js/pdf.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

@livewireScripts

<script type="text/javascript">
    $(document).ready(function() {
        @if (count($errors) > 0)
            toastr.error("{!! implode('<br/>', $errors->all()) !!}");
        @endif

        @if (session()->has('message'))
            toastr.success("{{ session('message') }}");
        @endif
    });
</script>

@yield('js')
