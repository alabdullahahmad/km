
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['tax.destroy', $tax->id], 'method' => 'delete','data--submit'=>'tax'.$tax->id])); ?>

<div class="d-flex justify-content-end align-items-center">

    <a class="mr-3" href="<?php echo e(route('tax.destroy', $tax->id)); ?>" data--submit="tax<?php echo e($tax->id); ?>" 
        data--confirmation='true' 
        data--ajax="true"
        data-datatable="reload"
        data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.tax') ])); ?>"
        title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.tax') ])); ?>"
        data-message='<?php echo e(__("messages.delete_msg")); ?>'>
        <i class="far fa-trash-alt text-danger"></i>
    </a>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\Users\USER\Desktop\km\resources\views/taxes/action.blade.php ENDPATH**/ ?>