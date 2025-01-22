
<?php
    $auth_user= authSession();
?>
{{ Form::open(['route' => ['coupon.destroy', $coupon->id], 'method' => 'delete','data--submit'=>'coupon'.$coupon->id]) }}
<div class="d-flex  align-items-center">
    
       @if($auth_user->can('branch edit'))
        <a href="{{ route('coupon.create',['id' => $coupon->id]) }}" title="{{ __('messages.update_form_title',['form' => __('messages.coupon') ]) }}"><i class="fas fa-pen text-primary mr-2"></i></a>
        @endif 
        @if($auth_user->can('branch delete'))
        <a class=" mr-3" href="{{ route('deleteBranch', ['branchId'=>$coupon->id]) }}" data--submit="coupon{{$coupon->id}}" 
            title="{{ __('messages.delete_form_title',['form' => __('messages.coupon') ]) }}"
            data--confirmation='true' 
            data--ajax="true"
            data-datatable="reload"
            data-title="{{ __('messages.delete_form_title',['form'=>  __('messages.coupon') ]) }}"
            title="{{ __('messages.delete_form_title',['form'=>  __('messages.coupon') ]) }}"   
            data-message='{{ __("messages.delete_msg") }}'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    @endif

</div>
{{ Form::close() }}