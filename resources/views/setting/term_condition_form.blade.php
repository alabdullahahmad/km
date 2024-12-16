<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ __('messages.Player_Registration') }}</h5>
                            <a href="#" class="float-right btn btn-sm btn-primary">
                                <i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['method' => 'POST', 'route' => 'addUser', 'enctype' => 'multipart/form-data', 'data-toggle' => "validator", 'id' => 'handyman']) }}
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('name', __('messages.name') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::text('name', 'John Doe', ['placeholder' => __('messages.name'), 'class' => 'form-control', 'required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            {{-- <div class="form-group col-md-4">
                                {{ Form::label('password', __('messages.password') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('messages.password'), 'required', 'autocomplete' => 'new-password']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div> --}}

                            <div class="form-group col-md-4">
                                {{ Form::label('gender', __('messages.select_gender', ['select' => __('messages.gender')]) . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::select('gender', ['male' => 'Male', 'female' => 'Female'], 'male', ['class' => 'form-control select2js', 'required']) }}
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('birthDay', __('messages.birthday') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::text('birthDay', '2000-01-01', ['placeholder' => __('messages.birthday'), 'class' => 'form-control datepicker', 'required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('phoneNumber', __('messages.phone') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::text('phoneNumber', '1234567890', ['placeholder' => __('messages.phone'), 'class' => 'form-control contact_number', 'required']) }}
                                <small class="help-block with-errors text-danger" id="contact_number_err"></small>
                            </div>
                            {{-- <div class="form-group col-md-4">
                                {{ Form::label('familyNumber', __('messages.phone_family') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::text('familyNumber', '1234567890', ['placeholder' => __('messages.phone_family'), 'class' => 'form-control contact_number', 'required']) }}
                                <small class="help-block with-errors text-danger" id="contact_number_err"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('homeNumber', __('messages.telephone') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::text('homeNumber', '1234567890', ['placeholder' => __('messages.telephone'), 'class' => 'form-control contact_number', 'required']) }}
                                <small class="help-block with-errors text-danger" id="contact_number_err"></small>
                            </div> --}}

                            {{-- <div class="form-group col-md-4">
                                {{ Form::label('personalid', __('messages.National_Id') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::text('personalid', '12345678901', ['placeholder' => __('messages.National_Id'), 'class' => 'form-control National_Id', 'required']) }}
                                <small class="help-block with-errors text-danger" id="National_Id_err"></small>
                            </div> --}}

                            {{-- <div class="form-group col-md-4">
                                {{ Form::label('percentage', __('messages.percentage') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::text('percentage', '50', ['placeholder' => __('messages.percentage'), 'class' => 'form-control percentage', 'required']) }}
                                <small class="help-block with-errors text-danger" id="percentage_err"></small>
                            </div> --}}

                            {{-- <div class="form-group col-md-12">
                                {{ Form::label('address', __('messages.Address'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('address', '123 Fake Street, City, Country', ['class' => "form-control textarea", 'rows' => 3, 'placeholder' => __('messages.Address')]) }}
                            </div> --}}
                        </div>
                        {{ Form::submit(__('messages.create_subscription'), ['class' => 'btn btn-md btn-primary float-right']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('bottom_script')
    <script type="text/javascript">
        (function ($) {
            "use strict";
            $(document).ready(function () {
                // بيانات وهمية للولايات
                var states = [
                    { id: 1, text: "State 1" },
                    { id: 2, text: "State 2" },
                    { id: 3, text: "State 3" },
                ];

                // بيانات وهمية للمدن
                var cities = [
                    { id: 1, text: "City 1" },
                    { id: 2, text: "City 2" },
                    { id: 3, text: "City 3" },
                ];

                // إعداد القوائم الوهمية
                $('#state_id').select2({
                    data: states,
                    placeholder: "Select State",
                });

                $('#city_id').select2({
                    data: cities,
                    placeholder: "Select City",
                });
            });
        })(jQuery);
    </script>
    @endsection
</x-master-layout>
