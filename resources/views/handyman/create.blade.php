<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{  __('messages.Add_New_Coaches') }}</h5>
                            <a href="{{ route('handyman.index') }}" class="float-right btn btn-sm btn-primary"><i
                                    class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @if($auth_user->can('coaches list'))
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        {{ Form::model($handymandata,['method' => 'POST','route'=>(isset($handymandata->id))?'editCoach':'addCoach', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'handyman'] ) }}
                        {{ Form::hidden('id') }}
                        {{ Form::hidden('user_type','handyman') }}
                        {!!  isset($handymandata->id) ? "<input type=hidden name=coacheId value=$handymandata->id>":""!!}

                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('name',__('messages.name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('name',old('name'),['placeholder' => __('messages.name'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>


{{--
                            @if (!isset($handymandata->id) || $handymandata->id == null)
                            <div class="form-group col-md-4">
                                {{ Form::label('password', __('messages.password').' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('messages.password'), 'required', 'autocomplete' => 'new-password']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            @endif --}}
                            <div class="form-group col-md-4">
                                {{ Form::label('gender', __('messages.select_gender',[ 'select' => __('messages.gender') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                <br />
                                {{
                                    Form::select('gender', [optional($handymandata->handymantype)->id => optional($handymandata->handymantype)->name], optional($handymandata->handymantype)->name, [
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
                                {{ Form::label('name', __('messages.select_name',[ 'select' => __('messages.branchName') ]).' <span class="text-danger">*</span>', ['class'=>'form-control-label'], false) }}
                                <br />
                                {{ Form::select('branchId', [optional($handymandata->branch)->id => optional($handymandata->branch)->name], optional($handymandata->branch)->id, [
                                    'class' => 'select2js form-group category',
                                    'required',
                                    'data-placeholder' => __('messages.select_name', ['select' => __('messages.branchName')]),
                                    'data-ajax--url' => route('ajax-list', ['type' => 'branch']),
                                ]) }}
                            </div>
                            
                            @if(auth()->user()->hasAnyRole(['admin','demo_admin']))
                            <div class="form-group col-md-4">
                                {{ Form::label('class', __('messages.Classes',[ 'select' => __('messages.Classes') ]).' <span class="text-danger">*</span>', ['class'=>'form-control-label'], false) }}
                                <br />
                                {{ Form::select('class[]', [optional($handymandata->providers)->id => optional($handymandata->providers)->display_name], (int)optional($handymandata->providers)->id, [
                                    'class' => 'select2js form-group providers',
                                    'required',
                                    'multiple' => 'multiple',
                                    'data-placeholder' => __('messages.select_Coaches', ['select' => __('messages.Classes')]),
                                    'data-ajax--url' => route('ajax-list', ['type' => 'subscription', 'branchId' => '__branchId__']),
                                ]) }}
                            </div>
                            @endif
                            

                            <div class="form-group col-md-4">
                                {{ Form::label('percentage', __('messages.percentage').' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::text('percentage', old('percentage'), ['placeholder' => __('messages.percentage'), 'class' => 'form-control percentage', 'required']) }}
                                <small class="help-block with-errors text-danger" id="percentage_err"></small>
                            </div>


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
    @section('bottom_script')
    <script type="text/javascript">
$(document).ready(function () {
    let branchId = $('select[name="branchId"]').val();
    if (branchId) {
        loadClasses(branchId);
    }
});

// عند تغيير الفرع
$('select[name="branchId"]').on('change', function () {
    let branchId = $(this).val();
    loadClasses(branchId);
});

// دالة تحميل الكلاسات بناءً على الفرع
function loadClasses(branchId) {
    let classSelect = $('select[name="class[]"]');

    // تحديث رابط data-ajax--url
    classSelect.data('ajax--url', `/ajax-list?type=subscription&branchId=${branchId}`);

    // إعادة تحميل البيانات
    classSelect.select2({
        ajax: {
            url: classSelect.data('ajax--url'),
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data.results.map(item => ({
                        id: item.id,
                        text: item.text
                    }))
                };
            }
        },
        minimumInputLength: 0,
        placeholder: "اختر الكلاس",
        allowClear: false
    });

    // إعادة ضبط القيم المختارة بناءً على البيانات المحفوظة
    let selectedClasses = {!! json_encode($handymandata->providers ? $handymandata->providers->pluck('id')->toArray() : []) !!};

    classSelect.val(selectedClasses).trigger('change');
}





    (function($) {
        "use strict";
        $(document).ready(function() {
            var country_id = "{{ isset($handymandata->country_id) ? $handymandata->country_id : 0 }}";
            var state_id = "{{ isset($handymandata->state_id) ? $handymandata->state_id : 0 }}";
            var city_id = "{{ isset($handymandata->city_id) ? $handymandata->city_id : 0 }}";

            var provider_id = "{{ isset($handymandata->provider_id) ? $handymandata->provider_id : '' }}";
            var service_address_id =
                "{{ isset($handymandata->service_address_id) ? $handymandata->service_address_id : 0 }}";

            stateName(country_id, state_id);
            providerAddress(provider_id, service_address_id)
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
            $(document).on('change', '#provider_id', function() {
                var provider_id = $(this).val();
                $('#service_address_id').empty();
                providerAddress(provider_id, service_address_id);
            })

        })
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
$(document).on('keyup', '.percentage', function() {
    var percentageInput = document.getElementById('percentage');
    var inputValue = percentageInput.value;

    // يسمح فقط بالأرقام
    inputValue = inputValue.replace(/[^0-9]/g, '');

    // التحقق من القيمة بحيث تكون بين 0 و100
    if (inputValue > 100) {
        inputValue = '100';
        $('#percentage_err').text('النسبة يجب أن تكون بين 0 و 100');
    } else {
        $('#percentage_err').text('');
    }

    percentageInput.value = inputValue;

    // التحقق من صحة المدخلات
    if (/^\d+$/.test(inputValue) && inputValue <= 100) {
        $('#percentage_err').text('');
    } else if (inputValue === '') {
        $('#percentage_err').text('الرجاء إدخال نسبة مئوية بين 0 و 100');
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

        function providerAddress(provider_id, service_address_id = "") {
            var provider_address_route =
                "{{ route('ajax-list', [ 'type' => 'provider_address','provider_id' =>'']) }}" + provider_id;
            provider_address_route = provider_address_route.replace('amp;', '');

            $.ajax({
                url: provider_address_route,
                success: function(result) {
                    $('#service_address_id').select2({
                        width: '100%',
                        placeholder: "{{ trans('messages.select_name',['select' => trans('messages.provider_address')]) }}",
                        data: result.results
                    });
                    if (service_address_id != "") {
                        $('#service_address_id').val(service_address_id).trigger('change');
                    }
                }
            });
        }
    })(jQuery);
    </script>
    @endsection
</x-master-layout>
