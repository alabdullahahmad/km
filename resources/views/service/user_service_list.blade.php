<x-master-layout>

    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    </head>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ __('messages.Comprehensive_report') }}</h5>
                            <div class="d-flex justify-content-center align-items-center gap-3 mx-auto">
                                <span class="value-label font-weight-bold">{{ __('messages.num_player') }}</span>
                                <span class="value-amount font-weight-bold" id="player-count">0</span>
                            </div>
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

                        <button id="export-excel" class="btn btn-success btn-sm ml-2"><i class="fa fa-file-excel"></i>
                            Export to Excel</button>
                        {{-- <button id="export-pdf" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i> Export to PDF</button> --}}

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
                serverSide: true, // البحث Client-side فقط
                autoWidth: false,
                responsive: true,
                columnDefs: [{
                    targets: '_all',
                    className: 'text-wrap',
                    width: '20%'
                }],

                dom: '<"row align-items-center"><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" l><"col-md-6" p>><"clear">',

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
                columns: [{
                        data: (data) => data.user?.name ?? 'No Name',
                        title: "{{ __('messages.player_name') }}"
                    },
                    {
                    data: (data)=>data.branch.name,
                    name: 'branchName',
                    title: "{{ __('messages.branchName') }}"
                },
                    {
                        data: (data) => data.subscription?.type ?? 'No Type',
                        title: "{{ __('messages.Subscription type') }}"
                    },
                    {
                        data: (data)=> data.subscription_coach?.period,
                        title: "{{ __('messages.subscription_period') }}"
                    },
                    {
                        data: (data) => data.coach?.name ?? 'No Coach',
                        title: "{{ __('messages.coach_name') }}"
                    },
                    {
                        data: (data) => {
                            const baseAmount = data.price ?? data.amount ?? 0;
                            return baseAmount + (data.discountAmount ?? 0);
                        },
                        title: "{{ __('messages.Amount_Before_Discount') }}"
                    },
                    {
                        data: 'discountAmount',
                        title: "{{ __('messages.Discount_Percentage') }}"
                    },
                    {
                        data: (data) => data.discountBecouse,
                        title: "{{ __('messages.Discount_reason') }}"
                    },
                    {
                        data: (data) => data.price ?? data.amount ?? 0,
                        title: "{{ __('messages.Amount_After_Discount') }}"
                    },
                    {
                        data: (data) => data.user?.name ?? 'No User',
                        title: "{{ __('messages.Reception_name') }}"
                    },
                    {
                        data: (data) => data.created_at,
                        title: "{{ __('messages.payment_date_time') }}"
                    },
                    {
                        data: (data) => data.user_payment?.[0]?.totalAmount ?? 0,
                        title: "{{ __('messages.payment_amount') }}"
                    },
                    {
                        data: 'description',
                        title: "{{ __('messages.Description') }}"
                    },
                    {
                        data: (data) => (data.price ?? data.amount ?? 0 - data.user_payment?.[0]?.totalAmount ?? 0 ),
                        title: "{{ __('messages.remaining_balance') }}"
                    },
                    {
                        data: 'id',
                        title: "{{ __('messages.Bill_Number') }}"
                    },
                    {
                        data: (data) => data.startDate,
                        title: "{{ __('messages.Start_Subscription') }}"
                    },
                    {
                        data: (data)=> data.endDate,
                        title: "{{ __('messages.End_Subscription') }}"
                    },
                    {
                        data: 'isFrozen',
                        title: "{{ __('messages.subscription_frozen') }}"
                    },
                    {
                        data: 'frozenByUser',
                        title: "{{ __('messages.modified_by') }}"
                    },
                    {
                        data: 'frozenStartDate',
                        title: "{{ __('messages.freeze_start_date') }}"
                    },
                    {
                        data: 'frozenEndDate',
                        title: "{{ __('messages.freeze_end_date') }}"
                    },
                    {
                        data: (data) => data.isEnd ? "فعال" : "غير فعال",
                        title: "{{ __('messages.status') }}"
                    },
                    {
                        data: (data)=> data.action,
                        title: 'العمليات'
                    }
                ],
                drawCallback: function(settings) {
                    const playerCount = settings.json.recordsTotal || 0;
                    $('#player-count').text(playerCount);
                }
            });

            // البحث اليدوي لجميع الأعمدة
            $('.dt-search').on('keyup', function() {
                const searchTerm = this.value.toLowerCase(); // نص البحث
                window.renderedDataTable.rows().every(function() {
                    const rowData = this.data(); // بيانات الصف

                    // تعريف الحقول القابلة للبحث
                    const searchableFields = [
                        rowData.user?.name ?? '', // اسم اللاعب
                        rowData.subscription?.type ?? '', // نوع الاشتراك
                        rowData.subscriptionPeriod ?? '', // فترة الاشتراك
                        rowData.coach?.name ?? '', // اسم المدرب
                        (rowData.price ?? rowData.amount ?? 0) + (rowData.discountAmount ??
                        0), // المبلغ قبل الخصم
                        rowData.discountAmount ?? '', // نسبة الخصم
                        rowData.discountReason ?? '', // سبب الخصم
                        rowData.price ?? rowData.amount ?? 0, // المبلغ بعد الخصم
                        rowData.paymentDate ?? '', // تاريخ الدفع
                        rowData.description ?? '', // الوصف
                        rowData.remainingBalance ?? '', // الرصيد المتبقي
                        rowData.id ?? '', // رقم الفاتورة
                        rowData.subscriptionStartDate ?? '', // تاريخ بداية الاشتراك
                        rowData.subscriptionEndDate ?? '', // تاريخ نهاية الاشتراك
                        rowData.subscriptionDateModified ?? '', // تاريخ تعديل الاشتراك
                        rowData.modifierName ?? '', // تم التعديل بواسطة
                        rowData.modifiedDate ?? '', // تاريخ التعديل
                        rowData.status ?? '' // الحالة
                    ];

                    // التحقق من وجود نص البحث في أي من الحقول
                    const matchFound = searchableFields.some(field => {
                        if (field !== undefined && field !== null) {
                            return field.toString().toLowerCase().includes(searchTerm);
                        }
                        return false;
                    });

                    // إظهار أو إخفاء الصف بناءً على المطابقة
                    if (matchFound) {
                        $(this.node()).show();
                    } else {
                        $(this.node()).hide();
                    }
                });
            });
        });



        $('#export-excel').on('click', function() {
            const wb = XLSX.utils.table_to_book(document.getElementById('datatable'), {
                sheet: "Sheet JS"
            });
            XLSX.writeFile(wb, 'Report.xlsx');
        });

        $('#export-pdf').on('click', function() {
            const element = document.getElementById('datatable');
            html2pdf(element, {
                margin: 1,
                filename: 'Report.pdf',
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
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

        .dataTables_wrapper .dataTable td.text-wrap {
            white-space: normal !important;
        }

        .text-center {
            text-align: center !important;
            vertical-align: middle !important;
        }
    </style>

</x-master-layout>
