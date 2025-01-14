<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ $pageTitle ?? trans('messages.list') }}</h5>
                            {{-- @if($auth_user->can('category list'))
                            @endif --}}
                            <a href="{{ route('category.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($categorydata,['method' => 'POST','route'=>(!isset($categorydata->id))?'addCategory':'editCategory', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'category'] ) }}
                        {{ Form::hidden('id') }}
                        {!!  ($categorydata->id) ? "<input type=hidden name=categoryId value=$categorydata->id>":""!!}
                        <div class="row">
                            <div class="form-group col-md-4">
                                    {{ Form::label('name', __('messages.name').' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                    {{ Form::text('name', old('name'), ['placeholder' => __('messages.name'), 'class' => 'form-control', 'required', 'title' => 'Please enter alphabetic characters and spaces only']) }}
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    {{ Form::label('discount_type',__('messages.branchName').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                    {{ Form::select('discount_type',['fixed' => __('messages.name') , 'percentage' => __('messages.percentage') ],old('status'),[ 'class' =>'form-control select2js','required']) }}
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
