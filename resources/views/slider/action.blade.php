
<?php
    $auth_user= authSession();
?>
{{ Form::open(['route' => ['deleteRoom', $slider->id], 'method' => 'delete','data--submit'=>'slider'.$slider->id]) }}
<div class="d-flex justify-content-end align-items-center">

   



    
        @if($auth_user->can('slider edit'))
        <a class="mr-2" href="{{ route('slider.create',['id' => $slider->id]) }}" title="{{ __('messages.update_form_title',['form' => __('messages.slider') ]) }}"><i class="fas fa-pen text-primary"></i></a>
        @endif 
   
    @if($auth_user->can('slider delete'))
        <a class="mr-3 text-danger" href="{{ route('deleteRoom', $slider->id) }}" data--submit="slider{{$slider->id}}" 
            data--confirmation='true' 
            data--ajax="true"
            data-reload="reload"
            data-title="{{ __('messages.delete_form_title',['form'=>  __('messages.slider') ]) }}"
            title="{{ __('messages.delete_form_title',['form'=>  __('messages.slider') ]) }}"
            data-message='{{ __("messages.delete_msg") }}'>
            <i class="far fa-trash-alt"></i>
        </a>
    @endif

</div>
{{ Form::close() }}