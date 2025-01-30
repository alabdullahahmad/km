<x-master-layout>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-block card-stretch">
                <div class="card-body p-0">
                    <div class="d-flex justify-content-between align-items-center p-3">
                    <h5 class="font-weight-bold">{{ __('messages.Add_New_Bill') }}</h5>
                                <a href="{{ route('wallet.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @if($auth_user->can('providertype list'))
                            @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                {{ Form::model($wallet,['method' => 'POST','route'=>(isset($wallet->id))?'editBill':'addBill', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'wallet'] ) }}
                    {{ Form::hidden('id') }}
                         {!!  isset($wallet->id) ? "<input type=hidden name=billId value=$wallet->id>":"" !!}
                        <div class="row">

                            <div class="form-group col-md-4">
                                {{ Form::label('payType',__('messages.type').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('payType',['in' => __('messages.in') , 'out' => __('messages.out') ],old('payType'),[ 'class' =>'form-control select2js','required']) }}
                            </div>
                            <!--<div class="form-group col-md-4">-->
                            <!--    {{ Form::label('date',__('messages.Date').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}-->
                            <!--    {{ Form::text('date',old('date') ?? now(),['placeholder' => __('messages.Date'),'class' =>'form-control datepicker','required']) }}-->
                            <!--    <small class="help-block with-errors text-danger"></small>-->
                            <!--</div>-->
                            <div class="form-group col-md-4">
                                {{ Form::label('amount',__('messages.amount').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::number('amount',null, [ 'min' => 0, 'step' => 'any' , 'placeholder' => __('messages.amount'),'class' =>'form-control', 'required' ]) }}
                            </div>


                            <div class="form-group col-md-12">
                                {{ Form::label('description',__('messages.description').' <span class="text-danger">*</span>',['class' => 'form-control-label'],false) }}
                                {{ Form::textarea('description', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.description') ]) }}
                            </div>

                        </div>
                    {{ Form::submit( trans('messages.save'), ['class'=>'btn btn-md btn-primary float-right']) }}
                {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
</x-master-layout>
