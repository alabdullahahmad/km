<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{__('messages.Subscription') }}</h5>
                            <a href="{{ route('service.index.id',$categoryId) }}" class="float-right btn btn-sm btn-primary"><i
                                    class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @if($auth_user->can('subscription list'))
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($servicedata,['method' => 'POST','route'=>($servicedata->id)?'editSubscription':'addSubscription', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'service'] ) }}
                        {{ Form::hidden('id') }}
                        {!!  isset($servicedata->id) ? "<input type=hidden name=subscriptionId value=$servicedata->id>":""!!}

                        <input type=hidden name=categoryId value={{ $categoryId }}>
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('name', __('messages.name').' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::text('name', old('name'), ['placeholder' => __('messages.name'), 'class' => 'form-control', 'title' => 'Please enter alphabetic characters and spaces only']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('name', __('messages.select_name',[ 'select' => __('messages.branchName') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                <br />
                                {{ Form::select('branchId', [optional($servicedata->branch)->id => optional($servicedata->branch)->name], optional($servicedata->branch)->id, [
                                        'class' => 'select2js form-group category',
                                        'required',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.branchName') ]),
                                        'data-ajax--url' => route('ajax-list', ['type' => 'branch']),
                                    ]) }}

                            </div>
                            <div class="form-group col-md-4" id="numOfDays_div">
                                {{ Form::label('numOfDays',__('messages.number_day').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::text('numOfDays',null, [ 'min' => 1, 'step' => 'any' , 'placeholder' => __('messages.number_day'),'class' =>'form-control', 'required','id' => 'numOfDays',  'pattern' => '^\\d+(\\.\\d{1,2})?$' ]) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4" id="numOfSessions_div">
                                {{ Form::label('numOfSessions',__('messages.Number_sessions').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::text('numOfSessions',null, [ 'min' => 1, 'step' => 'any' , 'placeholder' => __('messages.Number_sessions'),'class' =>'form-control', 'required','id' => 'numOfSessions',  'pattern' => '^\\d+(\\.\\d{1,2})?$' ]) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4" id="price_div">
                                {{ Form::label('price',__('messages.price').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::text('price',null, [ 'min' => 1, 'step' => 'any' , 'placeholder' => __('messages.price'),'class' =>'form-control', 'required','id' => 'price',  'pattern' => '^\\d+(\\.\\d{1,2})?$' ]) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('name', __('messages.select_name',[ 'select' => __('messages.Subscription type') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                <br />
                                {{ Form::select('tagId', [optional($servicedata->tag)->id => optional($servicedata->tag)->name], optional($servicedata->tag)->id, [
                                            'class' => 'select2js form-group category',
                                            'required',
                                            'id' => 'tagId',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.Subscription type') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'tag']),
                                ]) }}

                            </div>



                            <div class="form-group col-md-4">
                                {{ Form::label('status',__('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'class' =>'form-control select2js','required']) }}
                            </div>



                        </div>



                        <div class="row">
                            <div class="form-group col-md-12">
                                {{ Form::label('description',__('messages.description'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('description', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.description') ]) }}
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
    var discountInput = document.getElementById('discount');
    var discountError = document.getElementById('discount-error');


      document.addEventListener('DOMContentLoaded', function () {
        var initialProviderId = document.getElementById('provider_id').value;
        selectprovider({ value: initialProviderId });
        document.getElementById('add_provider_address_link').addEventListener('click', function (event) {
            event.preventDefault();
            var providerId = document.getElementById('provider_id').value;
            var providerAddressCreateUrl = "{{ route('provideraddress.create', ['provideraddress' => '']) }}";
            providerAddressCreateUrl = providerAddressCreateUrl.replace('provideraddress=', 'provideraddress=' + providerId);
            window.location.href = providerAddressCreateUrl;
        });



    });

    function selectprovider(selectElement){

        var providerId = selectElement.value;
        var addProviderAddressLink =  document.getElementById('add_provider_address_link');

        if(providerId){
            addProviderAddressLink.classList.remove('d-none');
        } else {
            addProviderAddressLink.classList.add('d-none');
        }
    }


    discountInput.addEventListener('input', function() {
        var discountValue = parseFloat(discountInput.value);
        if (isNaN(discountValue) || discountValue < 0 || discountValue > 99) {
            discountError.textContent = "{{ __('Discount value should be between 0 to 99') }}";
        } else {
            discountError.textContent = "";
        }
    });

    var isEnableAdvancePayment = $("input[name='is_enable_advance_payment']").prop('checked');

    var priceType = $("#price_type").val();

    enableAdvancePayment(priceType);
    checkEnablePayment(isEnableAdvancePayment);

    $("#is_enable_advance_payment").change(function() {
        isEnableAdvancePayment = $(this).prop('checked');
        checkEnablePayment(isEnableAdvancePayment);
        updateAmountVisibility(priceType, isEnableAdvancePayment);
    });

    $("#price_type").change(function() {
        priceType = $(this).val();
        enableAdvancePayment(priceType);
        updateAmountVisibility(priceType, isEnableAdvancePayment);
    });

    function checkEnablePayment(value) {
        $("#amount").toggleClass('d-none', !value);
        $('#advance_payment_amount').prop('required', value);
    }

    function enableAdvancePayment(type) {
        $("#is_enable_advance").toggleClass('d-none', type !== 'fixed');
    }

    function updateAmountVisibility(type, isEnableAdvancePayment) {
        if (type === 'fixed' && !$("#is_enable_advance").hasClass('d-none') && isEnableAdvancePayment) {
            $("#amount").removeClass('d-none');
        } else {
            $("#amount").addClass('d-none');
        }
    }

    (function($) {
        "use strict";

        function providerAddress(provider_id, provider_address_id = "") {
            var provider_address_route =
                "{{ route('ajax-list', [ 'type' => 'provider_address','provider_id' =>'']) }}" + provider_id;
            provider_address_route = provider_address_route.replace('amp;', '');

            $.ajax({
                url: provider_address_route,
                success: function(result) {
                    $('#provider_address_id').select2({
                        width: '100%',
                        placeholder: "{{ trans('messages.select_name',['select' => trans('messages.provider_address')]) }}",
                        data: result.results
                    });
                    if (provider_address_id != "") {
                        $('#provider_address_id').val(provider_address_id.split(',')).trigger('change');
                    }
                }
            });
        }

        function getSubCategory(category_id, subcategory_id = "") {
            var get_subcategory_list =
                "{{ route('ajax-list', [ 'type' => 'subcategory_list','category_id' =>'']) }}" + category_id;
            get_subcategory_list = get_subcategory_list.replace('amp;', '');

            $.ajax({
                url: get_subcategory_list,
                success: function(result) {
                    $('#subcategory_id').select2({
                        width: '100%',
                        placeholder: "{{ trans('messages.select_name',['select' => trans('messages.subcategory')]) }}",
                        data: result.results
                    });
                    if (subcategory_id != "") {
                        $('#subcategory_id').val(subcategory_id).trigger('change');
                    }
                }
            });
        }
        var price = "{{ isset($servicedata->price) ? $servicedata->price : '' }}";
        var discount = "{{ isset($servicedata->discount) ? $servicedata->discount : '' }}";
        function priceformat(value) {
            if (value == 'free') {
                $('#price').val(0);
                $('#price').attr("readonly", true)

                $('#discount').val(0);
                $('#discount').attr("readonly", true)

            }
            else{
                $('#price').val(price);
                $('#price').attr("readonly", false)
                $('#discount').val(discount);
                $('#discount').attr("readonly", false)
            }
        }
    })(jQuery);
    </script>
    @endsection
</x-master-layout>
