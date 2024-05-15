@extends('layouts.app', ['title' => 'User'])

@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h4>User Add Page</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Morvin</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Form Add</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-4">Form Add</h4>


                            <form id="userForm" name="userForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="validationCustom01" class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" value=""
                                                id="validationCustom01" placeholder="Name">

                                            <span class="text-danger error-text name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" value=""
                                                id="validationCustom02" placeholder="Email">

                                            <span class="text-danger error-text email_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="validationCustom02" class="form-label">Contact Number</label>
                                            <input type="text" name="contact_number" class="form-control" value=""
                                                id="validationCustom02" placeholder="Contact Number">

                                            <span class="text-danger error-text contact_number_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="validationCustom03" class="form-label">Role</label>
                                            <select class="select2 form-control select2-multiple" multiple="multiple"
                                                name="roles[]" id="validationCustom03" data-placeholder="Choose ...">
                                                <option value="">Choose...</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role }}">{{ $role }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-text roles_error"></span>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="validationCustom05" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" value=""
                                                id="validationCustom05" placeholder="Password">

                                            <span class="text-danger error-text password_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="validationCustom05" class="form-label">Photo</label>
                                            <input type="file" name="photo" class="form-control" id="customFile">
                                            <span class="text-danger error-text photo_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <a href="{{ route('account.user.index') }}" class="btn btn-danger"
                                        type="button">Cancel</a>
                                </div>
                            </form>
                        </div>
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

            $('#userForm').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                $(form).find('button[type="submit"]').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                    ).prop('disabled', true);
                console.log(form);
                $.ajax({
                    url: "{{ route('account.user.store') }}",
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
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: `${data.msg}`,
                            });

                            // location.reload();
                            window.location.href = "{{ route('account.user.index') }}";
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
