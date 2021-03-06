@extends('backend.layouts.master')
@section('content')
    <div class="table-responsive">
         @include('usermodule::includes.success')
        <table class="table table-striped table-bordered table-condensed display" id="permissionTable" width="100%" cellspacing="0">
            @can('delete', Auth::user(), basuregami\UserModule\Entities\Permission\Permission::class)
                <input id="multipleDelete" type="checkbox"><button id="multipleDeleteButton">Delete</button>
            @endcan
            <thead class="">
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Display Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
            <tr>
                <th>S.No.</th>
                <th>Name</th>
                <th>Display Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody id="permissionTableBody">

            </tbody>
        </table>
    </div>

@endsection
@section('after-scripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.4/css/select.dataTables.min.css"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.4.2/b-colvis-1.4.2/b-flash-1.4.2/b-html5-1.4.2/b-print-1.4.2/cr-1.4.1/r-2.2.0/rr-1.2.3/sc-1.4.3/sl-1.2.3/datatables.min.js"></script>
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            var table = $('#permissionTable').DataTable({
                "paging": true, // Allow data to be paged
                "lengthChange": false,
                "searching": true, // Search box and search function will be actived
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "processing": true,  // Show processing
                "serverSide": true,  // Server side processing
                "deferLoading": 0, // In this case we want the table load on request so initial automatical load is not desired
                "pageLength": 10,    // 5 rows per page
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "display_name"},
                    {"data": "description"},
                    {"data": "action"}
                ],

                "columnDefs": [{
                    "targets": [4],
                    "orderable": false
                },],
                "ajax": {
                    "url": "{{url('console/permissionAjaxList')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{csrf_token()}}"}
                },

            });

            $('#permissionTable').on('click', '.permissionRemove',function (e) {
                e.preventDefault();
                //var username = $(this).attr('userName');
                var permissionId = $(this).attr('permissionId');
                var href = $(this).attr('href');
                var data = 'permissionId='+ permissionId;
                swal({
                    title: "Are you sure?",
                    text: 'Once deleted, You would not be able to recover this.',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "POST",
                                url: "{{url('console/permission/delete')}}",
                                data: data,
                                success: function(result){
                                    table.draw();
                                },
                                async: false
                            });
                            swal("Permission Deleted!", {
                                icon: "success",
                            });
                            //window.location.href = href;
                        } else {
                            swal("Action Canceled!");
                        }
                    })
            });

            //multiple delete
            $("#multipleDelete").on('click',function() { // bulk checked
                var status = this.checked;
                $(".deleteRow").each( function() {
                    $(this).prop("checked",status);
                });
            });

            $('#multipleDeleteButton').on("click", function(event){ // triggering delete one by one

                swal({
                    title: "Are you sure?",
                    text: 'Once deleted, You would not be able to recover these roles',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {

                            if( $('.deleteRow:checked').length > 0 ){  // at-least one checkbox checked
                            var ids = [];
                            $('.deleteRow').each(function(){
                                if($(this).is(':checked')) {
                                    ids.push($(this).val());
                                }
                            });                   
                            var ids_string = ids.toString();  // array to string conversion
                            $.ajax({
                                type: "POST",
                                url: "{{url('console/deleteMultiplePermission')}}",
                                data: {data_ids:ids_string},
                                success: function(result) {
                                    table.draw(); // redrawing datatable
                                },
                                async:false
                            });
                        }

                            swal("Role deleted!", {
                                icon: "success",
                            });
                            //window.location.href = href;
                        } else {
                            swal("Permission delete cancelled!");
                        }
                    })
            });

        });
    </script>

@endsection


