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
                    <div class="d-flex justify-content-between align-items-center p-3">
                    <h5 class="font-weight-bold"><?php echo e(__('messages.Add_New_Bill')); ?></h5>
                                <a href="<?php echo e(route('wallet.index')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> <?php echo e(__('messages.back')); ?></a>
                            <?php if($auth_user->can('providertype list')): ?>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <?php echo e(Form::model($wallet,['method' => 'POST','route'=>(isset($wallet->id))?'editBill':'addBill', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'wallet'] )); ?>

                    <?php echo e(Form::hidden('id')); ?>

                         <?php echo isset($wallet->id) ? "<input type=hidden name=billId value=$wallet->id>":""; ?>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('cash', __('messages.select_cash',[ 'select' => __('messages.cash') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <br />
                                <?php echo e(Form::select('cash',['cash' => __('messages.cash') /*, 'fixed' => __('messages.fixed')*/ ],old('cash'),[ 'id' => 'type' ,'class' =>'form-control select2js','required'])); ?>

                            </div>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('payType',__('messages.type').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::select('payType',['in' => __('messages.in') , 'out' => __('messages.out') ],old('payType'),[ 'class' =>'form-control select2js','required'])); ?>

                            </div>
                            <!--<div class="form-group col-md-4">-->
                            <!--    <?php echo e(Form::label('date',__('messages.Date').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>-->
                            <!--    <?php echo e(Form::text('date',old('date') ?? now(),['placeholder' => __('messages.Date'),'class' =>'form-control datepicker','required'])); ?>-->
                            <!--    <small class="help-block with-errors text-danger"></small>-->
                            <!--</div>-->
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('amount',__('messages.amount').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::number('amount',null, [ 'min' => 0, 'step' => 'any' , 'placeholder' => __('messages.amount'),'class' =>'form-control', 'required' ])); ?>

                            </div>


                            <div class="form-group col-md-12">
                                <?php echo e(Form::label('description',__('messages.description').' <span class="text-danger">*</span>',['class' => 'form-control-label'],false)); ?>

                                <?php echo e(Form::textarea('description', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.description') ])); ?>

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
<?php /**PATH C:\Users\HP\OneDrive\سطح المكتب\km\resources\views/wallet/create.blade.php ENDPATH**/ ?>