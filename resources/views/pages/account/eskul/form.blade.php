<div class="modal fade bs-example-modal-center" id="modalEskul" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeadingEskul">Modal title</h5>
                <button type="button" class="btn-close" onclick="resetErrEskul()" data-bs-dismiss="modal"
                    aria-label="Close">

                </button>
            </div>
            <form id="eskulForm" name="eskulForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <input type="hidden" name="id" id="idEskul">
                        <div class="col-sm-12">
                            <label class="form-label">Nama Eskul</label>
                            <input type="text" name="nama_eskul" class="form-control" id="nama_eskul"
                                value="{{ old('nama_eskul') }}" placeholder="Nama Eskul">

                            <span class="text-danger error-text nama_eskul_error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="savedata">Submit</button>
                    <button class="btn btn-danger cancel" type="button" data-bs-dismiss="modal"
                        onclick="resetErrEskul()">Cancel</button>
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

            $('#createNewEskul').click(function() {
                $('#savedata').val("create-type");
                $('#idEskul').val('');
                // $("#EskulForm")[0].reset();
                $('#modelHeadingEskul').html("Create New Eskul");
                $('#modalEskul').modal('show');

                // form error
                resetErrEskul();
            });

            $('#eskulForm').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                // Tambahkan spinner di tombol submit
                $(form).find('button[type="submit"]').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                ).prop('disabled', true);
                console.log(form);
                $.ajax({
                    url: "{{ route('account.eskul.store') }}",
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
                            $('#modalEskul').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: `${data.msg}`,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $(form)[0].reset();
                            
                            $('#eskulTable').DataTable().ajax.reload(null, false);
                        }
                    },
                    complete: function() {
                        // Hapus spinner dan aktifkan tombol submit kembali setelah selesai
                        $(form).find('button[type="submit"]').html('Submit').prop('disabled',
                            false);
                    }
                });
            });

            $('body').on('click', '.editEskul', function() {
                var id = $(this).data('id');
                // alert(id);
                $.get("{{ route('account.eskul.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeadingEskul').html("Edit Eskul");
                    $('#savedata').val("edit-user");
                    $('#modalEskul').modal('show');
                    $('#idEskul').val(data.id);
                    $('#nama_eskul').val(data.nama_eskul);

                    // form error
                    resetErrEskul();
                })
            });
        });

        function resetErrEskul() {
            $('.nama_eskul_error').html('');
        }
    </script>
@endpush
