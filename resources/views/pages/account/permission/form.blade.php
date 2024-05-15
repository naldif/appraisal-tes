<div class="modal fade bs-example-modal-center" id="modalPermission" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeadingPermission">Modal title</h5>
                <button type="button" class="btn-close" onclick="resetErrPermission()" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form id="permissionForm" name="permissionForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id" id="idPermission">
                        <div class="col-sm-12">
                            <label class="form-label">Nama Perizinan</label>
                            <input type="text" name="name" class="form-control" id="name_permission"
                                value="{{ old('name') }}" placeholder="Nama">

                            <span class="text-danger error-text name_error"></span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="savedata">Submit</button>
                    <button class="btn btn-danger cancel" type="button" data-bs-dismiss="modal"
                        onclick="resetErrPermission()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#createNewPermission').click(function() {
                $('#savedata').val("create-type");
                $('#idPermission').val('');
                $('#permissionForm').trigger("reset");
                $('#modelHeadingPermission').html("Create New Permission");
                $('#modalPermission').modal('show');

                // form error
                resetErrPermission();
            });

            $('#permissionForm').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                // Tambahkan spinner di tombol submit
                $(form).find('button[type="submit"]').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                ).prop('disabled', true);
                console.log(form);
                $.ajax({
                    url: "{{ route('account.permission.store') }}",
                    // url:$(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.code == 0) {
                            // Swal.fire({
                            //     icon: 'warning',
                            //     title: 'Warning!',
                            //     text: "Please check your data entry!",
                            // });
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                            $('.cancel').click(function() {
                                // Menghapus kelas 'is-invalid' dari semua elemen yang memiliki kelas 'is-invalid'
                                $('[class*="is-invalid"]').removeClass('is-invalid');
                            });
                        } else {
                            $(form)[0].reset();
                            $("#permissionForm input:hidden").val('').trigger('change');
                            $('#modalPermission').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: `${data.msg}`,
                                showConfirmButton: false,
                                timer: 2000
                            });

                            $('#permissionTable').DataTable().ajax.reload(null,false);
                        }
                    },
                    complete: function() {
                        // Hapus spinner dan aktifkan tombol submit kembali setelah selesai
                        $(form).find('button[type="submit"]').html('Submit').prop('disabled',
                            false);
                    }
                });
            });

            $('body').on('click', '.editPermission', function() {
                var id = $(this).data('id');
                // alert(id);
                $.get("{{ route('account.permission.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeadingPermission').html("Update Permission");
                    $('#savedata').val("edit-user");
                    $('#modalPermission').modal('show');
                    $('#idPermission').val(data.id);
                    $('#name_permission').val(data.name);

                    // form error
                    resetErrPermission();
                })
            });
        });

        function resetErrPermission() {
            $('.name_error').html('');
        }
    </script>
@endpush
