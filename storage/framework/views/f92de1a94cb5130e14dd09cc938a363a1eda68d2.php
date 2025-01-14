
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['deleteTag', $data->id], 'method' => 'delete','data--submit'=>'subcategory'.$data->id])); ?>

<div class="justify-content-end align-items-center">
    <a class="mr-2" href="<?php echo e(route('subcategory.create',['id' => $data->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.subcategory') ])); ?>"><i class="fas fa-pen text-secondary"></i></a>
        <?php if($auth_user->can('tagsubscriptions delete')): ?>
        <a class="mr-3" style="margin: 5%" href="<?php echo e(route('deleteTag', $data->id)); ?>" data--submit="subcategory<?php echo e($data->id); ?>"
            data--confirmation='true'
            data--ajax="true"
            data-datatable="reload"
            data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.subcategory') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.subcategory') ])); ?>"
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
        <?php endif; ?>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\Users\USER\Desktop\km\resources\views/subcategory/action.blade.php ENDPATH**/ ?>