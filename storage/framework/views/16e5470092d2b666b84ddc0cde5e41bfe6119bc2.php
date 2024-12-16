
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['deleteRoom', $slider->id], 'method' => 'delete','data--submit'=>'slider'.$slider->id])); ?>

<div class="d-flex justify-content-end align-items-center">

   



    
        <?php if($auth_user->can('slider edit')): ?>
        <a class="mr-2" href="<?php echo e(route('slider.create',['id' => $slider->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.slider') ])); ?>"><i class="fas fa-pen text-primary"></i></a>
        <?php endif; ?> 
   
    <?php if($auth_user->can('slider delete')): ?>
        <a class="mr-3 text-danger" href="<?php echo e(route('deleteRoom', $slider->id)); ?>" data--submit="slider<?php echo e($slider->id); ?>" 
            data--confirmation='true' 
            data--ajax="true"
            data-reload="reload"
            data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.slider') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.slider') ])); ?>"
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt"></i>
        </a>
    <?php endif; ?>

</div>
<?php echo e(Form::close()); ?><?php /**PATH /home/kmpower/public_html/resources/views/slider/action.blade.php ENDPATH**/ ?>