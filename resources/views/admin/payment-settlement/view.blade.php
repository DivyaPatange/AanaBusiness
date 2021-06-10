@extends('admin.admin_layout.main')
@section('title', 'Payment Settlement List')
@section('customcss')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
<script src="https://use.fontawesome.com/d5c7b56460.js"></script>
<style>
td.details-control:before {
    font-family: 'FontAwesome';
    content: '\f105';
    display: block;
    text-align: center;
    font-size: 20px;
}
tr.shown td.details-control:before{
   font-family: 'FontAwesome';
    content: '\f107';
    display: block;
    text-align: center;
    font-size: 20px;
}
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-block">
                <h2 class="mb-2">All Pending Payment Settlement List</h2>
                <p>{{ date('F', mktime(0,0,0,$settlement->month, 1, date('Y'))) }} {{ $settlement->year }}</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="export_example">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-block">
                <h2 class="mb-2">All Paid Payment Settlement List</h2>
                <p>{{ date('F', mktime(0,0,0,$settlement->month, 1, date('Y'))) }} {{ $settlement->year }}</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="export_example1">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('customjs')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
var SITEURL = "{{ route('admin.payment-settlement.view', $settlement->id)}}";
$(document).ready(function() {
    var table = $('#export_example').DataTable( {
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: SITEURL,
            type: 'GET',
            // alert(data);
        },
        columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false },
                { data: 'name', name: 'name' },
                { data: 'username', name: 'username' },
                { data: 'total', name: 'total' },
                { data: 'action', name: 'action' },
            ],
        order: [[0, 'desc']]
    } );
} );

var SITEURL1 = "{{ route('admin.payment-settlement.paid', $settlement->id)}}";
$(document).ready(function() {
    var table = $('#export_example1').DataTable( {
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: SITEURL1,
            type: 'GET',
            // alert(data);
        },
        columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false },
                { data: 'name', name: 'name' },
                { data: 'username', name: 'username' },
                { data: 'total', name: 'total' },
                { data: 'action', name: 'action' },
            ],
        order: [[0, 'desc']]
    } );
} );

$('body').on('click', '#status', function () {
    var id = $(this).data('id');
    // alert(id);
    if (id) {
      
        $.ajax({
            type:"POST",
            url:"{{ route('admin.payment-settlement.status') }}",
            data:{id:id},
            cache:false,        
            success:function(returndata)
            {
                var oTable = $('#export_example').dataTable(); 
                oTable.fnDraw(false);
                var oTable1 = $('#export_example1').dataTable(); 
                oTable1.fnDraw(false);
                if(returndata.success){
                    toastr.success(returndata.success);
                }
                else{
                    toastr.error(returndata.error);
                }
            }
        });
    }
})
</script>
@endsection