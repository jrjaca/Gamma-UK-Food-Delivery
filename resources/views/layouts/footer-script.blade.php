
    {{--<!-- Modernizer js -->
    <script src="{{ asset('frontend') }}/js/vendor/modernizr-3.5.0.min.js"></script>--}}

    <!-- JS Files -->
    <script src="{{ asset('frontend') }}/js/vendor/jquery-3.2.1.min.js"></script>
    <script src="{{ asset('frontend') }}/js/popper.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins.js"></script>
    <script src="{{ asset('frontend') }}/js/active.js"></script>

    @stack('script')

    <!-- toastr plugin -->
    <script src="{{ asset('backend') }}/libs/toastr/build/toastr.min.js"></script>
    <!-- toastr init -->
    <script src="{{ asset('backend') }}/js/pages/toastr.init.js"></script>


    <!-- Sweetalert2 - for Swal of TOAST-->
    {{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>--}}
    <script src="{{ asset('frontend') }}/js/sweetalert2forswaloftoast-jaca.js"></script>


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

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000,
                timerProgressBar: true,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            var type="{{Session::get('alert-type','info')}}"
            if (type == 'success') {
                Toast.fire({
                    icon: 'success',
                    title: "{{ Session::get('message') }}" })
            } else if (type == 'info') {
                Toast.fire({
                    icon: 'info',
                    title: "{{ Session::get('message') }}" })
            } else if (type == 'warning') {
                Toast.fire({
                    icon: 'warning',
                    title: "{{ Session::get('message') }}" })
            } else {
                    Toast.fire({
                        icon: 'error',
                        title: "{{ Session::get('message') }}" })}
        @endif
    </script>

    <!-- Add to Cart -->
        <script type="text/javascript">
            function addToCart(id){
                spinner('Adding...');
                $.ajax({
                    url: "{{ url('/cart/product/add/') }}/"+id+"/"+$("#qty_new").val(),
                    type: "GET",
                    dataType: "json",
                    success:function (result) {

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            showCloseButton: true,
                            timer: 3000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });

                        if ($.isEmptyObject(result.success)) { // this will return undefined, possibly info,warning,error
                            if ($.isEmptyObject(result.info)) {
                                if ($.isEmptyObject(result.warning)) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: result.error})
                                } else {
                                    Toast.fire({
                                        icon: 'warning',
                                        title: result.warning})}
                            } else {
                                Toast.fire({
                                    icon: 'info',
                                    title: result.info})}
                        } else {
                            Toast.fire({
                                icon: 'success',
                                title: result.success})}

                        /*$('#pname').text(result.product.product_name);
                        $('#pcode').text(result.product.product_code);
                        $('#pcat').text(result.product.category_name);
                        $('#psubcat').text(result.product.subcategory_name);
                        $('#pbrand').text(result.product.brand_name);
                        $('#pimage').attr('src',result.product.image_one);
                        $('#product_id').val(result.product.id);

                        var d = $('select[name="color"]').empty();
                        $.each(result.color, function(key, value){
                            $('select[name="color"]').append('<option value="'+value+'">'+value+'</option>');
                        });

                        var d = $('select[name="size"]').empty();
                        $.each(result.size, function(key, value){
                            $('select[name="size"]').append('<option value="'+value+'">'+value+'</option>');
                        });*/
                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    },
                })
            }
        </script>
    <!-- /Add to Cart -->

    <!-- Show Cart Modal-Pop-up from topbar -->
    {{--<script type="text/javascript">
        function showCart() {
           // $("#cart_modal_div").trigger("click");
            location.reload();
        }
    </script>--}}
    <!-- /Show Cart Modal-Pop-up from topbar -->

    <!--toastr-->
    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>--}}

    <!--spinner/waiting-->
    <script type="text/javascript" src="{{ asset('spinner') }}/js/modal-loading.js"></script>
    <script>
        <!-- Spinner -->
        function spinner(tile) {
            var loading = Loading({
                title: tile,
                titleColor: 'rgb(255, 255, 255)',
                loadingAnimation: 'image',
                animationSrc: "{{asset('spinner')}}/img/loading.gif",
                animationWidth: 150,
                animationHeight: 100,
                defaultApply: true,
            });
            loading.out(); //hide immediately
        }
        <!-- /Spinner -->

        /*//function disableSpinner(loading) { //timer logout
        function disableSpinner() { //timer logout
            //setTimeout(() => loading.out(), 1); //3000 - 3seconds
            loading.out(); //hide immediately
        }

        function enableSpinner(tile) {
            var loading = new Loading({
                title: 					tile,
                titleColor: 			'rgb(255, 255, 255)',
                loadingAnimation: 		'image',
                animationSrc: 			"{{asset('spinner')}}/img/loading.gif",
                animationWidth: 150,
                animationHeight: 100,
                defaultApply: 	true,
            });

            //disableSpinner(loading);
            //loading.out(); //hide immediately
        }*/

        /*//Display a default loading modal on the screen.
        var loading =new Loading();

        //Customize the loading modal with the following settings.
        var loading =new Loading({
            // 'ver' or 'hor'
            direction:'ver',
            // loading title
            title: undefined,
            // text color
            titleColor:'#FFF',
            // font size
            titleFontSize: 14,
            // extra class(es)
            titleClassName: undefined,
            // font family
            titleFontFamily:   undefined,
            // loading description
            discription: undefined,
            // text color
            discriptionColor: '#FFF',
            // font size
            discriptionFontSize: 14,
            // extra class(es)
            discriptionClassName: undefined,
            // font family
            directionFontFamily: undefined,
            // width/height of loading indicator
            loadingWidth:'auto',
            loadingHeight:'auto',
            // padding in pixels
            loadingPadding: 20,
            // background color
            loadingBgColor:'#252525',
            // border radius in pixels
            loadingBorderRadius: 12,
            // loading position
            loadingPosition:'fixed',
            // shows/hides background overlay
            mask:true,
            // background color
            maskBgColor:'rgba(0, 0, 0, .6)',
            // extra class(es)
            maskClassName: undefined,
            // mask position
            maskPosition:'fixed',
            // 'image': use a custom image
            loading<a href="https://www.jqueryscript.net/animation/">Animation</a>:'origin',
        // path to loading spinner
        animationSrc: undefined,
        // width/height of loading spinner
        animationWidth: 40,
        animationHeight: 40,
        animationOriginWidth: 4,
        animationOriginHeight: 4,
        // color
        animationOriginColor:'#FFF',
        // extra class(es)
        animationClassName: undefined,
        // auto display
        defaultApply:true,
        // animation options
        animationIn:'animated fadeIn',
        animationOut:'animated fadeOut',
        animationDuration:  1000,
        // z-index property
        zIndex: 0,

        });*/

    </script>

    <!-- USED BY HOME.blade and Topbar.blade -->
    <!-- START MODAL EDIT BUTTON LINK-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('update/profile') }}" method="POST">
                        @csrf
                        <input type="hidden" id="id" name="id" readonly>

                        <label for="name">Name</label>
                        <input id="name" type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               required autocomplete="name" autofocus>

                        <label for="email">Email (username)</label>
                        <input id="email" type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               required autocomplete="email">

                        <label for="phone_no">Phone</label>
                        <input id="phone_no" type="text" name="phone_no"
                               class="form-control @error('phone_no') is-invalid @enderror"
                               autocomplete="phone_no">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            //var recipient = button.data('whatever') // Extract info from data-* attributes
            var id = button.data('id')
            var name = button.data('name')
            var email = button.data('email')
            var phone_no = button.data('phone_no')

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#id').val(id)
            modal.find('#name').val(name)
            modal.find('#email').val(email)
            modal.find('#phone_no').val(phone_no)
        })
    </script>
    <!-- END MODAL EDIT BUTTON LINK-->

    @stack('script-bottom')
