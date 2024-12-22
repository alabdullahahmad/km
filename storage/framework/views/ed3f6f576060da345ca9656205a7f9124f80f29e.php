
<?php
$auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['deleteStaf', $provider->id], 'method' => 'delete','data--submit'=>'provider'.$provider->id])); ?>

<div class="d-flex justify-content-end align-items-center">



    <?php if($auth_user->can('provider edit')): ?>
    <a class="mr-2" href="<?php echo e(route('provider.create',['id' => $provider->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.provider') ])); ?>"><i class="fas fa-pen text-secondary"></i></a>
    <?php endif; ?>
    <?php if($auth_user->can('provider delete')): ?>
    <a class="mr-2 text-danger" href="<?php echo e(route('deleteStaf', $provider->id)); ?>" data--submit="provider<?php echo e($provider->id); ?>" 
        data--confirmation='true'
        data--ajax="true"
        data-datatable="reload"
        data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.provider') ])); ?>"
        title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.provider') ])); ?>"
        data-message='<?php echo e(__("messages.delete_msg")); ?>'>
        <i class="far fa-trash-alt"></i>
    </a>
    <?php endif; ?>


</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\Users\HP\OneDrive\سطح المكتب\km\resources\views/provider/action.blade.php ENDPATH**/ ?>