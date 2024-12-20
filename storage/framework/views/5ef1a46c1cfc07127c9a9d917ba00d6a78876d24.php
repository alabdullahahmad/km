<?php echo e(Form::model($user_data, ['route'=>'changePassword','method' => 'POST','data-toggle' => 'validator','id' => 'user-password'])); ?>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?php echo e(Form::hidden('id', null, array('placeholder' => 'id','class' => 'form-control'))); ?>

            <div class="form-group has-feedback">
                <?php echo e(Form::label('old_password',__('messages.old_password').' <span class="text-danger">*</span>',['class'=>'form-control-label col-md-12'], false )); ?>

                <div class="col-md-12">
                    <?php echo e(Form::password('old', ['class'=>"form-control", "id" => 'old_password' , "placeholder" => __('messages.old_password') ,'required'])); ?>

                </div>
            </div>
            <div class="form-group has-feedback">
                
                <?php echo e(Form::label('password',__('messages.new_password').' <span class="text-danger">*</span>',['class'=>'form-control-label col-md-12'], false )); ?>

                <div class="col-md-12">
                    <?php echo e(Form::password('password', ['class'=>"form-control" , 'id'=>"password", "placeholder" => __('messages.new_password') ,'required'])); ?>

                </div>
            </div>
            <div class="form-group has-feedback">
                <?php echo e(Form::label('password-confirm',__('messages.confirm_new_password').' <span class="text-danger">*</span>',['class'=>'form-control-label col-md-12'], false )); ?>

                <div class="col-md-12">
                    <?php echo e(Form::password('password_confirmation', ['class'=>"form-control" , 'id'=>"password-confirm", "placeholder" => __('messages.confirm_new_password') ,'required'])); ?>

                </div>
            </div>
            <div class="form-group ">
                <div class="col-md-12">
                    <?php echo e(Form::submit(__('messages.save'), ['id'=>"submit" ,'class'=>"btn btn-md btn-primary float-md-right mt-15"])); ?>

                </div>
            </div>
        </div>
    </div>
<?php echo e(Form::close()); ?><?php /**PATH C:\Users\USER\Desktop\km\resources\views/setting/password_form.blade.php ENDPATH**/ ?>