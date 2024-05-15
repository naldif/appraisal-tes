<!-- JAVASCRIPT -->
<script src="{{asset('/be/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/node-waves/waves.min.js')}}"></script>


<!-- apexcharts -->
<script src="{{asset('/be/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- jquery.vectormap map -->
<script src="{{asset('/be/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js')}}">
</script>

<!-- Required datatable js -->
<script src="{{asset('/be/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{asset('/be/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/jszip/jszip.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{asset('/be/assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
 <!-- Sweet Alerts js -->
 <script src="{{asset('/be/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

 <!-- Sweet alert init js-->
 <script src="{{asset('/be/assets/js/pages/sweet-alerts.init.js')}}"></script>
 <!--tinymce js-->
 <script src="{{asset('/be/assets/libs/tinymce/tinymce.min.js')}}"></script>

 <!-- init js -->
 <script src="{{asset('/be/assets/js/pages/form-editor.init.js')}}"></script>
 {{-- Preloader --}}
 <script src="{{ asset('/be/assets/preloader/js/vendor/modernizr-2.6.2.min.js') }}"></script>
 <script src="{{ asset('/be/assets/preloader/js/main.js') }}"></script>

<!-- Responsive examples -->
<script src="{{asset('/be/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
<script src="{{asset('/be/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{asset('/be/assets/js/pages/form-advanced.init.js')}}"></script>

<!-- Datatable init js -->
<script src="{{ asset('/be/assets/js/pages/datatables.init.js') }}"></script>

<!-- App js -->
<script src="{{asset('/be/assets/js/app.js')}}"></script>

@stack('scripts')

<script>
    $(document).ready(function() {
        // csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.delete-item', function(e) {
            e.preventDefault();

            let deleteUrl = $(this).attr('href');
            // console.log(deleteUrl)
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1cbb8c",
                cancelButtonColor: "#f14e4e",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: deleteUrl,
                        success: function(data) {
                            if (data.status == 'error') {

                                Swal.fire({
                                    title: "Your can not deleted.",
                                    text: "This data contain items can be deleted.",
                                    icon: "error"
                                });
                            } else {

                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Data has been deleted from database.",
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                // window.location.reload();
                                $('.deleteDataTable').DataTable().ajax.reload(null,false);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    })
                }
            });
        })
    })
</script>
<script>
    function showErrorAlert() {
        Swal.fire({
            title: "Error",
            text: "Route pada sistem belum dibuat!",
            icon: "error",
            button: "OK",
        });
    }
    function showErrorAlertNoAdmin() {
        Swal.fire({
            title: "Error",
            text: "Anda bukan Admin!",
            icon: "error",
            button: "OK",
        });
    }

</script>