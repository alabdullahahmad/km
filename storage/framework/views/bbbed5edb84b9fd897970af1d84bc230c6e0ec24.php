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
                            <h5 class="font-weight-bold"><?php echo e(__('messages.Add_New_Rooms')); ?></h5>
                            <?php if($auth_user->can('slider list')): ?>
                            <?php endif; ?>
                                <a href="<?php echo e(route('slider.index')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> <?php echo e(__('messages.back')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::model($sliderdata,['method' => 'POST','route'=>($sliderdata->id)?'editRoom':'addRoom', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'slider'] )); ?>

                            <?php echo e(Form::hidden('id')); ?>

                            <?php echo e(Form::hidden('type','service')); ?>

                            <?php echo ($sliderdata->id) ? "<input type=hidden name=roomId value=$sliderdata->id>":""; ?>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('name',__('messages.name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                    <?php echo e(Form::text('name',old('name'),['placeholder' => __('messages.name'),'class' =>'form-control','required'])); ?>

                                    <small class="help-block with-errors text-danger"></small>
                                </div>

                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('capacity',__('messages.Capacity').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                    <?php echo e(Form::text('capacity',old('capacity'),['placeholder' => __('messages.Capacity'),'class' =>'form-control Capacity','required'])); ?>

                                    <small class="help-block with-errors text-danger" id="Capacity_err"></small>
                                </div>
                                

                              
                            </div>
                            
                            <?php echo e(Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary float-right'])); ?>

                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startSection('bottom_script'); ?>
    <script>
    $(document).on('keyup', '.Capacity', function() {
        var discountPercentageInput = document.getElementById('Capacity');
        var inputValue = discountPercentageInput.value;
    
        // السماح بالأرقام فقط
        inputValue = inputValue.replace(/[^0-9]/g, '');
        discountPercentageInput.value = inputValue;
    
        // التحقق من صحة المدخلات
        if (/^\d+$/.test(inputValue)) {
            $('#Capacity_err').text('');
        } else {
            $('#Capacity_err').text('الرجاء إدخال أرقام فقط لسعة الغرفة');
        }
    });
</script>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH /home/kmpower/public_html/resources/views/slider/create.blade.php ENDPATH**/ ?>