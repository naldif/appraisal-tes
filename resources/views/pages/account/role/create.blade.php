@extends('layouts.app', ['title' => 'Role'])

@section('content')

<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Form Create New Role</h4>

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
                    {{-- <h4 class="header-title mb-4">Form Add</h4> --}}
                    <form id="roleForm" name="roleForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="validationCustom01" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="" id="validationCustom01"
                                        placeholder="Name">

                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Permission</label>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="allcheck">
                                    <label class="form-check-label" for="allcheck">
                                        Give All Permissions
                                    </label>
                                </div>

                                @php
                                $groupedPermissions = [];
                                $permissionsTable = [];
                                foreach ($permissions as $permission) {
                                $parts = explode('-', $permission->name);
                                $groupName = $parts[0];
                                $permissionName = $parts[1];
                                if (!isset($groupedPermissions[$groupName])) {
                                $groupedPermissions[$groupName] = [];
                                }
                                if (!in_array($permissionName, $permissionsTable)) {
                                $permissionsTable[] = $permissionName;
                                }
                                $groupedPermissions[$groupName][$permissionName] = $permission;
                                }
                                @endphp

                                <div class="table-wrapper">
                                    <table id="tabel" class="table table-bordered table-striped dt-responsive nowrap "
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-topbar">
                                            <tr>
                                                <th>#</th>
                                                <th>Group</th>
                                                @foreach($permissionsTable as $permissionName)
                                                <th>{{ ucfirst($permissionName) }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($groupedPermissions as $groupName => $group)
                                            <tr>
                                                <td>
                                                    <input class="form-check-input check-group" type="checkbox"
                                                        id="checkGroup-{{ $groupName }}">
                                                </td>
                                                <td>{{ ucfirst($groupName) }}</td>
                                                @foreach($permissionsTable as $permissionName)
                                                <td>
                                                    @if(isset($group[$permissionName]))
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $group[$permissionName]->id }}"
                                                        class="form-check-input permission-checkbox permission-checkbox-{{ $groupName }}"
                                                        style="text-align: center;">
                                                    @else
                                                    <span class="badge bg-danger" style="border-radius:100%;font-size: 12px;">x</span>

                                                    @endif
                                                </td>
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <span class="text-danger error-text permissions_error"></span>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a href="{{ route('account.role.index') }}" class="btn btn-danger" type="button">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('allcheck').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('.form-check-input');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = document.getElementById('allcheck').checked;
            });
        });

    var checkGroupCheckboxes = document.querySelectorAll('.check-group');
    checkGroupCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var groupName = checkbox.id.replace('checkGroup-', '');
            var permissionCheckboxes = document.querySelectorAll('.permission-checkbox-' + groupName);
            permissionCheckboxes.forEach(function(permissionCheckbox) {
                permissionCheckbox.checked = checkbox.checked;
            });
        });
    });
</script>

<script type="text/javascript">
    $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            

            $('#roleForm').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                $(form).find('button[type="submit"]').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                    ).prop('disabled', true);
                console.log(form);
                $.ajax({
                    url: "{{ route('account.role.store') }}",
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
                                showConfirmButton: false,
                                timer: 2000
                            });

                            // location.reload();
                            window.location.href = "{{ route('account.role.index') }}";
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