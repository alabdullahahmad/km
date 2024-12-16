
<?php
    $auth_user= authSession();
?>
{{ Form::open(['route' => ['deleteCategory', $data->id], 'method' => 'delete','data--submit'=>'category'.$data->id]) }}
<div class=" justify-content-end align-items-center">
    @if(!$data->trashed())

    <a class="mr-2" href="{{ route('category.create',['id' => $data->id]) }}" title="{{ __('messages.update_form_title',['form' => __('messages.category') ]) }}"><i class="fas fa-pen text-secondary"></i></a>

        @if($auth_user->can('category delete'))
        <a class="mr-3 delete-category" style="margin: 5%" href="{{ route('deleteCategory', $data->id) }}" data--submit="category{{$data->id}}"
            data--ajax="true"
            data--datatable="reload"
            data--confirmation="true"
            data-title="{{ __('category',['form'=>  __('category') ]) }}"
            title="{{ __('messages.delete_form_title',['form'=>  __('messages.category') ]) }}"
            data--message='{{ __("messages.delete_msg") }}'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
        @endif
    @endif

    @if(auth()->user()->hasAnyRole(['admin']) && $data->trashed())
        <a href="{{ route('category.action',['id' => $data->id, 'type' => 'restore']) }}"
            title="{{ __('messages.restore_form_title',['form' => __('messages.category') ]) }}"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="{{ __('messages.restore_form_title',['form'=>  __('messages.category') ]) }}"
            data-message='{{ __("messages.restore_msg") }}'
            data-datatable="reload"
            class="mr-2">
            <i class="fas fa-redo text-secondary"></i>
        </a>
        <a href="{{ route('category.action',['id' => $data->id, 'type' => 'forcedelete']) }}"
            title="{{ __('messages.forcedelete_form_title',['form' => __('messages.category') ]) }}"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="{{ __('messages.forcedelete_form_title',['form'=>  __('messages.category') ]) }}"
            data-message='{{ __("messages.forcedelete_msg") }}'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    @endif
</div>


{{ Form::close() }}
