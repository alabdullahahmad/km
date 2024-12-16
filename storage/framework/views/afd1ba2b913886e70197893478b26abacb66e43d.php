
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['blog.destroy', $blog->id], 'method' => 'delete','data--submit'=>'blog'.$blog->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <?php if(!$blog->trashed()): ?>
         <?php if($auth_user->can('blog edit')): ?>
        <a class="mr-2" href="<?php echo e(route('blog.create',['id' => $blog->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.blog') ])); ?>"><i class="fas fa-pen text-primary"></i></a>
        <?php endif; ?> 

        <?php if($auth_user->can('blog delete')): ?>
        <a class="mr-3" href="<?php echo e(route('blog.destroy', $blog->id)); ?>" data--submit="blog<?php echo e($blog->id); ?>" 
            data--confirmation='true'
            data--ajax="true" 
            data-datatable="reload"
            data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.blog') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.blog') ])); ?>"
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(auth()->user()->hasAnyRole(['admin']) && $blog->trashed()): ?>
        <a href="<?php echo e(route('blog.action',['id' => $blog->id, 'type' => 'restore'])); ?>"
            title="<?php echo e(__('messages.restore_form_title',['form' => __('messages.blog') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.restore_form_title',['form'=>  __('messages.blog') ])); ?>"
            data-message='<?php echo e(__("messages.restore_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="fas fa-redo text-secondary"></i>
        </a>
        <a href="<?php echo e(route('blog.action',['id' => $blog->id, 'type' => 'forcedelete'])); ?>"
            title="<?php echo e(__('messages.forcedelete_form_title',['form' => __('messages.blog') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.forcedelete_form_title',['form'=>  __('messages.blog') ])); ?>"
            data-message='<?php echo e(__("messages.forcedelete_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\Users\HP\OneDrive\سطح المكتب\km\resources\views/blog/action.blade.php ENDPATH**/ ?>