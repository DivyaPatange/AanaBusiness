<ul>
@foreach($childs as $child)
@if($loop->depth <= 7)
    <?php
        $userPlan = DB::table('user_plans')->where('user_id', $child->id)->where('payment_status', 'Successful')->first();
    ?>
    @if(!empty($userPlan))
    <li>
    <span class="tf-nc" style="font-size:15px;">
    <a href="#"><i class="fas fa-atom" style="font-size:30px; color:red"></i></a>
    <br>
    
        {{ $child->first_name }}&nbsp;{{ $child->middle_name }}&nbsp;{{ $child->last_name }}
        <br>
        {{ $child->username }}
        </span>
        @if(count($child->childs))
          
        
        @include('user.treeview.manageChild',['childs' => $child->childs])
        
        @endif
        
    </li>
    @endif
@endif
@endforeach
</ul>