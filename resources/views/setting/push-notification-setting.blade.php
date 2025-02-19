<x-master-layout>
<div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ __('messages.Push_Notification') }}</h5>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    {{ Form::model($settings,['method' => 'POST','route'=>'sendPushNotification', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'push_notification'] ) }}
    {{ Form::hidden('id') }}
    <div class="row">
       
        <div class="form-group col-md-12">
            {{ Form::label('title',trans('messages.title').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
            {{ Form::text('title',old('title'),['id'=>'title','placeholder' => trans('messages.title'),'class' =>'form-control','required']) }}
            <small class="help-block with-errors text-danger"></small>
        </div>
        
       <div class="form-group col-md-12 d-none" id="select_service">
    {{ Form::label('name', __('messages.select_name', ['select' => __('messages.service')]).' <span class="text-danger">*</span>', ['class' => 'form-control-label', 'data-placeholder' => __('messages.select_name', ['select' => __('messages.tax')])], false) }}
    <br />
    <select class="form-control service" name="service_id" id="serviceSelect">
 
        @foreach($services as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
        @endforeach
    </select>
</div>

        <div class="form-group col-md-12">
            {{ Form::label('description',trans('messages.description').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false) }}
            {{ Form::textarea('description', null, ['class'=>"form-control textarea" ,'id'=>'description','rows'=>3  , 'required','placeholder'=> __('messages.description') ]) }}
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
<script>
    $(document).ready(function (){
        var value =  $('.service').find(':selected').attr('data-type');
        $(document).on('change','.is_type',function(){
            var type =  $(this).val();
            
            if(type == 'provider'){
                $('#select_type').addClass('d-none');
                $('#select_service').addClass('d-none');
                $('#description').val('');
            }else{
                $('#select_type').removeClass('d-none');
                var type = $('.notification_type').find(':selected').val();
                if(type == "alldata"){
                    $('#select_service').addClass('d-none');
                    $('#description').val('')
                }
                else{
                    $('#select_service').removeClass('d-none');
                    textareaValue(value)
                }
                
            }
        });

        $(document).on('change','.notification_type',function(){
            var type =  $(this).val();
            if(type == 'service'){
                textareaValue(value)
                $('#select_service').removeClass('d-none');
            }else{
                $('#select_service').addClass('d-none');
                $('#description').val('')
            }
        });
        $(document).on('change','.service',function(){
            var value =  $(this).find(':selected').attr('data-type');
            textareaValue(value)
            
        });
    });
    function textareaValue(value){
        $('#description').val(value)
    }
    $(document).ready(function() {
    $('#serviceSelect').select2();
});
</script>