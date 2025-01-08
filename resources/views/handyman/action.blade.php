
<?php
    $auth_user= authSession();
?>
{{ Form::open(['route' => ['deleteCoach', $handyman->id], 'method' => 'delete','data--submit'=>'handyman'.$handyman->id]) }}
<div class="d-flex  align-items-center">
   
   
    <a class="mr-2" href="{{route('handyman.create', ['id' => $handyman->id]) }}" title="{{ __('messages.update_form_title',['form' => __('messages.provider') ]) }}"><i class="fas fa-pen text-secondary"></i></a>
 
     @if($auth_user->can('coaches changePassword'))
      <a class="mr-2" href="{{ route('handyman.getchangepassword',['id' => $handyman->id]) }}" title="{{ __('messages.change_password',['form' => __('messages.handyman') ]) }}"><i class="fa fa-lock text-success "></i></a>
      @endif
        @if($auth_user->can('coaches delete'))
        <a class="mr-3 text-danger" href="{{ route('deleteCoach', $handyman->id) }}" data--submit="handyman{{$handyman->id}}" 
            data--confirmation='true' 
            data--ajax="true"
            data-datatable="reload"
            data-title="{{ __('messages.delete_form_title',['form'=>  __('messages.handyman') ]) }}"
            title="{{ __('messages.delete_form_title',['form'=>  __('messages.handyman') ]) }}"
            data-message='{{ __("messages.delete_msg") }}'>
            <i class="far fa-trash-alt"></i>
        </a>
        @endif
   
 
</div>
{{ Form::close() }}