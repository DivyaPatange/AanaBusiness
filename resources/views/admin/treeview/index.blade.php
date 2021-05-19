@extends('admin.admin_layout.main')
@section('title', 'Company Tree')
@section('customcss')
<link href="https://unpkg.com/treeflex/dist/css/treeflex.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/5b3bf3b318.js" crossorigin="anonymous"></script>
<style>
.hidden{
    display:none;
}
.tf-nc
{
    border:none !important;
}
.tf-nc a
{
    color:white;
}
.tf-tree .tf-nc:after, .tf-tree .tf-nc:before, .tf-tree .tf-node-content:after, .tf-tree .tf-node-content:before{
    border-left:.0625em solid black;
}
.tf-tree li li:before{
    border-top:.0625em solid black;
}
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Company Tree</h2>
            </div>
            <div class="card-body text-center">
                <div class="tf-tree example">
                    <ul>
                        <li>
                            <!-- <span class="tf-nc" id="demo"></span> -->
                            <span class="tf-nc">
                                <i class="fas fa-atom" style="font-size:25px;"></i>
                                <br>
                                Aana Business
                            </span>
                            <ul id="Decor">
                                                        
                                @foreach($users as $user)
                                <?php
                                    $userPlan = DB::table('user_plans')->where('user_id', $user->id)->where('payment_status', 'Successful')->first();
                                ?>
                                @if(!empty($userPlan))
                                <li>
                                
                                    <span class="tf-nc" style="font-size:15px;">
                                        <a href="#">
                                            <i class="fas fa-atom" style="font-size:30px; color:red"></i></a>
                                        <br>

                                        {{ $user->first_name }}&nbsp;{{ $user->middle_name }}&nbsp;{{ $user->last_name }}
                                        <br>
                                        {{ $user->username }}
                                    </span>
                                    @if(count($user->childs))
                                        @include('admin.treeview.manageChild',['childs' => $user->childs])                                                
                                    @endif
                                                                                    
                                </li>
                                @endif
                                @endforeach
                            </li>
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('customjs')
<script src="{{ asset('treeview.js') }}"></script>
<script>
$(function () {
    $('#Decor ul').hide(600);

    $('#Decor li').on('click', function (e) {
        e.stopPropagation();
        $(this).children('ul').slideToggle();
    });
});
</script>
@endsection