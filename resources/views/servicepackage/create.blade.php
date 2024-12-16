<x-master-layout>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-block card-stretch">
                <div class="card-body p-0">
                    <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                        <h5 class="font-weight-bold">{{ __('messages.New_Tools_subscription') }}</h5>
                        @if($auth_user->can('servicepackage list'))
                        <a href="{{ route('servicepackage.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
      
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::model($servicepackage,['method' => 'POST','route'=>'service.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'service'] ) }}
                    {{ Form::hidden('id') }}
                    <div class="row">
                        <div class="form-group col-md-4">
                            {{ Form::label('name', __('messages.name').' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                            {{ Form::text('name', old('name'), ['placeholder' => __('messages.name'), 'class' => 'form-control', 'title' => 'Please enter alphabetic characters and spaces only']) }}
                            <small class="help-block with-errors text-danger"></small>
                        </div>
                        <div class="form-group col-md-4" id="price_div">
                            {{ Form::label('price',__('messages.number_day').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                            {{ Form::text('price',null, [ 'min' => 1, 'step' => 'any' , 'placeholder' => __('messages.number_day'),'class' =>'form-control', 'required','id' => 'price',  'pattern' => '^\\d+(\\.\\d{1,2})?$' ]) }}
                            <small class="help-block with-errors text-danger"></small>
                        </div>
                        <div class="form-group col-md-4" id="price_div">
                            {{ Form::label('price',__('messages.Number_sessions').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                            {{ Form::text('price',null, [ 'min' => 1, 'step' => 'any' , 'placeholder' => __('messages.Number_sessions'),'class' =>'form-control', 'required','id' => 'price',  'pattern' => '^\\d+(\\.\\d{1,2})?$' ]) }}
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
                            {{ Form::select('category_id', [optional($servicepackage->category)->id => optional($servicepackage->category)->name], optional($servicepackage->category)->id, [
                                        'class' => 'select2js form-group category',
                                        'required',
                                        'id' => 'category_id',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.Subscription type') ]),
                                        'data-ajax--url' => route('ajax-list', ['type' => 'category']),
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
        (function($) {
            "use strict";
            $(document).ready(function(){
                var package_type = $("#package_type").val();
                hideShow(package_type);

                $(document).on('change', '#package_type', function() {
                    var package_type = $(this).val();
                    hideShow(package_type);
                })

                var category_id = "{{ isset($servicepackage->category_id) ? $servicepackage->category_id : '' }}";
                var subcategory_id = "{{ isset($servicepackage->subcategory_id) ? $servicepackage->subcategory_id : '' }}";
                var provider_id = "{{ isset($servicepackage->provider_id) ? $servicepackage->provider_id : '' }}";
                var service_id = "{{$servicepackage->packageServices->pluck('service_id')->implode(',')}}"
                if(service_id !== ''){
                    getService(service_id)
                }
                getSubCategory(category_id, subcategory_id)
                getService(provider_id)
                $(document).on('change', '#provider_id', function() {
                    var provider_id = $(this).val();
                    $('#custom_service_id').empty();
                    getService(provider_id,category_id)
                })

                   $(document).on('change', '#package_type', function() {

                    var provider_id=$('#provider_id').val();

                    $('#custom_service_id').empty();
                    getService(provider_id)
                })



                $(document).on('change', '#category_id', function() {
                    var category_id = $(this).val();
                    var provider_id = $('#provider_id').val();
                    var subcategory_id = $('#subcategory_id').val();


                    $('#subcategory_id').empty();
                    getSubCategory(category_id, subcategory_id);

                    $('#custom_service_id').empty();
                    getService(provider_id,category_id,subcategory_id)
                })

                $(document).on('change', '#subcategory_id', function() {
                    var subcategory_id = $(this).val();
                    var category_id = $('#category_id').val();
                    var provider_id = $('#provider_id').val();
                    var selectedServiceIds = $('#custom_service_id').val();

                    $('#custom_service_id').empty();
                    getService(provider_id,category_id,subcategory_id,selectedServiceIds)
                })
            })
            
            function hideShow(package_type){
                if(package_type == 'single'){
                    $('#select_category').removeClass('d-none');
                    $('#select_subcategory').removeClass('d-none');
                    $('#category_id').prop('required', true);
                    $('#subcategory_id').prop('required', true);
                } 
                else{
                    $('#select_category').addClass('d-none');
                    $('#select_subcategory').addClass('d-none');
                    $('#category_id').prop('required', false);
                    $('#subcategory_id').prop('required', false);
                }
            }
            function getSubCategory(category_id, subcategory_id = "") {
                var get_subcategory_list = "{{ route('ajax-list', [ 'type' => 'subcategory_list','category_id' =>'']) }}" + category_id;
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
            function getService(provider_id,category_id,subcategory_id,service_id=''){
                var selectedServiceId = {!! json_encode($selectedServiceId) !!};
                $.ajax({
                    url: "{{ route('service-list') }}",
                    method:"POST",
                    data : { '_token': $('meta[name=csrf-token]').attr('content'),provider_id : provider_id,category_id:category_id,subcategory_id:subcategory_id },
                   
                    success: function(result) {
                        console.log(result)
                        $('#custom_service_id').select2({
                            width: '100%',
                            placeholder: "{{ trans('messages.select_name',['select' => trans('messages.subcategory')]) }}",
                            data: result.results
                        });
                        selectedServiceId.forEach(function(id) {
                        // Find the option element with the corresponding ID and mark it as selected
                        $('#custom_service_id option[value="' + id + '"]').prop('selected', true);
                    });
                    }
                });
            }
        })(jQuery);
    </script>
@endsection
</x-master-layout>