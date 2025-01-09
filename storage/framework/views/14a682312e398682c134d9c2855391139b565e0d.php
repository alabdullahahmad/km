
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['handymantype.destroy', $handymantype->id], 'method' => 'delete','data--submit'=>'handymantype'.$handymantype->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <?php if(!$handymantype->trashed()): ?>
        <?php if(auth()->user()->hasRole(['provider','admin']) ): ?>
            <a class="mr-3 text-danger" href="<?php echo e(route('handymantype.destroy', $handymantype->id)); ?>" data--submit="handymantype<?php echo e($handymantype->id); ?>" 
                data--confirmation='true' 
                data--ajax="true"
                data-datatable="reload"
                data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.handymantype') ])); ?>"
                title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.handymantype') ])); ?>"
                data-message='<?php echo e(__("messages.delete_msg")); ?>'>
                <i class="far fa-trash-alt"></i>
            </a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(auth()->user()->hasAnyRole(['provider','admin']) && $handymantype->trashed()): ?>
        <a class="mr-2" href="<?php echo e(route('handymantype.action',['id' => $handymantype->id, 'type' => 'restore'])); ?>"
            title="<?php echo e(__('messages.restore_form_title',['form' => __('messages.handymantype') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.restore_form_title',['form'=>  __('messages.handymantype') ])); ?>"
            data-message='<?php echo e(__("messages.restore_msg")); ?>'
            data-datatable="reload">
            <i class="fas fa-redo text-secondary"></i>
        </a>
        <a href="<?php echo e(route('handymantype.action',['id' => $handymantype->id, 'type' => 'forcedelete'])); ?>"
            title="<?php echo e(__('messages.forcedelete_form_title',['form' => __('messages.handymantype') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.forcedelete_form_title',['form'=>  __('messages.handymantype') ])); ?>"
            data-message='<?php echo e(__("messages.forcedelete_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\Users\USER\Desktop\km\resources\views/handymantype/action.blade.php ENDPATH**/ ?>