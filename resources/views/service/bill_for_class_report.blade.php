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
                            <h5 class="font-weight-bold">{{ __('messages.Bill_coaches') }}</h5>
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
        document.addEventListener('DOMContentLoaded', (event) => {
            
            window.renderedDataTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                columnDefs: [{
                    targets: '_all',
                    className: 'text-wrap',
                    width: '20%'
                }],
                dom: '<"row align-items-center"><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" l><"col-md-6" p>><"clear">',
                ajax: {
                    "type": "post",
                    "url": "{{ route('classReportDetails') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "data": function(d) {
                        d.search = {
                            value: $('.dt-search').val()
                        };
                        d.filter = {
                            column_status: $('#column_status').val()
                        };
                        d.subscriptionId = "{{ $subscriptionId }}";
                        d.coachId = "{{ $coachId }}";
                    },
                },
                columns: [{
                        name: 'stafName',
                        data: (data)=>{
                            return data.staf?.name ?? "__"
                        },
                        title: "{{ __('messages.Reception_name') }}",
                        exportable: false,
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: (data)=>{
                            return data.subscription?.name ?? ''
                        },
                        name: 'subscription',
                        title: "{{ __('messages.Subscription_Name') }}"
                    },
                    {
                        data: (data)=>{
                            return data.subscription?.price ?? ''
                        },
                        name: 'subscription',
                        title: "{{ __('messages.price') }}"
                    },
                    {
                        name: 'stafName',
                        data: (data)=>{
                            return data.user?.name ?? "__"
                        },
                        title: "{{ __('messages.player_name') }}",
                        exportable: false,
                        orderable: false,
                        searchable: false
                    },
                    {
                    data: (data)=>data.branch.name,
                    name: 'branchName',
                    title: "{{ __('messages.branchName') }}"
                   },
                   {
                        data: (data) => data.user_payment?.[0]?.totalAmount ?? 0,
                        name: 'amount',
                        title: "{{ __('messages.Received_Amount') }}"
                    },
                  
                    
                    {
                        data: (data)=>{
                            return (data.isEnd == 1) ?"{{ __('messages.inactive') }}":"{{ __('messages.active') }}"
                        },
                        title: "{{ __('messages.action') }}"
                    },
                ]
            });
        });

        $('#expire_date').change(function() {
            if ($('#expire_date').val()) {
                $('#quick-action-apply').prop('disabled', false);
            } else {
                $('#quick-action-apply').prop('disabled', true);
            }
            renderedDataTable.draw();
        });

        $('.dt-search').on('keyup', function() {
            renderedDataTable.draw();
        });

        if ($('#expire_date').val()) {
            $('#quick-action-apply').prop('disabled', false);
        } else {
            $('#quick-action-apply').prop('disabled', true);
        }

        $(document).on('click', '[data-ajax="true"]', function(e) {
            e.preventDefault();
            const submitUrl = $(this).data('submit');
            const form = $(this).closest('form');
            form.attr('action', submitUrl);
            form.submit();
        });
    </script>
  <style>
    .dataTables_wrapper .dataTable th,
    .dataTables_wrapper .dataTable td {
        white-space: nowrap !important;
        text-overflow: ellipsis !important;
        overflow: hidden !important;
        text-align: center !important;
        /* يجعل النصوص والأرقام في منتصف الأعمدة */
        vertical-align: middle !important;
        /* يضمن توسيط النصوص عموديًا أيضًا */
    }

    /* .dataTables_wrapper .dataTable td.text-wrap {
        white-space: normal !important;
    } */

    .text-center {
        text-align: center !important;
        vertical-align: middle !important;
    }
</style>
</x-master-layout>
