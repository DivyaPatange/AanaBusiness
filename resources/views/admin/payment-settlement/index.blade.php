@extends('admin.admin_layout.main')
@section('title', 'Payment Settlement')
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
                <h2 class="mb-3">Generate Settlement</h2>
                <form method="POST" id="submitForm">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Select Month <span class="text-danger" id="month_err"></span></label>
                                <select name="month" id="month" class="form-control">
                                    <option value="">-Select Month-</option>
                                    @for($m=1; $m<=12; $m++)
                                        <?php 
                                            $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
                                        ?>
                                        <option value="{{ $m }}">{{ $month }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Select Year <span class="text-danger" id="year_err"></span></label>
                                <select name="year" id="year" class="form-control">
                                    <option value="">-Select Year-</option>
                                    @for($m=2021; $m<=2030; $m++)
                                        <option value="{{ $m }}">{{ $m }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="button" id="getList" class="btn btn-primary mt-4">Generate</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-block">
                <h2 class="mb-3">Payment Settlement List</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="export_example">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Month</th>
                                <th scope="col">Year</th>
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
var SITEURL = "{{ route('admin.payment-settlement')}}";
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
                { data: 'month', name: 'month' },
                { data: 'year', name: 'year' },
                { data: 'action', name: 'action' },
            ],
        order: [[0, 'desc']]
    } );
} );
$('body').on('click', '#getList', function () {
    var month = $("#month").val();
    var year = $("#year").val();
    if (month=="") {
        $("#month_err").fadeIn().html("Required");
        setTimeout(function(){ $("#month_err").fadeOut(); }, 3000);
        $("#month").focus();
        return false;
    }
    if (year=="") {
        $("#year_err").fadeIn().html("Required");
        setTimeout(function(){ $("#year_err").fadeOut(); }, 3000);
        $("#year").focus();
        return false;
    }
    else
    { 
        $.ajax({
            type:"POST",
            url:"{{ route('admin.generate-payment-settlement') }}",
            data:{month:month, year:year},
            cache:false,        
            success:function(returndata)
            {
                // alert(returndata);
                document.getElementById("submitForm").reset();
                var oTable = $('#export_example').dataTable(); 
                oTable.fnDraw(false);
                if(returndata.success){
                    toastr.success(returndata.success);
                }
                else{
                    toastr.error(returndata.error);
                }
            
            // location.reload();
            // $("#pay").val("");
            }
        });
    }
})
</script>
@endsection