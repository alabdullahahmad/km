
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['deleteSubscription', $data->id], 'method' => 'delete','data--submit'=>'service'.$data->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <?php if($auth_user->can('service edit')): ?>
    <a class="mr-2" href="<?php echo e(route('service.creat.id',[$data->categoryId,'id' => $data->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.service') ])); ?>"><i class="fas fa-pen text-secondary"></i></a>
    <?php endif; ?>
        <?php if($auth_user->can('service delete')): ?>
        <a class="mr-2" href="<?php echo e(route('deleteSubscription', $data->id)); ?>" data--submit="service<?php echo e($data->id); ?>"
            data--confirmation='true'
            data--ajax="true"
            data-datatable="reload"
            data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.service') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.service') ])); ?>"
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
        <?php endif; ?>


</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\Users\USER\Desktop\km\resources\views/service/action.blade.php ENDPATH**/ ?>