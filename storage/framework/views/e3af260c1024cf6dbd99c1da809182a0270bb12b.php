
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['deleteCategory', $data->id], 'method' => 'delete','data--submit'=>'category'.$data->id])); ?>

<div class=" justify-content-end align-items-center">
    <?php if(!$data->trashed()): ?>

    <a class="mr-2" href="<?php echo e(route('category.create',['id' => $data->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.category') ])); ?>"><i class="fas fa-pen text-secondary"></i></a>

        <?php if($auth_user->can('category delete')): ?>
        <a class="mr-3 delete-category" style="margin: 5%" href="<?php echo e(route('deleteCategory', $data->id)); ?>" data--submit="category<?php echo e($data->id); ?>"
            data--ajax="true"
            data--datatable="reload"
            data--confirmation="true"
            data-title="<?php echo e(__('category',['form'=>  __('category') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.category') ])); ?>"
            data--message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(auth()->user()->hasAnyRole(['admin']) && $data->trashed()): ?>
        <a href="<?php echo e(route('category.action',['id' => $data->id, 'type' => 'restore'])); ?>"
            title="<?php echo e(__('messages.restore_form_title',['form' => __('messages.category') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.restore_form_title',['form'=>  __('messages.category') ])); ?>"
            data-message='<?php echo e(__("messages.restore_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="fas fa-redo text-secondary"></i>
        </a>
        <a href="<?php echo e(route('category.action',['id' => $data->id, 'type' => 'forcedelete'])); ?>"
            title="<?php echo e(__('messages.forcedelete_form_title',['form' => __('messages.category') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.forcedelete_form_title',['form'=>  __('messages.category') ])); ?>"
            data-message='<?php echo e(__("messages.forcedelete_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    <?php endif; ?>
</div>


<?php echo e(Form::close()); ?>

<?php /**PATH /home/kmpower/public_html/resources/views/category/action.blade.php ENDPATH**/ ?>