@extends('user.user_layout.main')
@section('title', 'Joiner')
@section('page_title', 'Joiner List')
@section('customcss')
<style>
.hidden{
    display:none;
}
</style>

@endsection
@section('content')
<div class="row mt--2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Joiner List</h4>
                <a href="{{ route('user.joiners.create') }}"><button type="button" class="btn btn-primary">Add New</button></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Mobile No.</th>
                                <th>Email Id</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sr No.</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Mobile No.</th>
                                <th>Email Id</th>
                                <th>Address</th>
                            </tr>
                        </tfoot>
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
<!-- Datatables -->
<script src="{{ asset('userAsset/assets/js/plugin/datatables/datatables.min.js') }}"></script>
<script >
var SITEURL = '{{ route('user.joiners.index')}}';
$('#basic-datatables').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: SITEURL,
    type: 'GET',
    },
    columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
            { data: 'full_name', name: 'full_name' },
            { data: 'username', name: 'username' },
            { data: 'mobile_no1', name: 'mobile_no1' },
            {data: 'email', name: 'email'},
            {data: 'address', name: 'address'},
        ],
    order: [[0, 'desc']]
});
</script>
@endsection