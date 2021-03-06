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
            <div class="card-header card-header-border-bottom d-block">
                <h2 class="mb-3">Company Tree</h2>
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                		<div class="card widget-block p-4 rounded bg-primary border">
                			<div class="card-block">
                				<h4 class="text-white my-2">General Category</h4>
                			</div>
                		</div>
                	</div>
                	<div class="col-md-6 col-lg-6 col-xl-3">
                		<div class="card widget-block p-4 rounded bg-warning border">
                			<div class="card-block">
                				<h4 class="text-white my-2">Golden Category</h4>
                			</div>
                		</div>
                	</div>
                	<div class="col-md-6 col-lg-6 col-xl-3">
                		<div class="card widget-block p-4 rounded bg-danger border">
                			<div class="card-block">
                				<h4 class="text-white my-2">Platinum Category</h4>
                			</div>
                		</div>
                	</div>
                	<div class="col-md-6 col-lg-6 col-xl-3">
                		<div class="card widget-block p-4 rounded bg-success border">
                			<div class="card-block">
                				<h4 class="text-white my-2">Money Plant</h4>
                			</div>
                		</div>
                	</div>
                </div>
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
                                <?php 
                                    if($userPlan->plan_category == "General Category")
                                    {
                                        $color = "#4c84ff";
                                    }
                                    elseif($userPlan->plan_category == "Golden Category")
                                    {
                                        $color = "#fec400";
                                    }
                                    elseif($userPlan->plan_category == "Platinum Category")
                                    {
                                        $color = "#fe5461";
                                    }
                                    elseif($userPlan->plan_category == "Money Plant")
                                    {
                                        $color = "#29cc97";
                                    }
                                ?>
                                <li>
                                
                                    <span class="tf-nc" style="font-size:15px;">
                                        <a href="#">
                                            <i class="fas fa-atom" style="font-size:30px; color:{{ $color }}"></i></a>
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