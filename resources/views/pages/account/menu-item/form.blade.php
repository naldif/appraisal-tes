<div class="modal fade bs-example-modal-center" id="modalMenuItem" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeadingMenuItem">Modal title</h5>
                <button type="button" class="btn-close" onclick="resetErrMenuItem()" data-bs-dismiss="modal"
                    aria-label="Close">

                </button>
            </div>
            <form id="menuItemForm" name="menuItemForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-2">
                        <input type="hidden" name="id" id="idMenuItem">
                        <div class="col-sm-6">
                            <label class="form-label">Module</label>
                            <select class="form-control" name="module" id="module_id">
                                <option value="">-- Select --</option>
                                @foreach ($module as $item)
                                <option value="{{ $item->id }}">{{ $item->module_name }}</option>
                                @endforeach
                            </select>

                            <span class="text-danger error-text module_error"></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Menu Name</label>
                            <input type="text" name="name" class="form-control" id="menu_name" value="{{ old('name') }}"
                                placeholder="Name">

                            <span class="text-danger error-text name_error"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <label class="form-label">Icon</label>
                            <input type="text" name="icon" class="form-control" id="icon" value="{{ old('icon') }}"
                                placeholder="Icon">

                            <span class="text-danger error-text icon_error"></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Route</label>
                            <input type="text" name="route" class="form-control" id="route" value="{{ old('route') }}"
                                placeholder="Route">

                            <span class="text-danger error-text route_error"></span>
                        </div>
                    </div>
                    <div class="row">
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
                        onclick="resetErrMenuItem()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $(".select2").select2({
            dropdownParent: $("#modalMenuItem")
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

            $('#createNewMenuItem').click(function() {
                $('#savedata').val("create-type");
                $('#idMenuItem').val('');
                $('#menuItemForm').trigger("reset");
                $('#modelHeadingMenuItem').html("Create New Menu Item");
                $('#modalMenuItem').modal('show');

                // form error
                resetErrMenuItem();
            });

            $('#menuItemForm').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                // Tambahkan spinner di tombol submit
                $(form).find('button[type="submit"]').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                    ).prop('disabled', true);
                console.log(form);
                $.ajax({
                    url: "{{ route('account.menu-item.store') }}",
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
                            $("#menuItemForm input:hidden").val('').trigger('change');
                            $('#modalMenuItem').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: `${data.msg}`,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                location.reload();
                            });

                            // $('#menuItemTable').DataTable().ajax.reload(null,false);
                        }
                    },
                    complete: function() {
                        // Hapus spinner dan aktifkan tombol submit kembali setelah selesai
                        $(form).find('button[type="submit"]').html('Submit').prop('disabled',
                            false);
                    }
                });
            });

            $('body').on('click', '.editMenuItem', function() {
                var id = $(this).data('id');
                // alert(id);
                $.get("{{ route('account.menu-item.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeadingMenuItem').html("Update MenuItem");
                    $('#savedata').val("edit-user");
                    $('#modalMenuItem').modal('show');
                    $('#idMenuItem').val(data.id);
                    $('#module_id').val(data.module_id).trigger('change');
                    $('#menu_name').val(data.menu_name);
                    $('#icon').val(data.icon);
                    $('#route').val(data.route);
                    $('#sequence').val(data.sequence);

                    // form error
                    resetErrMenuItem();
                })
            });
        });

        function resetErrMenuItem() {
            $('.module_error').html('');
            $('.name_error').html('');
            $('.icon_error').html('');
            $('.route_error').html('');
            $('.sequence_error').html('');

            // $('#module_id').select2();
            // $('#module_id').val('').trigger('change');
          
            // $("#module_id").select2("val", "");
            // $("#module_id").val('Select').trigger('change');
            // $('#menuItemForm')[0].reset();
            // $("#module_id").trigger("change");
            // $('#module_id').val('-- Select --').trigger('change');
            // $('#module_id').select2("val", '-- Select --');
            // $("#module_id").val('-- Select --').trigger('change')
            // $('#module_id').val('tes').select2();
            // $('#module_id').val('tes').trigger('change').select2();
            
        }
</script>
@endpush