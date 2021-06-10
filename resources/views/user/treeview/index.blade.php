@extends('user.user_layout.main')
@section('title', 'Treeview')
@section('page_title', 'My Tree')
@section('customcss')
<link href="https://unpkg.com/treeflex/dist/css/treeflex.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/60f2fb32da.js" crossorigin="anonymous"></script>
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
    border-left:.0625em solid #f0eeee;
}
.tf-tree li li:before{
    border-top:.0625em solid #f0eeee;
}
</style>
@endsection
@section('content')
@if($authPlan->plan_category != "Money Plant")
<div class="row mt--2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-center bg-dark text-white">
                <div class="tf-tree example">
                    <ul>
                        <li>
                            <!-- <span class="tf-nc" id="demo"></span> -->
                            <span class="tf-nc">
                                <i class="fas fa-atom" style="font-size:25px;"></i>
                                <br>
                                {{ Auth::user()->first_name }}&nbsp;{{ Auth::user()->middle_name }}&nbsp;{{ Auth::user()->last_name }}
                                <br>
                                {{Auth::user()->username}}
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
                                    
                                        @include('user.treeview.manageChild',['childs' => $user->childs])                                                
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
@else
<div class="row mt--2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body text-center bg-dark text-white">
                <div class="tf-tree example">
                    <ul>
                        <li>
                            <!-- <span class="tf-nc" id="demo"></span> -->
                            <span class="tf-nc">
                                <i class="fas fa-atom" style="font-size:25px;"></i>
                                <br>
                                {{ Auth::user()->first_name }}&nbsp;{{ Auth::user()->middle_name }}&nbsp;{{ Auth::user()->last_name }}
                                <br>
                                {{Auth::user()->username}}
                            </span>
                            <ul>
                                                        
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
@endif
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