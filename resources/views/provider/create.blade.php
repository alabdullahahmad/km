<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{  __('messages.Add_New_Receptions') }}</h5>
                            <a href="{{ route('provider.index') }}" class="float-right btn btn-sm btn-primary"><i
                                    class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @if($auth_user->can('provider list'))
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($providerdata,['method' => 'POST','route'=>(isset($providerdata->id))?'editStaf':'addStaf', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'provider'] ) }}
                        {{ Form::hidden('id') }}
                        {{ Form::hidden('user_type','provider') }}
                        {!!  ($providerdata->id) ? "<input type=hidden name=stafId value=$providerdata->id>":""!!}

                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('name',__('messages.name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('name',old('name'),['placeholder' => __('messages.name'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            @if (!isset($providerdata->id) || $providerdata->id == null)
                            <div class="form-group col-md-4">
                                {{ Form::label('password', __('messages.password').' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('messages.password'), 'required', 'autocomplete' => 'new-password']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            @endif

                           
                            <div class="form-group col-md-4">
                                {{ Form::label('gender', __('messages.select_gender',[ 'select' => __('messages.gender') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                <br />
                                {{ 
                                    Form::select('gender', [optional($providerdata->providertype)->id => optional($providerdata->providertype)->name], optional($providerdata->providertype)->name, [
                                        'class' => 'select2js form-group providertype',
                                        'required',
                                        'data-placeholder' => __('messages.select_gender',[ 'select' => __('messages.gender') ]),
                                        'data-ajax--url' => route('ajax-list', ['type' => 'providertype']),
                                    ]) 
                                }}
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('birthDay',__('messages.birthday').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('birthDay',old('birthDay'),['placeholder' => __('messages.birthday'),'class' =>'form-control datepicker','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            
                            <div class="form-group col-md-4">
                                {{ Form::label('phoneNumber',__('messages.phone').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('phoneNumber',old('phoneNumber'),['placeholder' => __('messages.phone'),'class' =>'form-control contact_number','required']) }}
                                <small class="help-block with-errors text-danger" id="contact_number_err"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('personalid',__('messages.personalid').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('personalid',old('personalid'),['placeholder' => __('messages.National_Id'),'class' =>'form-control National_Id','required']) }}
                                <small class="help-block with-errors text-danger" id="National_Id_err"></small>
                            </div>

                            {{-- <div class="form-group col-md-4">
                                {{ Form::label('status',__('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'class' =>'form-control select2js','required']) }}
                            </div> --}}

                            {{-- <div class="form-group col-md-4">
                                <label class="form-control-label" for="profile_image">{{ __('messages.profile_image') }}
                                </label>
                                <div class="custom-file">
                                    <input type="file" name="profile_image" class="custom-file-input" accept="image/*">
                                    <label
                                        class="custom-file-label upload-label">{{  __('messages.choose_file',['file' =>  __('messages.profile_image') ]) }}</label>
                                </div>
                                <!-- <span class="selected_file"></span> -->
                            </div> --}}

                            {{-- @if(getMediaFileExit($providerdata, 'profile_image'))
                            <div class="col-md-2 mb-2">
                                <img id="profile_image_preview" src="{{getSingleMedia($providerdata,'profile_image')}}"
                                    alt="#" class="attachment-image mt-1">
                                <a class="text-danger remove-file"
                                    href="{{ route('remove.file', ['id' => $providerdata->id, 'type' => 'profile_image']) }}"
                                    data--submit="confirm_form" data--confirmation='true' data--ajax="true"
                                    data-toggle="tooltip"
                                    title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}'
                                    data-title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}'
                                    data-message='{{ __("messages.remove_file_msg") }}'>
                                    <i class="ri-close-circle-line"></i>
                                </a>
                            </div>
                            @endif --}}

                            <div class="form-group col-md-12">
                                {{ Form::label('address',__('messages.Address'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('address', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.Address') ]) }}
                            </div>
                        </div>
                        
                        {{ Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary float-right']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @php
    $data = $providerdata->providerTaxMapping->pluck('tax_id')->implode(',');
    @endphp --}}
    @section('bottom_script')
    <script type="text/javascript">
    (function($) {
        "use strict";

        $(document).on('keyup', '.contact_number', function() {
    var contactNumberInput = document.getElementById('contact_number');
    var inputValue = contactNumberInput.value;
    
    // يسمح فقط بالأرقام
    inputValue = inputValue.replace(/[^0-9]/g, '');

    // تحديد عدد الخانات إلى 10
    if (inputValue.length > 10) {
        inputValue = inputValue.substring(0, 10);
        $('#contact_number_err').text('رقم الهاتف يجب أن يتكون من 10 أرقام فقط');
    } else {
        $('#contact_number_err').text('');
    }
    
    contactNumberInput.value = inputValue;

    // التحقق من صحة المدخلات
    if (/^\d{10}$/.test(inputValue)) {
        $('#contact_number_err').text('');
    } else {
        $('#contact_number_err').text('الرجاء إدخال رقم هاتف صحيح مكون من 10 أرقام');
    }
});

$(document).on('keyup', '.National_Id', function() {
    var nationalIdInput = document.getElementById('National_Id');
    var inputValue = nationalIdInput.value;
    
    // يسمح فقط بالأرقام
    inputValue = inputValue.replace(/[^0-9]/g, '');

    // تحديد عدد الخانات إلى 11
    if (inputValue.length > 11) {
        inputValue = inputValue.substring(0, 11);
        $('#National_Id_err').text('الرقم الوطني يجب أن يتكون من 11 رقمًا فقط');
    } else {
        $('#National_Id_err').text('');
    }
    
    nationalIdInput.value = inputValue;

    // التحقق من صحة المدخلات
    if (/^\d{11}$/.test(inputValue)) {
        $('#National_Id_err').text('');
    } else {
        $('#National_Id_err').text('الرجاء إدخال رقم وطني صحيح مكون من 11 رقمًا');
    }
});


        function stateName(country, state = "") {
            var state_route = "{{ route('ajax-list', [ 'type' => 'state','country_id' =>'']) }}" + country;
            state_route = state_route.replace('amp;', '');

            $.ajax({
                url: state_route,
                success: function(result) {
                    $('#state_id').select2({
                        width: '100%',
                        placeholder: "{{ trans('messages.select_name',['select' => trans('messages.state')]) }}",
                        data: result.results
                    });
                    if (state != null) {
                        $("#state_id").val(state).trigger('change');
                    }
                }
            });
        }

        function cityName(state, city = "") {
            var city_route = "{{ route('ajax-list', [ 'type' => 'city' ,'state_id' =>'']) }}" + state;
            city_route = city_route.replace('amp;', '');

            $.ajax({
                url: city_route,
                success: function(result) {
                    $('#city_id').select2({
                        width: '100%',
                        placeholder: "{{ trans('messages.select_name',['select' => trans('messages.city')]) }}",
                        data: result.results
                    });
                    if (city != null || city != 0) {
                        $("#city_id").val(city).trigger('change');
                    }
                }
            });
        }

        function getTax(provider_id, provider_tax_id = "") {
            var provider_tax_route = "{{ route('ajax-list', [ 'type' => 'provider_tax','provider_id' =>'']) }}" +
                provider_id;
            provider_tax_route = provider_tax_route.replace('amp;', '');

            $.ajax({
                url: provider_tax_route,
                success: function(result) {
                    $('#tax_id').select2({
                        width: '100%',
                        placeholder: "{{ trans('messages.select_name',['select' => trans('messages.tax')]) }}",
                        data: result.results
                    });
                    if (provider_tax_id != "") {
                        $('#tax_id').val(provider_tax_id.split(',')).trigger('change');
                    }
                }
            });
        }
    })(jQuery);
    </script>
    <script>
    $(document).ready(function() {
    $('.select2js').select2({
        width: '100%',
    });
    

    var religion_id = "{{ isset($provider_data->religion_id) ? $provider_data->religion_id : 0 }}";
    loadReligions(religion_id);

    // Function to load religions
      function loadReligions(selectedReligion = "") {
        var religion_route = "{{ route('ajax-list', ['type' => 'religion-list']) }}";
    
        $.ajax({
            url: religion_route,
            success: function(result) {
                console.log(result);
                if (result && result.results) {
                    $('#religion_id').select2({
                        width: '100%',
                        placeholder: "{{ trans('messages.select_name', ['select' => trans('messages.religion')]) }}",
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
    @endsection
</x-master-layout>