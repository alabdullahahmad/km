
<?php
    $auth_user= authSession();
?>
<?php if(auth()->user()->hasAnyRole(['admin','demo_admin','Viewing'])): ?>
<div class="d-flex justify-content-end align-items-center">
        <a class="mr-2" href="<?php echo e(route('wallet.create',['id' => $wallet->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.wallet') ])); ?>"><i class="fas fa-pen text-secondary"></i></a>
    </div>
<?php endif; ?>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\Users\HP\OneDrive\سطح المكتب\km\resources\views/wallet/action.blade.php ENDPATH**/ ?>