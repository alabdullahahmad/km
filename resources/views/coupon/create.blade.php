<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{  __('messages.add branchName') }}</h5>
                            @if($auth_user->can('branch list'))
                            <a href="{{ route('coupon.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
            
                        {{ Form::model($coupondata,['method' => 'POST','route'=>(isset($coupondata->id))?'editBranch':'addBranch', 'data-toggle'=>"validator" ,'id'=>'coupon'] ) }}
                        {{ Form::hidden('id') }}
                        {{ Form::hidden('','coupon') }}
                        {!!  isset($coupondata->id) ? "<input type=hidden name=branchId value=$coupondata->id>":""!!}
                        <div class="row">
                           

                            <div class="form-group col-md-4">
                                {{ Form::label('name',__('messages.branchName').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('name',old('name'),['placeholder' => __('messages.name'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('city',__('messages.city').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('city',old('city'),['placeholder' => __('messages.city'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('address',__('messages.address').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('address',old('address'),['placeholder' => __('messages.address'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>


                        </div>

                        {{ Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary float-right']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>