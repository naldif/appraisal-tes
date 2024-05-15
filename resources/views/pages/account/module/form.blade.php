<div class="modal fade bs-example-modal-center" id="modalModule" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeadingModule">Modal title</h5>
                <button type="button" class="btn-close" onclick="resetErrModule()" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form id="moduleForm" name="moduleForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <input type="hidden" name="id" id="idModule">
                        <div class="col-sm-12">
                            <label class="form-label">Module Name</label>
                            <input type="text" name="name" class="form-control" id="module_name"
                                value="{{ old('name') }}" placeholder="Nama">

                            <span class="text-danger error-text name_error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="form-label">Sequence</label>
                            <input type="number" name="sequence" class="form-control" id="sequence"
                                value="{{ old('sequence') }}" placeholder="Sequence">

                            <span class="text-danger error-text sequence_error"></span>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="savedata">Submit</button>
                    <button class="btn btn-danger cancel" type="button" data-bs-dismiss="modal"
                        onclick="resetErrModule()">Cancel</button>
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

            $('#createNewModule').click(function() {
                $('#savedata').val("create-type");
                $('#id').val('');
                $('#moduleForm').trigger("reset");
                $('#modelHeadingModule').html("Create New Module");
                $('#modalModule').modal('show');

                // form error
                resetErrModule();
            });

            $('#moduleForm').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                // $('#loader-wrapper').show();    
                // Tambahkan spinner di tombol submit
                $(form).find('button[type="submit"]').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                    ).prop('disabled', true);
                console.log(form);
                $.ajax({
                    url: "{{ route('account.module.store') }}",
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
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                            $('.cancel').click(function() {
                                // Menghapus kelas 'is-invalid' dari semua elemen yang memiliki kelas 'is-invalid'
                                $('[class*="is-invalid"]').removeClass('is-invalid');
                            });
                        } else {
                            $(form)[0].reset();
                            $("#moduleForm input:hidden").val('').trigger('change');
                            $('#modalModule').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: `${data.msg}`,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                $('#loader-wrapper').show();
                                location.reload();
                            });

                            // $('#moduleTable').DataTable().ajax.reload(null,false);
                        }
                    },
                    complete: function() {
                        // Hapus spinner dan aktifkan tombol submit kembali setelah selesai
                        $(form).find('button[type="submit"]').html('Submit').prop('disabled',
                            false);
                    }
                });
            });

            $('body').on('click', '.editModule', function() {
                var id = $(this).data('id');
                // alert(id);
                $.get("{{ route('account.module.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeadingModule').html("Update Module");
                    $('#savedata').val("edit-user");
                    $('#modalModule').modal('show');
                    $('#idModule').val(data.id);
                    $('#module_name').val(data.module_name);
                    $('#sequence').val(data.sequence);

                    // form error
                    resetErrModule();
                })
            });

            $(document).on('click', '#deleteModule', function() {
            var id = $(this).data('id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#1cbb8c",
                    cancelButtonColor: "#f14e4e",
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('account.module.store') }}" + '/' + id,

                            success: function(data) {
                                console.log(data)
                                if (data.code == 1) {
                                    Swal.fire({
                                        type: 'success',
                                        icon: 'success',
                                        title: 'success',
                                        text: `${data.msg}`,
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(() => {
                                        $('#loader-wrapper').show();
                                        location.reload();
                                    });
                                    // $('#moduleTable').DataTable().ajax.reload(null,
                                    //     false);
                                }
                            }
                        });
                    }
                })
            });
        });

        function resetErrModule() {
            $('.name_error').html('');
            $('.sequence_error').html('');
        }
    </script>
@endpush
