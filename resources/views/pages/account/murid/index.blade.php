@extends('layouts.app', ['title' => 'Murid'])

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
                        <h4 class="card-title">Murid Page</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Data Tables</li>
                        </ol>
                    </div>

                </div>

                <div class="page-title-right">
                    <a href="{{ route('account.murid.create') }}" class="btn btn-success btn-rounded waves-effect waves-light"> <i class="mdi mdi-plus me-2"></i>Create New</a>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="mapelTable" class="table table-bordered dt-responsive table-striped border nowrap deleteDataTable"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="table-topbar">
                            <tr>
                                <th width="10%">No</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
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

@include('pages.account.mapel.form')
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
            $('#mapelTable').DataTable({
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
                        data: 'nama_murid',
                        name: 'nama_murid'
                    },
                    {
                        data: 'telepon',
                        name: 'telepon'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin'
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