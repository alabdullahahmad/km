<?php if (isset($component)) { $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\MasterLayout::class, []); ?>
<?php $component->withName('master-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold"><?php echo e(__('messages.Tag_New_Subscriptions')); ?></h5>
                            <?php if($auth_user->can('category list')): ?>
                                <a href="<?php echo e(route('subcategory.index')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> <?php echo e(__('messages.back')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::model($subcategory,['method' => 'POST','route'=>(isset($subcategory->id))?'editTag':'addTag' , 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'subcategory'] )); ?>

                            <?php echo e(Form::hidden('id')); ?>

                            <?php echo ($subcategory->id) ? "<input type=hidden name=tagId value=$subcategory->id>":""; ?>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('name',trans('messages.name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                    <?php echo e(Form::text('name',old('name'),['placeholder' => trans('messages.name'),'class' =>'form-control','required'])); ?>

                                    <small class="help-block with-errors text-danger"></small>
                                </div>

                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('name', __('messages.select_name',[ 'select' => __('messages.category') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                    <br />
                                    <?php echo e(Form::select('category_id', [optional($subcategory->category)->id => optional($subcategory->category)->name], optional($subcategory->category)->id, [
                                            'class' => 'select2js form-group category',
                                            'required',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.category') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'category']),
                                        ])); ?>


                                </div>



                            </div>

                            <?php echo e(Form::submit( trans('messages.save'), ['class'=>'btn btn-md btn-primary float-right'])); ?>

                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?>
<?php /**PATH C:\Users\USER\Desktop\km\resources\views/subcategory/create.blade.php ENDPATH**/ ?>