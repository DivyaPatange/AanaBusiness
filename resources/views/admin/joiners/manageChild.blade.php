<?php 
use App\Models\User\Income;
use App\Models\User\JoinerLevel;
?>
<ul>
@foreach($childs as $child)
@if($loop->depth <= 7)
    <?php
        // dd($userProfile);
        $plan1 = DB::table('user_plans')->where('user_id', $child->id)->where('payment_status', 'Successful')->first();
        if($loop->depth == 2)
        {
            $items = count($items2);
            $count = 16;
            $percentAmt = 0.12;
        }
        elseif($loop->depth == 3)
        {
            $items = count($items3);
            $count = 64;
            $percentAmt = 0.1;
        }
        elseif($loop->depth == 4)
        {
            $items = count($items4);
            $count = 256; 
            $percentAmt = 0.08;
        }
        elseif($loop->depth == 5)
        {
            $items = count($items5);
            $count = 1024;
            $percentAmt = 0.06;
        }
        elseif($loop->depth == 6)
        {
            $items = count($items6);
            $count = 4096;
            $percentAmt = 0.04;
        }
        elseif($loop->depth == 7)
        {
            $items = count($items7);
            $count = 16384;
            $percentAmt = 0.02;
        }
        if(!empty($plan1))
        {
            $income = DB::table('incomes')->where('child_id', $child->id)->where('user_id', $userProfile->id)->first();
            if(empty($income))
            {
                $userOrder = DB::table('user_orders')->where('user_id', $child->id)->where('pay_amount', $plan1->plan_amt)->first();
                $userPayment = DB::table('user_payments')->where('user_id', $child->id)->where('order_id', $userOrder->id)->first();
                $income = new Income();
                $income->user_id = $userProfile->id;
                $income->child_id = $child->id;
                $income->level = $loop->depth;
                $income->plan_amount = $plan1->plan_amt;
                $income->payment_date = $userPayment->payment_datetime;
                $income->income_amount = $percentAmt * $plan1->plan_amt;
                $income->save();
            }
            $joinerLevel = DB::table('joiner_levels')->where('user_id', $userProfile->id)->where('level', $loop->depth)->first();
            if(empty($joinerLevel))
            {
                $joinerLevel = new JoinerLevel();
                $joinerLevel->user_id = $userProfile->id;
                $joinerLevel->level = $loop->depth;
                $joinerLevel->total_joiner = $count;
                $joinerLevel->joiner_added = count($childs);
                $joinerLevel->save();
            }
            else{
                if($items == $count)
                {
                    $status = 1;
                }
                else{
                    $status = 0;
                }
                $result = DB::table('joiner_levels')->where('user_id', $userProfile->id)->where('level', $loop->depth)->update(['joiner_added' => $items, 'status' => $status]);
            }
        }
    ?>
    @if(!empty($plan1))
    <li>
    
        @if(count($child->childs))
          
        
        @include('admin.joiners.manageChild',['childs' => $child->childs])
        
        @endif
        
    </li>
    @endif
@endif
@endforeach
</ul>