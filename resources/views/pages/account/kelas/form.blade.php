<div class="modal fade bs-example-modal-center" id="modalKelas" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeadingKelas">Modal title</h5>
                <button type="button" class="btn-close" onclick="resetErrKelas()" data-bs-dismiss="modal"
                    aria-label="Close">

                </button>
            </div>
            <form id="kelasForm" name="k" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <input type="hidden" name="id" id="idKelas">
                        <div class="col-sm-12">
                            <label class="form-label">Nama Kelas</label>
                            <input type="text" name="nama_kelas" class="form-control" id="nama_Kelas"
                                value="{{ old('nama_Kelas') }}" placeholder="Nama Kelas">

                            <span class="text-danger error-text nama_kelas_error"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label class="form-label">Maksimal</label>
                            <input type="text" name="maksimal" class="form-control" id="maksimal"
                                value="{{ old('maksimal') }}" placeholder="Maksimal">

                            <span class="text-danger error-text maksimal_error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="savedata">Submit</button>
                    <button class="btn btn-danger cancel" type="button" data-bs-dismiss="modal"
                        onclick="resetErrKelas()">Cancel</button>
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

            $('#createNewKelas').click(function() {
                $('#savedata').val("create-type");
                $('#idKelas').val('');
                // $("#KelasForm")[0].reset();
                $('#modelHeadingKelas').html("Create New Kelas");
                $('#modalKelas').modal('show');

                // form error
                resetErrKelas();
            });

            $('#kelasForm').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                // Tambahkan spinner di tombol submit
                $(form).find('button[type="submit"]').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                ).prop('disabled', true);
                console.log(form);
                $.ajax({
                    url: "{{ route('account.kelas.store') }}",
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
                            $('#modalKelas').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: `${data.msg}`,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $(form)[0].reset();
                            
                            $('#kelasTable').DataTable().ajax.reload(null, false);
                        }
                    },
                    complete: function() {
                        // Hapus spinner dan aktifkan tombol submit kembali setelah selesai
                        $(form).find('button[type="submit"]').html('Submit').prop('disabled',
                            false);
                    }
                });
            });

            $('body').on('click', '.editKelas', function() {
                var id = $(this).data('id');
                // alert(id);
                $.get("{{ route('account.kelas.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeadingKelas').html("Edit Kelas");
                    $('#savedata').val("edit-user");
                    $('#modalKelas').modal('show');
                    $('#idKelas').val(data.id);
                    $('#nama_Kelas').val(data.nama_kelas);
                    $('#maksimal').val(data.maksimal);

                    // form error
                    resetErrKelas();
                })
            });
        });

        function resetErrKelas() {
            $('.nama_kelas_error').html('');
            $('.maksimal_error').html('');
        }
    </script>
@endpush
