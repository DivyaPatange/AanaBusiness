<ul>
@foreach($childs as $child)
    <?php
        $userPlan = DB::table('user_plans')->where('user_id', $child->id)->where('payment_status', 'Successful')->first();
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
    <a href="#"><i class="fas fa-atom" style="font-size:30px; color:{{ $color }}"></i></a>
    <br>
    
        {{ $child->first_name }}&nbsp;{{ $child->middle_name }}&nbsp;{{ $child->last_name }}
        <br>
        {{ $child->username }}
        </span>
        @if(count($child->childs))
          
        
        @include('admin.treeview.manageChild',['childs' => $child->childs])
        
        @endif
        
    </li>
    @endif
@endforeach
</ul>