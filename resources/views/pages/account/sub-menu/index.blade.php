@extends('layouts.app', ['title' => 'Sub Menu'])

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
                        <h4 class="card-title">Sub Menu Page</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Data Tables</li>
                        </ol>
                    </div>

                </div>

                <div class="page-title-right">
                    <a href="javascript:void(0)" id="createNewSubMenu"
                        class="btn btn-success btn-rounded waves-effect waves-light"><i
                            class="mdi mdi-plus me-2"></i>Create New</a>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="subMenuTable"
                        class="table table-bordered dt-responsive table-striped border nowrap deleteDataTable"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="table-topbar">
                            <tr>
                                <th width="10%">No</th>
                                <th>Menu</th>
                                <th>Sub Name</th>
                                <th>Route</th>
                                <th>Sequence</th>
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

@include('pages.account.sub-menu.form')
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
            $('#subMenuTable').DataTable({
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
                        data: 'menu',
                        name: 'menu.menu_name'
                    },
                    {
                        data: 'sub_name',
                        name: 'sub_name'
                    },
                    {
                        data: 'route',
                        name: 'route'
                    },
                    {
                        data: 'sequence',
                        name: 'sequence'
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