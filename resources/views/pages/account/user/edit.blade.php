@extends('layouts.app', ['title' => 'User'])

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Form Update User</h4>

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
            <div class="card">
                <div class="card-body">

                    <form id="userForm" name="userForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" id="idUser" value="{{ $users->id }}">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $users->name }}"
                                        id="validationCustom01" placeholder="Name">

                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $users->email }}"
                                        id="validationCustom02" placeholder="Email">

                                    <span class="text-danger error-text email_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom02" class="form-label">Contact Number</label>
                                    <input type="text" name="contact_number" class="form-control"
                                        value="{{ $users->detail_user->contact_number }}" id="validationCustom02"
                                        placeholder="Contact Number">

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
                                        <option value="{{ $role }}" {{ in_array($role, $userRoles) ? 'selected' :'' }}>
                                            {{ $role }}
                                        </option>
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
                                    <input type="text" name="password" class="form-control" value=""
                                        id="validationCustom05" placeholder="Password">

                                    <span class="text-danger error-text password_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom05" class="form-label">Photo</label>
                                    <input type="file" name="photo" class="form-control" id="customFile">
                                    <span class="text-danger error-text photo_error"></span>
                                    @if ($users->detail_user->photo)
                                    <img class="rounded mr-3 mt-3"
                                        src="{{ url(Storage::url($users->detail_user->photo)) }}" alt="" height="100">
                                    @endif

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a href="{{ route('account.user.index') }}" class="btn btn-danger" type="button">Cancel</a>
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
                                showConfirmButton: false,
                                timer: 2000
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