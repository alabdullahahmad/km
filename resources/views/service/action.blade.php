
<?php
    $auth_user= authSession();
?>
{{ Form::open(['route' => ['deleteSubscription', $data->id], 'method' => 'delete','data--submit'=>'service'.$data->id]) }}
<div class="d-flex justify-content-end align-items-center">
    @if($auth_user->can('subscription edit'))
    <a class="mr-2" href="{{ route('service.creat.id',[$data->categoryId,'id' => $data->id]) }}" title="{{ __('messages.update_form_title',['form' => __('messages.service') ]) }}"><i class="fas fa-pen text-secondary"></i></a>
    @endif
        @if($auth_user->can('subscription delete'))
        <a class="mr-2" href="{{ route('deleteSubscription', $data->id) }}" data--submit="service{{$data->id}}"
            data--confirmation='true'
            data--ajax="true"
            data-datatable="reload"
            data-title="{{ __('messages.delete_form_title',['form'=>  __('messages.service') ]) }}"
            title="{{ __('messages.delete_form_title',['form'=>  __('messages.service') ]) }}"
            data-message='{{ __("messages.delete_msg") }}'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
        @endif


</div>
{{ Form::close() }}
