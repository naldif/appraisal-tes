@extends('layouts.app', ['title' => 'Permission'])

@section('content')
    <style>
        .row.align-items-center {
            display: flex;
            align-items: center;
        }
    </style>
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Permission Page</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Data Tables</li>
                            </ol>
                        </div>

                    </div>

                    <div class="page-title-right">
                        <a href="javascript:void(0)" id="createNewPermission"
                            class="btn btn-success btn-rounded waves-effect waves-light"><i
                                class="mdi mdi-plus me-2"></i>Create New</a>
                        {{-- <button type="button" class="btn btn-success btn-rounded waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#my_Modal"> <i class="mdi mdi-plus me-2"></i>Create
                        New</button> --}}
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="permissionTable" class="table table-bordered dt-responsive table-striped border nowrap deleteDataTable"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="table-topbar">
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Name</th>
                                    <th>Guard Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.account.permission.form')
@endsection

@push('scripts')
    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function() {
                show_data()
            });

            function show_data() {
                $('#permissionTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{!! url()->current() !!}'
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },

                        {
                            data: 'guard_name',
                            name: 'guard_name'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ]
                })
            }
        });
    </script>
@endpush
