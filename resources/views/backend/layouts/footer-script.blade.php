
    <!-- JAVASCRIPT -->
    <script src="{{ asset('backend') }}/libs/jquery/jquery.min.js"></script>
    {{--<script src="{{ asset('backend') }}/libs/bootstrap/bootstrap.min.js"></script>--}}
    <script src="{{ asset('backend') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    {{--<script src="{{ asset('backend') }}/libs/bootstrap/js/bootstrap.min.js"></script>--}}
    <script src="{{ asset('backend') }}/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ asset('backend') }}/libs/simplebar/simplebar.min.js"></script>
    {{--<script src="{{ asset('backend') }}/libs/node-waves/node-waves.min.js"></script>--}}
    <script src="{{ asset('backend') }}/libs/node-waves/waves.min.js"></script>

     {{--FOR home.blade only--}}
    {{--<!-- plugin js / apexcharts -->
    <script src="{{ asset('backend') }}/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Calendar init / dashboard -->
    <script src="{{ asset('backend') }}/js/pages/dashboard.init.js"></script>--}}

    @stack('script')

    <!-- toastr -->
        <!-- toastr plugin -->
        <script src="{{ asset('backend') }}/libs/toastr/build/toastr.min.js"></script>
        <!-- toastr init -->
        <script src="{{ asset('backend') }}/js/pages/toastr.init.js"></script>
        <!-- toastr -->
        <script>
            @if(Session::has('message'))

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": 300,
                    "hideDuration": 1000,
                    "timeOut": 5000,
                    "extendedTimeOut": 1000,
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                var type="{{Session::get('alert-type','info')}}"
                switch(type){
                    case 'info':
                        toastr.info("{{ Session::get('message') }}");
                        break;
                    case 'success':


                        toastr.success("{{ Session::get('message') }}");
                        break;
                    case 'warning':
                        toastr.warning("{{ Session::get('message') }}");
                        break;
                    case 'error':
                        toastr.error("{{ Session::get('message') }}");
                        break;
                }
            @endif
        </script>

    <!-- sweetalert -->
        <!-- Sweet Alerts js -->
        <script src="{{ asset('backend') }}/libs/sweetalert2.1.2jaca/sweetalert2.1.2jaca.min.js"></script>
        <!-- Sweet alert init js-->
        <script src="{{ asset('backend') }}/js/pages/sweet-alerts.init.js"></script>

        <!-- FoodType index -->
        <script>
            $(document).on("click", "#sa-custom-delete", function(e){
                e.preventDefault();
                var link = $(this).attr("href");
                swal({
                    title: "Are sure you want to delete?",
                    text: "This will be PERMANENTLY deleted!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.href = link;
                        } /*else {
                            swal("Safe Data!");
                        }*/
                    });
            });
        </script>

        <script>
            $(document).on("click", "#sa-custom-enableSoftDelete", function(e){
                e.preventDefault();
                var link = $(this).attr("href");
                swal({
                    title: "Are you sure want to TEMPORARILY delete?",
                    text: "This may restored again.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.href = link;
                        } /*else {
                            swal("Safe Data!");
                        }*/
                    });
            });
        </script>

        <script>
            $(document).on("click", "#sa-custom-disableSoftDelete", function(e){
                e.preventDefault();
                var link = $(this).attr("href");
                swal({
                    title: "Are you sure want to restore?",
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.href = link;
                        } /*else {
                            swal("Safe Data!");
                        }*/
                    });
            });
        </script>

    <!-- App js -->
    {{--<script src="{{ URL::asset('backend/js/app.min.js')}}"></script>--}}
    <script src="{{ asset('backend') }}/js/app.js"></script>

    @stack('script-bottom')

    {{--<!-- JAVASCRIPT -->
    <script src="{{ asset('backend') }}/libs/jquery/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('backend') }}/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ asset('backend') }}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('backend') }}/libs/node-waves/waves.min.js"></script>

    <!-- apexcharts -->
    <script src="{{ asset('backend') }}/libs/apexcharts/apexcharts.min.js"></script>

    <script src="{{ asset('backend') }}/js/pages/dashboard.init.js"></script>

    <!-- App js -->
    <script src="{{ asset('backend') }}/js/app.js"></script>--}}
