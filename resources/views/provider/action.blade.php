
<?php
$auth_user= authSession();
?>
{{ Form::open(['route' => ['deleteStaf', $provider->id], 'method' => 'delete','data--submit'=>'provider'.$provider->id]) }}
<div class="d-flex justify-content-end align-items-center">
{{-- <a class="mr-2" href="{{ route('provider.time-slot',['id' => $provider->id]) }}" title="{{ __('messages.My_time_slot',['form' => __('messages.provider') ]) }}"><i class="fa fa-clock text-primary "></i></a> --}}


    @if($auth_user->can('receptionsedit'))
    <a class="mr-2" href="{{ route('provider.create',['id' => $provider->id]) }}" title="{{ __('messages.update_form_title',['form' => __('messages.provider') ]) }}"><i class="fas fa-pen text-secondary"></i></a>
    @endif
    @if($auth_user->can('receptionsdelete'))
    <a class="mr-2 text-danger" href="{{ route('deleteStaf', $provider->id) }}" data--submit="provider{{$provider->id}}" 
        data--confirmation='true'
        data--ajax="true"
        data-datatable="reload"
        data-title="{{ __('messages.delete_form_title',['form'=>  __('messages.provider') ]) }}"
        title="{{ __('messages.delete_form_title',['form'=>  __('messages.provider') ]) }}"
        data-message='{{ __("messages.delete_msg") }}'>
        <i class="far fa-trash-alt"></i>
    </a>
    @endif


</div>
{{ Form::close() }}