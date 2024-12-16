<x-master-layout>

    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    </head>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ __('messages.Report_Bills') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-md-10">
                    <form action="{{ route('user.bulk-action') }}" id="quick-action-form"
                        class="form-disabled d-flex gap-3 align-items-center">
                        @csrf
                        <div class="input-group ml-2">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            <input type="text" class="form-control datepicker" id="expire_date" name="expire_date"
                                placeholder="{{ __('messages.Select_Date') }}">
                        </div>
                        <div class="input-group ml-2">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            <input type="text" class="form-control datepicker" id="expire_date" name="expire_date"
                                placeholder="{{ __('messages.Select_Date') }}">
                        </div>
                        <button id="quick-action-apply" class="btn btn-primary" data-ajax="true"
                            data--submit="{{ route('user.bulk-action') }}" data-datatable="reload"
                            title="{{ __('user', ['form' => __('user')]) }}">
                            {{ __('messages.apply') }}
                        </button>
                    </form>

                    <!-- استخدام Flexbox لترتيب حقل البحث وselect بجانب بعضهما -->
                    <div class="d-flex align-items-center gap-3 mt-3">
                        <!-- حقل البحث -->
                        <div class="input-group">
                            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control dt-search" placeholder="Search..."
                                aria-label="Search" aria-describedby="addon-wrapping" aria-controls="dataTableBuilder">
                        </div>

                        <!-- عنصر select بجانب حقل البحث -->
                        <select name="column_status" id="column_status" class="select2 form-control"
                            data-filter="select" style="width: 50%">
                            <option value="">{{ __('messages.all') }}</option>
                            <option value="0" {{ $filter['status'] == '0' ? 'selected' : '' }}>
                                {{ __('messages.inactive') }}</option>
                            <option value="1" {{ $filter['status'] == '1' ? 'selected' : '' }}>
                                {{ __('messages.active') }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="datatable" class="table table-striped border"></table>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', () => {
    window.renderedDataTable = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        dom: '<"row align-items-center"<"col-md-6" l><"col-md-6" f>>' +
             '<"table-responsive my-3" rt>' +
             '<"row align-items-center"<"col-md-6" i><"col-md-6" p>>',
        ajax: {
            type: "POST",
            url: "{{ route('billReport') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: function(d) {
                d.search = {
                    value: $('.dt-search').val() || ''
                };
                d.filter = {
                    column_status: $('#column_status').val() || 'all'
                };
                d.startDate = $('#startDate').val() || null;
                d.endDate = $('#endDate').val() || null;
            }
        },
        columns: [
            { data: (data) => data.staf?.name ?? 'N/A', title: "{{ __('messages.Reception_name') }}" },
            { data: (data) => data.user?.name ?? 'No User', title: "{{ __('messages.player_name') }}" },
            { data: 'payType', title: "{{ __('messages.payment_type') }}" },
            { data: 'date', title: "{{ __('messages.payment_time') }}" },
            { data: 'paymrentNote', title: "{{ __('messages.payment_note') }}" },
            {
                data: (data) =>{
                    const baseAmount = data.price ?? data.amount ?? 0;
                    return baseAmount + (data.discountAmount ?? 0);
                },
                title: "{{ __('messages.Amount_Before_Discount') }}"
            },
            { data: 'discountAmount', title: "{{ __('messages.Discount_Percentage') }}" },
            {
                data: (data) => {
                    const baseAmount = data.price ?? data.amount ?? 0;
                    return baseAmount ;
                },
                title: "{{ __('messages.Amount_After_Discount') }}"
            },
            { data: (data) => {return data.user_payment?.[0]?.totalAmount ?? 0}, title: "{{ __('messages.Received_Amount') }}" },
            { data: 'description', title: "{{ __('messages.Description') }}" },
            {
                data: (data) => data.subscription?.name ?? 'No Subscription',
                title: "{{ __('messages.Subscription_Name') }}"
            },
            { data: 'id', title: "{{ __('messages.Bill_Number') }}" }
        ]
    });
});

// Event Listeners:
$('#expire_date').change(function() {
    $('#quick-action-apply').prop('disabled', !$('#expire_date').val());
    renderedDataTable.draw();
});

$('.dt-search').on('keyup', function() {
    renderedDataTable.draw();
});

$(document).on('click', '[data-ajax="true"]', function(e) {
    e.preventDefault();
    const submitUrl = $(this).data('submit');
    $(this).closest('form').attr('action', submitUrl).submit();
});

    </script>

</x-master-layout>
