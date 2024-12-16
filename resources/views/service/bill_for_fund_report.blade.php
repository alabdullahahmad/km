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
                            <h5 class="font-weight-bold">{{ __('messages.Bills') }}</h5>
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
                    <!-- استخدام Flexbox لترتيب حقل البحث وselect بجانب بعضهما -->
                    <div class="d-flex align-items-center gap-3 mt-3">
                        <!-- حقل البحث -->
                        <div class="input-group">
                            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control dt-search" placeholder="Search..."
                                aria-label="Search" aria-describedby="addon-wrapping" aria-controls="dataTableBuilder">
                        </div>
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
        dom: '<"row align-items-center"><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" l><"col-md-6" p>><"clear">',
        ajax: {
            type: "POST",
            url: "{{ route('billReport') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: function(d) {
                d.startDate = "{{ $startDate ?? '' }}";
                d.endDate = "{{ $endDate ?? '' }}";
            },
        },
        columns: [
            {
                data: (data) => data.staf?.name ?? '',
                title: "{{ __('messages.Reception_name') }}",
                orderable: false,
                searchable: false
            },
            {
                data: (data) => data.user?.name ?? '',
                title: "{{ __('messages.player_name') }}"
            },
            {
                data: 'payType',
                title: "{{ __('messages.payment_type') }}"
            },
            {
                data: 'date',
                title: "{{ __('messages.payment_time') }}"
            },
            {
                data: 'paymrentNote',
                title: "{{ __('messages.payment_note') }}"
            },
            {
                data: (data) => (data.price ?? data.amount ?? 0) +  (data.discountAmount ?? 0),
                title: "{{ __('messages.Amount_Before_Discount') }}"
            },
            {
                data: 'discountAmount',
                title: "{{ __('messages.Discount_Percentage') }}"
            },
            {
                data: (data) => {
                    const baseAmount = data.price ?? data.amount ?? 0;
                    return baseAmount ;
                },
                title: "{{ __('messages.Amount_After_Discount') }}"
            },
            {
                data: (data) => data.user_payment?.[0]?.totalAmount ?? 0,
                title: "{{ __('messages.Received_Amount') }}"
            },
            {
                data: 'description',
                title: "{{ __('messages.Description') }}"
            },
            {
                data: (data) => data.subscription?.name ?? '',
                title: "{{ __('messages.Subscription_Name') }}"
            },
            {
                data: 'id',
                title: "{{ __('messages.Bill_Number') }}"
            }
        ]
    });

    // Event listeners for input interactions
    $('#expire_date').change(function() {
        $('#quick-action-apply').prop('disabled', !$('#expire_date').val());
        renderedDataTable.draw();
    });

    $('.dt-search').on('keyup', function() {
        renderedDataTable.draw();
    });

    // Initial button state
    $('#quick-action-apply').prop('disabled', !$('#expire_date').val());

    // Form submission handler
    $(document).on('click', '[data-ajax="true"]', function(e) {
        e.preventDefault();
        const submitUrl = $(this).data('submit');
        const form = $(this).closest('form');
        form.attr('action', submitUrl);
        form.submit();
    });
});

    </script>

</x-master-layout>
