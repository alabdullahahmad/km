
<?php
    $auth_user= authSession();
?>
{{ Form::open(['route' => ['deleteTag', $data->id], 'method' => 'delete','data--submit'=>'subcategory'.$data->id]) }}
<div class="justify-content-end align-items-center">
    <a class="mr-2" href="{{ route('subcategory.create',['id' => $data->id]) }}" title="{{ __('messages.update_form_title',['form' => __('messages.subcategory') ]) }}"><i class="fas fa-pen text-secondary"></i></a>
        @if($auth_user->can('subcategory delete'))
        <a class="mr-3" style="margin: 5%" href="{{ route('deleteTag', $data->id) }}" data--submit="subcategory{{$data->id}}"
            data--confirmation='true'
            data--ajax="true"
            data-datatable="reload"
            data-title="{{ __('messages.delete_form_title',['form'=>  __('messages.subcategory') ]) }}"
            title="{{ __('messages.delete_form_title',['form'=>  __('messages.subcategory') ]) }}"
            data-message='{{ __("messages.delete_msg") }}'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
        @endif

</div>
{{ Form::close() }}
