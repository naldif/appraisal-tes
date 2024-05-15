<div class="modal fade bs-example-modal-center" id="modalSubMenu" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeadingSubMenu">Modal title</h5>
                <button type="button" class="btn-close" onclick="resetErrSubMenu()" data-bs-dismiss="modal"
                    aria-label="Close">

                </button>
            </div>
            <form id="subMenuForm" name="subMenuForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-2">
                        <input type="hidden" name="id" id="idSubMenu">
                        <div class="col-sm-6">
                            <label class="form-label">Menu</label>
                            <select class="form-control" name="menu" id="menu_id">
                                <option value="">-- Select --</option>
                                @foreach ($menu_item as $item)
                                <option value="{{ $item->id }}">{{ $item->menu_name }}</option>
                                @endforeach
                            </select>

                            <span class="text-danger error-text menu_error"></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Sub Name</label>
                            <input type="text" name="sub_name" class="form-control" id="sub_name" value="{{ old('name') }}"
                                placeholder="Sub Name">

                            <span class="text-danger error-text name_error"></span>
                        </div>
                    </div>
                    <div class="row mb-2">                    
                        <div class="col-sm-6">
                            <label class="form-label">Route</label>
                            <input type="text" name="route" class="form-control" id="route" value="{{ old('route') }}"
                                placeholder="Route">

                            <span class="text-danger error-text route_error"></span>
                        </div>
                        <div class="col-sm-6">
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
                        onclick="resetErrSubMenu()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $(".select2").select2({
            dropdownParent: $("#modalSubMenu")
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

            $('#createNewSubMenu').click(function() {
                $('#savedata').val("create-type");
                $('#idSubMenu').val('');
                $('#subMenuForm').trigger("reset");
                $('#modelHeadingSubMenu').html("Create New Sub Menu");
                $('#modalSubMenu').modal('show');

                // form error
                resetErrSubMenu();
            });

            $('#subMenuForm').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                // Tambahkan spinner di tombol submit
                $(form).find('button[type="submit"]').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                    ).prop('disabled', true);
                console.log(form);
                $.ajax({
                    url: "{{ route('account.sub-menu.store') }}",
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
                            $("#subMenuForm input:hidden").val('').trigger('change');
                            $('#modalSubMenu').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: `${data.msg}`,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                location.reload();
                            });

                            // $('#subMenuTable').DataTable().ajax.reload(null,false);
                        }
                    },
                    complete: function() {
                        // Hapus spinner dan aktifkan tombol submit kembali setelah selesai
                        $(form).find('button[type="submit"]').html('Submit').prop('disabled',
                            false);
                    }
                });
            });

            $('body').on('click', '.editSubMenu', function() {
                var id = $(this).data('id');
                // alert(id);
                $.get("{{ route('account.sub-menu.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeadingSubMenu').html("Update Sub Menu");
                    $('#savedata').val("edit-user");
                    $('#modalSubMenu').modal('show');
                    $('#idSubMenu').val(data.id);
                    $('#menu_id').val(data.menu_id).trigger('change');
                    $('#sub_name').val(data.sub_name);
                    $('#route').val(data.route);
                    $('#sequence').val(data.sequence);

                    // form error
                    resetErrSubMenu();
                })
            });

            $(document).on('click', '#deleteSubMenu', function() {
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
                            url: "{{ route('account.sub-menu.store') }}" + '/' + id,

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

        function resetErrSubMenu() {
            $('.menu_error').html('');
            $('.name_error').html('');
            $('.route_error').html('');
            $('.sequence_error').html('');
            
        }
</script>
@endpush