<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ __('messages.Add_New_Discounts') }}</h5>
                            @if($auth_user->can('blog list'))
                            <a href="{{ route('blog.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($blogdata,['method' => 'POST','route'=>'blog.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'blog'] ) }}
                        {{ Form::hidden('id') }}
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('title',trans('messages.name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('title',old('title'),['placeholder' => trans('messages.name'),'class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('discount_percentage',__('messages.Discount_Percentage').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('discount_percentage',old('discount_percentage'),['placeholder' => __('messages.Discount_Percentage'),'class' =>'form-control discount_percentage','required']) }}
                                <small class="help-block with-errors text-danger" id="discount_percentage_err"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('status',trans('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'id' => 'role' ,'class' =>'form-control select2js','required']) }}
                            </div>


                           

                           
                        </div>
                      
                        {{ Form::submit( trans('messages.save'), ['class'=>'btn btn-md btn-primary float-right']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('bottom_script')
        <script>
            function preview() {
                blog_image_preview.src = URL.createObjectURL(event.target.files[0]);
            }

            $(document).ready(function() {
                $('.select2-tag').select2({
                tags: true,
                createTag: function (params) {
                    if (params.term.length > 2) {
                    return {
                        id: params.term,
                        text: params.term,
                        newTag: true
                    }
                    }
                    return null;
                }
                });
            });
            $(document).on('keyup', '.discount_percentage', function() {
    var discountPercentageInput = document.getElementById('discount_percentage');
    var inputValue = discountPercentageInput.value;

    // السماح بالأرقام فقط
    inputValue = inputValue.replace(/[^0-9]/g, '');
    discountPercentageInput.value = inputValue;

    // التحقق من صحة المدخلات
    if (/^\d+$/.test(inputValue)) {
        $('#discount_percentage_err').text('');
    } else {
        $('#discount_percentage_err').text('الرجاء إدخال أرقام فقط لقيمة الحسم');
    }
});
            (function($) {
                $(document).ready(function(){
                    tinymceEditor('.tinymce-description',' ',function (ed) {

                    }, 450)
                
                });

            })(jQuery);
        </script>
    @endsection
</x-master-layout>