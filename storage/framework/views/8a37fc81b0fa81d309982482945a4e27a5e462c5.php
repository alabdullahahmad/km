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
                            <h5 class="font-weight-bold"><?php echo e(__('messages.Player_Registration')); ?></h5>
                            <a href="#" class="float-right btn btn-sm btn-primary">
                                <i class="fa fa-angle-double-left"></i> <?php echo e(__('messages.back')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(['method' => 'POST', 'route' => 'addUser', 'enctype' => 'multipart/form-data', 'data-toggle' => "validator", 'id' => 'handyman'])); ?>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('name', __('messages.name') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false)); ?>

                                <?php echo e(Form::text('name', 'John Doe', ['placeholder' => __('messages.name'), 'class' => 'form-control', 'required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            

                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('gender', __('messages.select_gender', ['select' => __('messages.gender')]) . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false)); ?>

                                <?php echo e(Form::select('gender', ['male' => 'Male', 'female' => 'Female'], 'male', ['class' => 'form-control select2js', 'required'])); ?>

                            </div>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('birthDay', __('messages.birthday') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false)); ?>

                                <?php echo e(Form::text('birthDay', '2000-01-01', ['placeholder' => __('messages.birthday'), 'class' => 'form-control datepicker', 'required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('phoneNumber', __('messages.phone') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false)); ?>

                                <?php echo e(Form::text('phoneNumber', '1234567890', ['placeholder' => __('messages.phone'), 'class' => 'form-control contact_number', 'required'])); ?>

                                <small class="help-block with-errors text-danger" id="contact_number_err"></small>
                            </div>
                            

                            

                            

                            
                        </div>
                        <?php echo e(Form::submit(__('messages.create_subscription'), ['class' => 'btn btn-md btn-primary float-right'])); ?>

                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->startSection('bottom_script'); ?>
    <script type="text/javascript">
        (function ($) {
            "use strict";
            $(document).ready(function () {
                // بيانات وهمية للولايات
                var states = [
                    { id: 1, text: "State 1" },
                    { id: 2, text: "State 2" },
                    { id: 3, text: "State 3" },
                ];

                // بيانات وهمية للمدن
                var cities = [
                    { id: 1, text: "City 1" },
                    { id: 2, text: "City 2" },
                    { id: 3, text: "City 3" },
                ];

                // إعداد القوائم الوهمية
                $('#state_id').select2({
                    data: states,
                    placeholder: "Select State",
                });

                $('#city_id').select2({
                    data: cities,
                    placeholder: "Select City",
                });
            });
        })(jQuery);
    </script>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?>
<?php /**PATH C:\Users\HP\OneDrive\سطح المكتب\km\resources\views/setting/term_condition_form.blade.php ENDPATH**/ ?>