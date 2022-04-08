@extends('admin.layout.index')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blank page
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">categories</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box">
                <div class="box-header">
                    <div class="col-md-6">
                        <button class="btn btn-success col-md-3" data-toggle="modal"  data-backdrop="static" data-keyboard="false" data-target="#myModalHorizontal">
                            <i class="fa fa-fw fa-plus"></i>new</button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="data_table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>title</th>
                            <th>Language </th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


        </section>
        <!-- /.content -->
    </div>
    @include('admin.category.create')
    @include('admin.category.edit')
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            table =  $('#data_table').DataTable({
                ajax: {
                    url: "{{route('admin.category.index')}}"
                },
                processing: false,
                serverSide: false,
                autoWidth: false,
                ordering: true,
                columns: [
                    {data: "id"},
                    {data: "title"},
                    {data:"language"},
                    {data: 'action'}
                ],
                bFilter: true
            });
        });
    </script>
@endpush
