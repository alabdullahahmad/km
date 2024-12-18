<div class="col-md-12">
    <div class="row ">
        <div class="col-md-3">
            <div class="user-sidebar">
                <div class="user-body user-profile text-center mx-0 px-0">
                    <div class="user-img">
                        <img class="rounded-circle avatar-90 image-fluid profile_image_preview"
                            src="<?php echo e(getSingleMedia($user_data,'profile_image', null)); ?>" alt="profile-pic">
                    </div>
                    <div class="sideuser-info">
                        <span class="mb-2"><?php echo e($user_data->display_name); ?></span>
                        <!-- <a><?php echo e($user_data->email); ?></a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="user-content">
                <?php echo e(Form::model($user_data, ['route'=>'updateProfile','method' => 'POST','data-toggle'=>"validator" , 'enctype'=> 'multipart/form-data','id' => 'user-form'])); ?>

                <input type="hidden" name="profile" value="profile">
                <?php echo e(Form::hidden('username')); ?>

                <?php echo e(Form::hidden('email')); ?>

                <?php echo e(Form::hidden('id', null, array('placeholder' => 'id','class' => 'form-control'))); ?>

                <div class="row ">

                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('first_name',__('messages.first_name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                        <?php echo e(Form::text('first_name',old('first_name'),['placeholder' => __('messages.first_name'),'class' =>'form-control','required'])); ?>

                        <small class="help-block with-errors text-danger"></small>
                    </div>

                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('last_name',__('messages.last_name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                        <?php echo e(Form::text('last_name',old('last_name'),['placeholder' => __('messages.last_name'),'class' =>'form-control','required'])); ?>

                        <small class="help-block with-errors text-danger"></small>
                    </div>

                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('username',__('messages.username').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                        <?php echo e(Form::text('username',old('username'),['placeholder' => __('messages.username'),'class' =>'form-control','required'])); ?>

                        <small class="help-block with-errors text-danger"></small>
                    </div>
                    <?php if(auth()->user()->hasRole('provider')): ?>
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('designation',__('messages.designation').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                        <?php echo e(Form::text('designation',old('designation'),['placeholder' => __('messages.designation'),'class' =>'form-control','required'])); ?>

                        <small class="help-block with-errors text-danger"></small>
                    </div>
                    <?php endif; ?>
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('country_id', __('messages.select_name',[ 'select' => __('messages.country') ]),['class'=>'form-control-label'],false)); ?>

                        <br />
                        <?php echo e(Form::select('country_id', [optional($user_data->country)->id => optional($user_data->country)->name], optional($user_data->country)->id, [
								'class' => 'select2js form-group country',
								'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.country') ]),
								'data-ajax--url' => route('ajax-list', ['type' => 'country']),
							])); ?>

                    </div>

                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('state_id', __('messages.select_name',[ 'select' => __('messages.state') ]),['class'=>'form-control-label'],false)); ?>

                        <br />
                        <?php echo e(Form::select('state_id', [], [
								'class' => 'select2js form-group state_id',
								'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.state') ]),
							])); ?>

                    </div>

                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('city_id', __('messages.select_name',[ 'select' => __('messages.city') ]),['class'=>'form-control-label'],false)); ?>

                        <br />
                        <?php echo e(Form::select('city_id', [], old('city_id'), [
								'class' => 'select2js form-group city_id',
								'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.city') ]),
							])); ?>

                    </div>
                    
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('religion_id', __('messages.select_name',[ 'select' => __('Religion') ]),['class'=>'form-control-label'],false)); ?>

                        <br />
                        <?php echo e(Form::select('religion_id', [], old('religion_id'), [
                                'class' => 'select2js form-group religion_id',
                                'data-placeholder' => __('messages.select_name',[ 'select' => __('Religion') ]),
                        ])); ?>

                    </div>
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('email', __('messages.email').' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false)); ?>

                        <?php echo e(Form::email('email', old('email'), ['placeholder' => __('messages.email'), 'class' => 'form-control', 'required', 'pattern' => '[^@]+@[^@]+\.[a-zA-Z]{2,}', 'title' => 'Please enter a valid email address'])); ?>

                        <small class="help-block with-errors text-danger"></small>
                    </div>

                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('contact_number', __('messages.contact_number').' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false)); ?>

                        <?php echo e(Form::text('contact_number', old('contact_number'), ['placeholder' => __('messages.contact_number'), 'class' => 'form-control contact_number', 'required'])); ?>

                        <small class="help-block with-errors text-danger " id="contact_number_err"></small>
                    </div>

                    <?php if(auth()->user()->hasRole('handyman')): ?>

                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('handymantype_id', __('messages.select_name',[ 'select' => __('messages.handymantype') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                        <br />
                        <?php echo e(Form::select('handymantype_id', [optional($user_data->handymantype)->id => optional($user_data->handymantype)->name], optional($user_data->handymantype)->id, [
                                        'class' => 'select2js form-group handymantype',
                                        'required',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.handymantype') ]),
                                        'data-ajax--url' => route('ajax-list', ['type' => 'handymantype']),
                                    ])); ?>

                    </div>

                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('name', __('messages.select_name',[ 'select' => __('messages.provider_address') ]),['class'=>'form-control-label'],false)); ?>

                        <br />
                        <?php echo e(Form::select('service_address_id',[ optional($user_data->handymanAddressMapping)->id => optional($user_data->handymanAddressMapping)->address ],$user_data->service_address_id,[
									'class' => 'select2js form-group service_address_id',
									'id' =>'service_address_id',
									'data-ajax--url' => route('ajax-list', ['type' => 'provider_address' , 'provider_id' => $user_data->provider_id ]),
									'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.provider_address') ]),
								])); ?>

                    </div>
                    <?php endif; ?>

                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('status',__('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                        <?php echo e(Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'class' =>'form-control select2js','required'])); ?>

                    </div>

                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('profile_image',__('messages.choose_profile_image'),['class'=>'form-control-label '] )); ?>

                        <div class="custom-file">
                            <?php echo e(Form::file('profile_image', ['class'=>"custom-file-input custom-file-input-sm detail" , 'id'=>"profile_image" , 'lang'=>"en" , 'accept'=>"image/*"])); ?>

                            <label class="custom-file-label upload-label" id="imagelabel"
                                for="profile_image"><?php echo e(__('messages.profile_image')); ?></label>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <?php echo e(Form::label('address',__('messages.address'), ['class' => 'form-control-label'])); ?>

                        <?php echo e(Form::textarea('address', null, ['class'=>"form-control textarea" , 'rows'=>2  , 'placeholder'=> __('messages.address') ])); ?>

                    </div>

                  <?php if($user_data->user_type =='provider'): ?>   

                     <div class="form-group col-md-12 mt-4">
                     <h4><?php echo e(__('messages.why_choose_me')); ?></h4>
                    </div>

                    <div class="form-group col-md-12">
                        <?php echo e(Form::label('title', __('messages.title').'', ['class' => 'form-control-label'], false)); ?>

                        <?php echo e(Form::text('title', old('title'), ['placeholder' => __('messages.title'), 'class' => 'form-control' ])); ?>

                        <small class="help-block with-errors text-danger"></small>
                    </div>

                       <div class="form-group col-md-12">
                        <?php echo e(Form::label('about_description',__('messages.description'), ['class' => 'form-control-label'])); ?>

                        <?php echo e(Form::textarea('about_description', null, ['class'=>"form-control textarea" , 'rows'=>2  , 'placeholder'=> __('messages.description') ])); ?>

                    </div>

                

                  <?php if($user_data->reason != null): ?>

                      <?php $__currentLoopData = $user_data->reason; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <div class="form-section1 form-group col-md-12 ">
                          <div class="row">
                            <div class="form-group col-md-12 d-flex">
                              <?php echo e(Form::text('reason[]', $reason, ['placeholder' => __('messages.reason'), 'class' => 'form-control'])); ?>

                              <small class="help-block with-errors text-danger"></small>
                              <div class="form-group col-3 mb-0 align-self-center">
                                  <button class="remove-section1 button-custom button-remove" data-title="remove" title="Remove">
                                    <i class="far fa-trash-alt"></i>
                                  </button>
                              </div>
                            </div>
                          </div>
                      </div>
    
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?> 

                   <div class="form-section form-group col-md-12 ">
                      <?php echo e(Form::label('reason', __('messages.reason').'', ['class' => 'form-control-label'], false)); ?>

                      <div class="row">
                        <div class="form-group col-md-12 d-flex">
                            <?php echo e(Form::text('reason[]', '', ['placeholder' => __('messages.reason'), 'class' => 'form-control' ])); ?>

                            <small class="help-block with-errors text-danger"></small>

                            <div class="form-group mb-0 col-3 align-self-center">
                               
                                <button class="remove-section  button-custom button-remove"> <i class="far fa-trash-alt"></i></button>
                            </div>
                        </div>
                      </div>
                  </div>

                   <div class="form-group col-md-12">
                    <div class="form-group row">
                        <div class="col-md-9 text-md-right pr-1">
                            <button type="button" id="add-section" class="button-custom button-added">
                                <i class="fas fa-plus mr-2"></i>Add More Reason
                            </button>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                   </div>
                  <?php endif; ?>

                    <div class="col-md-12">
                        <?php echo e(Form::submit(__('messages.update'), ['class'=>"btn btn-md btn-primary float-md-right"])); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// (function($) {
// 	"use strict";
$(document).ready(function() {
    $('.select2js').select2({
        width: '100%',
        // dropdownParent: $(this).parent()
    });
    var country_id = "<?php echo e(isset($user_data->country_id) ? $user_data->country_id : 0); ?>";
    var state_id = "<?php echo e(isset($user_data->state_id) ? $user_data->state_id : 0); ?>";
    var city_id = "<?php echo e(isset($user_data->city_id) ? $user_data->city_id : 0); ?>";

    stateName(country_id, state_id);
    $(document).on('change', '#country_id', function() {
        var country = $(this).val();
        $('#state_id').empty();
        $('#city_id').empty();
        stateName(country);
    })
    $(document).on('change', '#state_id', function() {
        var state = $(this).val();
        $('#city_id').empty();
        cityName(state, city_id);
    })

     $(document).ready(function () {
        // Add Section
        $("#add-section").click(function () {
            var newSection = $(".form-section:first").clone();
            newSection.find('input').val(''); // Clear input values
            $(".form-section:last").after(newSection);
            updateRemoveButtonVisibility();
        });

        // Remove Section
        $(document).on('click', '.remove-section', function () {
            if ($(".form-section").length > 1) {
                $(this).closest('.form-section').remove();
                updateRemoveButtonVisibility();
            }
        });

          // Remove Section
        $(document).on('click', '.remove-section1', function () {
            
         $(this).closest('.form-section1').remove();
            
        });

        // Function to update Remove button visibility
        function updateRemoveButtonVisibility() {
            if ($(".form-section").length > 1) {
                $('.remove-section').show();
            } else {
                $('.remove-section').hide();
            }
        }

        // Initially hide Remove button if there's only one section
        updateRemoveButtonVisibility();
    });

    $(document).on('keyup', '.contact_number', function() {
        var contactNumberInput = document.getElementById('contact_number');
        var inputValue = contactNumberInput.value;
        inputValue = inputValue.replace(/[^0-9+\- ]/g, '');
        if (inputValue.length > 15) {
            inputValue = inputValue.substring(0, 15);
            $('#contact_number_err').text('Contact number should not exceed 15 characters');
        } else {
                $('#contact_number_err').text('');
        }
        contactNumberInput.value = inputValue;
        if (inputValue.match(/^[0-9+\- ]+$/)) {
            $('#contact_number_err').text('');
        } else {
            $('#contact_number_err').text('Please enter a valid mobile number');
        }
    });



    function stateName(country, state = "") {
        var state_route = "<?php echo e(route('ajax-list', [ 'type' => 'state','country_id' =>''])); ?>" + country;
        state_route = state_route.replace('amp;', '');

        $.ajax({
            url: state_route,
            success: function(result) {
                $('#state_id').select2({
                    width: '100%',
                    placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.state')])); ?>",
                    data: result.results
                });
                if (state != null) {
                    $("#state_id").val(state).trigger('change');
                }
            }
        });
    }

    function cityName(state, city = "") {
        var city_route = "<?php echo e(route('ajax-list', [ 'type' => 'city' ,'state_id' =>''])); ?>" + state;
        city_route = city_route.replace('amp;', '');

        $.ajax({
            url: city_route,
            success: function(result) {
                $('#city_id').select2({
                    width: '100%',
                    placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.city')])); ?>",
                    data: result.results
                });
                if (city != null || city != 0) {
                    $("#city_id").val(city).trigger('change');
                }
            }
        });
    }
    $(document).on('change', '#profile_image', function() {
        readURL(this);
    })

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            var res = isImage(input.files[0].name);

            if (res == false) {
                var msg = "<?php echo e(__('messages.image_png_gif')); ?>";
                Snackbar.show({
                    text: msg,
                    pos: 'bottom-center',
                    backgroundColor: '#d32f2f',
                    actionTextColor: '#fff'
                });
                return false;
            }

            reader.onload = function(e) {
                $('.profile_image_preview').attr('src', e.target.result);
                $("#imagelabel").text((input.files[0].name));
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(document).ready(function() {

        var currentImage = "<?php echo e(getSingleMedia($user_data,'profile_image', null)); ?>";


        if (currentImage !== "") {

            var fileName = currentImage.split('/').pop();

            $('#imagelabel').text(fileName);
        }
    });


    function getExtension(filename) {
        var parts = filename.split('.');
        return parts[parts.length - 1];
    }

    function isImage(filename) {
        var ext = getExtension(filename);
        switch (ext.toLowerCase()) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
                return true;
        }
        return false;
    }
})
// })(jQuery);
</script>
<script>
    $(document).ready(function() {
    $('.select2js').select2({
        width: '100%',
    });
    

    var religion_id = "<?php echo e(isset($user_data->religion_id) ? $user_data->religion_id : 0); ?>";
    loadReligions(religion_id);

    // Function to load religions
  function loadReligions(selectedReligion = "") {
    var religion_route = "<?php echo e(route('ajax-list', ['type' => 'religion-list'])); ?>";
    console.log(religion_route);
    $.ajax({
        url: religion_route,
        success: function(result) {
            console.log(result);
            if (result && result.results) {
                $('#religion_id').select2({
                    width: '100%',
                    placeholder: "<?php echo e(trans('messages.select_name', ['select' => trans('messages.religion')])); ?>",
                    data: result.results
                });

                if (selectedReligion) {
                    $("#religion_id").val(selectedReligion).trigger('change');
                }
            } else {
                console.error('No data received for religions.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Failed to load religions:', error);
        }
    });
}
})
</script>
<?php /**PATH C:\Users\USER\Desktop\km\resources\views/setting/profile_form.blade.php ENDPATH**/ ?>