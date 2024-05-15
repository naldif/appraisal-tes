@extends('layouts.app', ['title' => 'Murid'])

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Form Create New Murid</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Form Validation</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card shadow">
                    <div class="card-body">

                        <form id="muridForm" name="muridForm" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <input type="hidden" name="id" id="idMurid">
                                    <div class="col-sm-6">
                                        <label class="form-label">Nama Murid</label>
                                        <input type="text" name="nama_murid" class="form-control" id="nama_murid"
                                            value="{{ old('nama_murid') }}" placeholder="Nama">
            
                                        <span class="text-danger error-text nama_murid_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Telepon</label>
                                        <input type="number" name="telepon" class="form-control" id="telepon"
                                            value="{{ old('telepon') }}" placeholder="Telepon">
            
                                        <span class="text-danger error-text contact_error"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" id="alamat"
                                            value="{{ old('alamat') }}" placeholder="Alamat">
            
                                        <span class="text-danger error-text alamat_error"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom03" class="form-label">Jenis Kelamin</label>
                                        <select class="form-control" name="jenis_kelamin" id="validationCustom03"
                                            data-placeholder="Choose ...">
                                            <option value="">Choose...</option>
                                            <option value="laki-laki">Laki - Laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                        <span class="text-danger error-text jenis_kelamin_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" id="savedata">Submit</button>
                                <button class="btn btn-danger cancel" type="button" data-bs-dismiss="modal"
                                    onclick="resetErrMurid()">Cancel</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#muridForm').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            // Tambahkan spinner di tombol submit
            $(form).find('button[type="submit"]').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                ).prop('disabled', true);
            console.log(form);
            $.ajax({
                url: "{{ route('account.murid.store') }}",
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
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning!',
                            text: "Please check your data entry!",
                        });
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                        $('.cancel').click(function() {
                            // Menghapus kelas 'is-invalid' dari semua elemen yang memiliki kelas 'is-invalid'
                            $('[class*="is-invalid"]').removeClass('is-invalid');
                        });
                    } else {
                        $(form)[0].reset();
                        $('#modalMurid').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: `${data.msg}`,
                        });

                        // window.location.href = "{{ route('account.murid.index') }}";
                    }
                },
                complete: function() {
                    // Hapus spinner dan aktifkan tombol submit kembali setelah selesai
                    $(form).find('button[type="submit"]').html('Submit').prop('disabled',
                        false);
                }
            });
        });
    });
</script>
@endpush
