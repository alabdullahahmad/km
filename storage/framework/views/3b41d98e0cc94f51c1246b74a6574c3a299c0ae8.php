
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['deleteCoach', $handyman->id], 'method' => 'delete','data--submit'=>'handyman'.$handyman->id])); ?>

<div class="d-flex justify-content-end align-items-center">
   
   
    <a class="mr-2" href="<?php echo e(route('handyman.create', ['id' => $handyman->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.provider') ])); ?>"><i class="fas fa-pen text-secondary"></i></a>
 
     <?php if($auth_user->can('handyman changePassword')): ?>
      <a class="mr-2" href="<?php echo e(route('handyman.getchangepassword',['id' => $handyman->id])); ?>" title="<?php echo e(__('messages.change_password',['form' => __('messages.handyman') ])); ?>"><i class="fa fa-lock text-success "></i></a>
      <?php endif; ?>
        <?php if($auth_user->can('handyman delete')): ?>
        <a class="mr-3 text-danger" href="<?php echo e(route('deleteCoach', $handyman->id)); ?>" data--submit="handyman<?php echo e($handyman->id); ?>" 
            data--confirmation='true' 
            data--ajax="true"
            data-datatable="reload"
            data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.handyman') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.handyman') ])); ?>"
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt"></i>
        </a>
        <?php endif; ?>
   
 
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\Users\USER\Desktop\km\resources\views/handyman/action.blade.php ENDPATH**/ ?>