<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ __('messages.player_name') }}: {{ $data['user']->name }}</h5>
                            <a href="#" class="float-right btn btn-sm btn-primary" data-toggle="modal" data-target="#checkinModal">
                                <i class="fa fa-angle-double-left"></i> {{ __('messages.Display_checkin') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            @foreach ($data['bills'] as $bill)
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <span>{{ $bill->date }}</span>
                        <span>{{ $bill->subscription->name }}</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tbody>
                                <tr>
                                    <td><strong>{{ $bill->subscription->price }}</strong><br><small>{{ __('messages.currency') }}</small></td>
                                    <td><strong>{{ $bill->subscription->numOfDays }}</strong><br><small>{{ __('messages.days') }}</small></td>
                                    <td><strong>{{ $bill->subscription->numOfSessions }}</strong><br><small>{{ __('messages.sessions') }}</small></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered text-center">
                            <tbody>
                                <td><strong>{{ __('messages.bill_before_discount') }}</strong><br><small>{{ $bill->price + $bill->discountAmount }}</small></td>
                                <td><strong>{{ __('messages.discount_value') }}</strong><br><small>{{ $bill->discountAmount }}</small></td>
                                <td><strong>{{ __('messages.amount_paid') }}</strong><br><small>{{ optional($bill->userPayment->first())->totalAmount ?? 0 }}</small></td>
                                <td><strong>{{ __('messages.remaining_balance') }}</strong><br><small>{{ $bill->price - (optional($bill->userPayment->first())->totalAmount ?? 0) }}</small></td>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button class="btn btn-secondary complete-bill-btn"
                        data-id="{{ $bill->id }}" 
                        {{ $bill->price - $bill->amount <= 0 ? 'disabled' : '' }}
                        title="{{ $bill->price - $bill->amount <= 0 ? __('messages.cannot_complete_bill_zero_value') : '' }}">
                    {{ __('messages.complete_bill') }}
                </button>
                
                        <button class="btn btn-info freeze-bill-btn" data-id="{{ $bill->id }}">{{ __('messages.freeze') }}</button>
                    </div>
                </div>
            </div>

            @endforeach
            {{-- ////////////////// completeBillModal///////////// --}}
            <div class="modal fade" id="completeBillModal" tabindex="-1" role="dialog" aria-labelledby="completeBillModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="completeBillModalLabel">{{ __('messages.complete_bill') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>{{ __('messages.remaining_balance') }}<span id="remaining-balance"></span></p>
                            <div class="form-group">
                                <label for="paid-amount">{{ __('messages.amount') }}</label>
                                <input type="number" class="form-control" id="paid-amount" placeholder={{ __('messages.Enter-Amount') }}>
                                <small class="text-danger" id="error-message"></small>
                            </div>
                            <div class="form-group">
                                <label for="note">{{ __('messages.note') }}</label>
                                <textarea class="form-control" id="note" rows="3" placeholder={{ __('messages.Enter-note') }}></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
                            <button type="button" class="btn btn-primary" id="save-bill">{{ __('messages.save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ////////// freezeBillModal ///////// --}}
            <div class="modal fade" id="freezeBillModal" tabindex="-1" role="dialog" aria-labelledby="freezeBillModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="freezeBillModalLabel">{{ __('messages.subscription_freeze') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="freeze-start-date"> {{ __('messages.freeze_start_date') }}</label>
                                <input type="date" class="form-control" id="freeze-start-date">
                            </div>
                            <div class="form-group">
                                <label for="freeze-end-date"> {{ __('messages.freeze_end_date') }}</label>
                                <input type="date" class="form-control" id="freeze-end-date">
                            </div>
                            <small class="text-danger" id="freeze-error-message"></small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
                            <button type="button" class="btn btn-primary" id="save-freeze">{{ __('messages.save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['method' => 'POST', 'route' => 'edit.user.details', 'enctype' => 'multipart/form-data', 'data-toggle' => "validator", 'id' => 'handyman']) }}
                        <div class="row">
                            <input hidden name="userId" value="{{ $data['user']->id }}">
                            <div class="form-group col-md-4">
                                {{ Form::label('name', __('messages.name') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::text('name', $data['user']->name, ['placeholder' => __('messages.name'), 'class' => 'form-control', 'required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('gender', __('messages.select_gender', ['select' => __('messages.gender')]) . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::select('gender', ['male' => __('messages.male'), 'female' => __('messages.female')], $data['user']->gender, ['class' => 'form-control select2js', 'required']) }}
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('birthDay', __('messages.birthday') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::text('birthDay', $data['user']->birthDay, ['placeholder' => __('messages.birthday'), 'class' => 'form-control datepicker', 'required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('phoneNumber', __('messages.phone') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::text('phoneNumber', $data['user']->phoneNumber, ['placeholder' => __('messages.phone'), 'class' => 'form-control contact_number', 'required']) }}
                                <small class="help-block with-errors text-danger" id="contact_number_err"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('familyNumber', __('messages.phone_family') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::text('familyNumber', $data['user']->familyNumber, ['placeholder' => __('messages.phone_family'), 'class' => 'form-control contact_number', 'required']) }}
                                <small class="help-block with-errors text-danger" id="contact_number_err"></small>
                            </div>
                            {{-- <div class="form-group col-md-4">
                                {{ Form::label('telephone', __('messages.telephone') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::text('telephone', '', ['placeholder' => __('messages.telephone'), 'class' => 'form-control contact_number', 'required']) }}
                                <small class="help-block with-errors text-danger" id="contact_number_err"></small>
                            </div> --}}

                            <div class="form-group col-md-4">
                                {{ Form::label('homeNumber', __('messages.National_Id') . ' <span class="text-danger">*</span>', ['class' => 'form-control-label'], false) }}
                                {{ Form::text('homeNumber', $data['user']->homeNumber, ['placeholder' => __('messages.National_Id'), 'class' => 'form-control National_Id', 'required']) }}
                                <small class="help-block with-errors text-danger" id="National_Id_err"></small>
                            </div>

                            <div class="form-group col-md-12">
                                {{ Form::label('address', __('messages.Address'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('address',$data['user']->address, ['class' => "form-control textarea", 'rows' => 3, 'placeholder' => __('messages.Address')]) }}
                            </div>
                        </div>
                        {{ Form::submit(__('messages.Update'), ['class' => 'btn btn-md btn-primary float-right mx-1']) }}
                        {{ Form::close() }}
                        <a href="{{ route('show.booking.page',['data'=>$data['user']->id]) }}" class="btn btn-danger mx-1">{{ __('messages.renew_subscription') }}</a>
                        <button class="btn btn-success mx-1">{{ __('messages.add_fingerprint') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('bottom_script')
   <script>
    $(document).ready(function () {
    let currentBillId = null;
    let remainingBalance = 0;

   
    $('.complete-bill-btn').on('click', function () {
        currentBillId = $(this).data('id');
        remainingBalance = $(this).closest('.card').find('.remaining-balance').text(); // استخدم CSS للحصول على القيمة
        $('#remaining-balance').text(remainingBalance);
        $('#completeBillModal').modal('show');
    });

    
    $('#save-bill').on('click', function () {
        const paidAmount = $('#paid-amount').val();
        const note = $('#note').val();

        if (!paidAmount || paidAmount <= 0) {
            $('#error-message').text('الرجاء إدخال قيمة صالحة.');
            return;
        }

        $.ajax({
            url: '{{ route("completePaymenet") }}',
            type: 'POST',
            data: {
                billId: currentBillId,
                amount: paidAmount,
                description :  note,
                _token: '{{ csrf_token() }}', 
            },
            success: function (response) {
                alert('تم إكمال الفاتورة بنجاح.');
                $('#completeBillModal').modal('hide');
                location.reload(); 
            },
            error: function (xhr) {
                alert('حدث خطأ أثناء معالجة الطلب.');
            }
        });
    });
});


$(document).ready(function () {
    let currentBillId = null;

  
    $('.freeze-bill-btn').on('click', function () {
        currentBillId = $(this).data('id');
        $('#freezeBillModal').modal('show');
    });


    $('#save-freeze').on('click', function () {
        const startDate = $('#freeze-start-date').val();
        const endDate = $('#freeze-end-date').val();

       
        if (!startDate || !endDate || new Date(startDate) >= new Date(endDate)) {
            $('#freeze-error-message').text('الرجاء إدخال تواريخ صحيحة.');
            return;
        }

        $.ajax({
            url: '/api/freeze-bill', // مسار API الخاص بالتجميد
            type: 'POST',
            data: {
                bill_id: currentBillId,
                start_date: startDate,
                end_date: endDate,
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                alert('تم تجميد الاشتراك بنجاح.');
                $('#freezeBillModal').modal('hide');
                location.reload();
            },
            error: function (xhr) {
                alert('حدث خطأ أثناء معالجة الطلب.');
            }
        });
    });
});


   </script>
    @endsection
</x-master-layout>
