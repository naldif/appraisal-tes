@extends('layouts.app', ['title' => 'Kelas'])

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Form Create New Kelas</h4>

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

                    <form id="daftarForm" name="daftarForm" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <input type="hidden" name="id" id="idDaftar" value="{{ $daftar->id }}">
                            <div class="col-md-6 mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select class="form-control select2" name="kelas" id="kelas"
                                    data-placeholder="Choose ...">
                                    <option value="">Choose...</option>
                                    @foreach ($kelas as $row)
                                    <option value="{{ $row->id }}" {{ $row->id == $daftar->murid_id ? 'selected' : ''
                                        }}>{{ $row->nama_kelas }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text kelas_error"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="murid" class="form-label">Murid</label>
                                <select class="form-control select2" name="murid" id="murid"
                                    data-placeholder="Choose ...">
                                    <option value="">Choose...</option>
                                    @foreach ($murids as $murid)
                                    <option value="{{ $murid->id }}" {{ $murid->id == $daftar->murid_id ? 'selected' :
                                        '' }}>{{ $murid->nama_murid }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text murid_error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="mapel" class="form-label">Mapel</label>
                                <select class="form-control select2" name="mapel" id="mapel"
                                    data-placeholder="Choose ...">
                                    <option value="">Choose...</option>
                                    @foreach ($mapels as $mapel)
                                    <option value="{{ $mapel->id }}" {{ $mapel->id == $daftar->mapel_id ? 'selected' :
                                        '' }}>{{ $mapel->nama_mapel }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text mapel_error"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="eskul" class="form-label">Eskul</label>
                                <select class="form-control select2" name="eskul" id="eskul"
                                    data-placeholder="Choose ...">
                                    <option value="">Choose...</option>
                                    @foreach ($eskuls as $eskul)
                                    <option value="{{ $eskul->id }}" {{ $eskul->id == $daftar->eskul_id ? 'selected' :
                                        '' }}>{{ $eskul->nama_eskul }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text eskul_error"></span>
                            </div>
                        </div>

                        <div>
                            <button class="btn btn-primary" type="submit" id="savedata">Submit</button>
                            <a href="{{ route('account.daftar.index') }}" class="btn btn-danger"
                                type="button">Cancel</a>
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


        $('#daftarForm').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            // Tambahkan spinner di tombol submit
            $(form).find('button[type="submit"]').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                ).prop('disabled', true);
            console.log(form);
            $.ajax({
                url: "{{ route('account.daftar.store') }}",
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
                        $('#modalKelas').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: `${data.msg}`,
                        });

                        window.location.href = "{{ route('account.daftar.index') }}";
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