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
                            <h5 class="font-weight-bold"><?php echo e(__('messages.Push_Notification')); ?></h5>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <?php echo e(Form::model($settings,['method' => 'POST','route'=>'sendPushNotification', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'push_notification'] )); ?>

    <?php echo e(Form::hidden('id')); ?>

    <div class="row">
       
        <div class="form-group col-md-12">
            <?php echo e(Form::label('title',trans('messages.title').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

            <?php echo e(Form::text('title',old('title'),['id'=>'title','placeholder' => trans('messages.title'),'class' =>'form-control','required'])); ?>

            <small class="help-block with-errors text-danger"></small>
        </div>
        
       <div class="form-group col-md-12 d-none" id="select_service">
    <?php echo e(Form::label('name', __('messages.select_name', ['select' => __('messages.service')]).' <span class="text-danger">*</span>', ['class' => 'form-control-label', 'data-placeholder' => __('messages.select_name', ['select' => __('messages.tax')])], false)); ?>

    <br />
    <select class="form-control service" name="service_id" id="serviceSelect">
 
        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

        <div class="form-group col-md-12">
            <?php echo e(Form::label('description',trans('messages.description').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false)); ?>

            <?php echo e(Form::textarea('description', null, ['class'=>"form-control textarea" ,'id'=>'description','rows'=>3  , 'required','placeholder'=> __('messages.description') ])); ?>

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
<script>
    $(document).ready(function (){
        var value =  $('.service').find(':selected').attr('data-type');
        $(document).on('change','.is_type',function(){
            var type =  $(this).val();
            
            if(type == 'provider'){
                $('#select_type').addClass('d-none');
                $('#select_service').addClass('d-none');
                $('#description').val('');
            }else{
                $('#select_type').removeClass('d-none');
                var type = $('.notification_type').find(':selected').val();
                if(type == "alldata"){
                    $('#select_service').addClass('d-none');
                    $('#description').val('')
                }
                else{
                    $('#select_service').removeClass('d-none');
                    textareaValue(value)
                }
                
            }
        });

        $(document).on('change','.notification_type',function(){
            var type =  $(this).val();
            if(type == 'service'){
                textareaValue(value)
                $('#select_service').removeClass('d-none');
            }else{
                $('#select_service').addClass('d-none');
                $('#description').val('')
            }
        });
        $(document).on('change','.service',function(){
            var value =  $(this).find(':selected').attr('data-type');
            textareaValue(value)
            
        });
    });
    function textareaValue(value){
        $('#description').val(value)
    }
    $(document).ready(function() {
    $('#serviceSelect').select2();
});
</script><?php /**PATH C:\Users\USER\Desktop\km\resources\views/setting/push-notification-setting.blade.php ENDPATH**/ ?>