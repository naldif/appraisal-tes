<div class="modal fade bs-example-modal-center" id="modalMapel" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeadingMapel">Modal title</h5>
                <button type="button" class="btn-close" onclick="resetErrMapel()" data-bs-dismiss="modal"
                    aria-label="Close">

                </button>
            </div>
            <form id="mapelForm" name="mapelForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <input type="hidden" name="id" id="idMapel">
                        <div class="col-sm-12">
                            <label class="form-label">Nama Mapel</label>
                            <input type="text" name="nama_mapel" class="form-control" id="nama_mapel"
                                value="{{ old('nama_mapel') }}" placeholder="Nama Mapel">

                            <span class="text-danger error-text nama_mapel_error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" id="savedata">Submit</button>
                    <button class="btn btn-danger cancel" type="button" data-bs-dismiss="modal"
                        onclick="resetErrMapel()">Cancel</button>
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

            $('#createNewMapel').click(function() {
                $('#savedata').val("create-type");
                $('#idMapel').val('');
                // $("#MapelForm")[0].reset();
                $('#modelHeadingMapel').html("Create New Mapel");
                $('#modalMapel').modal('show');

                // form error
                resetErrMapel();
            });

            $('#mapelForm').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                // Tambahkan spinner di tombol submit
                $(form).find('button[type="submit"]').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                ).prop('disabled', true);
                console.log(form);
                $.ajax({
                    url: "{{ route('account.mapel.store') }}",
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
                            $('#modalMapel').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: `${data.msg}`,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $(form)[0].reset();
                            
                            $('#mapelTable').DataTable().ajax.reload(null, false);
                        }
                    },
                    complete: function() {
                        // Hapus spinner dan aktifkan tombol submit kembali setelah selesai
                        $(form).find('button[type="submit"]').html('Submit').prop('disabled',
                            false);
                    }
                });
            });

            $('body').on('click', '.editMapel', function() {
                var id = $(this).data('id');
                // alert(id);
                $.get("{{ route('account.mapel.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeadingMapel').html("Edit Mapel");
                    $('#savedata').val("edit-user");
                    $('#modalMapel').modal('show');
                    $('#idMapel').val(data.id);
                    $('#nama_mapel').val(data.nama_mapel);

                    // form error
                    resetErrMapel();
                })
            });
        });

        function resetErrMapel() {
            $('.nama_mapel_error').html('');
        }
    </script>
@endpush
