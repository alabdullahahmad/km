<?php echo e(Form::model($payment_data, ['method' => 'POST','route' => ['paymentsettingsUpdates'],'enctype'=>'multipart/form-data','data-toggle'=>'validator'])); ?>


<?php echo e(Form::hidden('id', null, array('placeholder' => 'id','class' => 'form-control'))); ?>

<?php echo e(Form::hidden('type', $tabpage, array('placeholder' => 'id','class' => 'form-control'))); ?>

<div class="row">
    <div class="form-group col-md-12">
        <label for="enable_cod"><?php echo e(__('messages.payment_on',['gateway'=>__('messages.cod')])); ?></label>
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" name="status" id="enable_cod" <?php echo e(!empty($payment_data->status) ? 'checked' : ''); ?>>
            <label class="custom-control-label" for="enable_cod"></label>
        </div>
    </div>
</div>
<div class="row" id='enable_cod_payment'>
    <div class="form-group col-md-12">
        <?php echo e(Form::label('title',trans('messages.gateway_name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

        <?php echo e(Form::text('title',old('title'),['placeholder' => trans('messages.title'),'class' =>'form-control'])); ?>

        <small class="help-block with-errors text-danger"></small>
    </div>
</div>
<?php echo e(Form::submit(__('messages.save'), ['class'=>"btn btn-md btn-primary float-md-right"])); ?>

<?php echo e(Form::close()); ?>

<script>
var enable_cod = $("input[name='status']").prop('checked');
checkPaymentTabOption(enable_cod);

$('#enable_cod').change(function(){
    value = $(this).prop('checked') == true ? true : false;
    checkPaymentTabOption(value);
});
function checkPaymentTabOption(value){
    if(value == true){
        $('#enable_cod_payment').removeClass('d-none');
        $('#title').prop('required', true);
    }else{
        $('#enable_cod_payment').addClass('d-none');
        $('#title').prop('required', false);
    }
}
</script><?php /**PATH C:\Users\USER\Desktop\km\resources\views/paymentgateway/cash.blade.php ENDPATH**/ ?>