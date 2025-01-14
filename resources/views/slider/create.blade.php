<x-master-layout>
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ __('messages.Add_New_Rooms') }}</h5>
                            @if($auth_user->can('room list'))
                            @endif
                                <a href="{{ route('slider.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($sliderdata,['method' => 'POST','route'=>($sliderdata->id)?'editRoom':'addRoom', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'slider'] ) }}
                            {{ Form::hidden('id') }}
                            {{ Form::hidden('type','service') }}
                            {!!  ($sliderdata->id) ? "<input type=hidden name=roomId value=$sliderdata->id>":""!!}
                            <div class="row">
                                <div class="form-group col-md-4">
                                    {{ Form::label('name',__('messages.name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                    {{ Form::text('name',old('name'),['placeholder' => __('messages.name'),'class' =>'form-control','required']) }}
                                    <small class="help-block with-errors text-danger"></small>
                                </div>

                                <div class="form-group col-md-4">
                                    {{ Form::label('capacity',__('messages.Capacity').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                    {{ Form::text('capacity',old('capacity'),['placeholder' => __('messages.Capacity'),'class' =>'form-control Capacity','required']) }}
                                    <small class="help-block with-errors text-danger" id="Capacity_err"></small>
                                </div>
                                {{-- <div class="form-group col-md-4">
                                    {{ Form::label('status',__('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                    {{ Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'id' => 'status' ,'class' =>'form-control select2js','required']) }}
                                </div> --}}

                              
                            </div>
                            
                            {{ Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary float-right']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('bottom_script')
    <script>
    $(document).on('keyup', '.Capacity', function() {
        var discountPercentageInput = document.getElementById('Capacity');
        var inputValue = discountPercentageInput.value;
    
        // السماح بالأرقام فقط
        inputValue = inputValue.replace(/[^0-9]/g, '');
        discountPercentageInput.value = inputValue;
    
        // التحقق من صحة المدخلات
        if (/^\d+$/.test(inputValue)) {
            $('#Capacity_err').text('');
        } else {
            $('#Capacity_err').text('الرجاء إدخال أرقام فقط لسعة الغرفة');
        }
    });
</script>
    @endsection
</x-master-layout>