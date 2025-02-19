<x-master-layout>

    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
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
                    <form action="{{ route('user.bulk-action') }}" id="quick-action-form" class="form-disabled d-flex gap-3 align-items-center">
                        @csrf
                        <div class="input-group ml-2">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            <input type="text" class="form-control  datepicker"   id="startDate" name="startDate" placeholder= {{__('messages.Select_Date')}} required>
                        </div>
                        <div class="input-group ml-2">
                          <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                          <input type="text" class="form-control datepicker"  id="endDate" name="endDate" placeholder= {{__('messages.Select_Date')}} required>
                      </div>
    
                        <button id="quick-action-apply" class="btn btn-primary" data-ajax="true" data--submit="{{ route('user.bulk-action') }}" data-datatable="reload" title="{{ __('user',['form'=>  __('user') ]) }}">
                            {{__('messages.apply')}}
                        </button>
                        {{-- <div class="input-group ml-2">
                          <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                          <input type="text" class="form-control dt-search" placeholder="Search..." aria-label="Search" aria-describedby="addon-wrapping" aria-controls="dataTableBuilder">
                        </div> --}}
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
                            {{ __('messages.Export_to_Excel') }}</button>
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
                        data: (data) => data.user?.name ?? '___',
                        title: "{{ __('messages.player_name') }}"
                    },
                    {
                    data: (data)=>data.branch.name,
                    name: 'branchName',
                    title: "{{ __('messages.branchName') }}"
                },
                    {
                        data: (data) => data.subscription?.name ?? '___',
                        title: "{{ __('messages.Subscription type') }}"
                    },
                    {
                        data: (data)=> data.subscription_coach?.period ?? "___",
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
                        data: (data)=> data.discountAmount ?? 0,
                        title: "{{ __('messages.Discount_Percentage') }}"
                    },
                    {
                        data: (data) => data.discountBecouse ?? "___",
                        title: "{{ __('messages.Discount_reason') }}"
                    },
                    {
                        data: (data) => data.price ?? data.amount ?? 0,
                        title: "{{ __('messages.Amount_After_Discount') }}"
                    },
                    {
                        data: (data) => data.staf?.name ?? '___',
                        title: "{{ __('messages.Reception_name') }}"
                    },
                    {
                        data: (data) => {
                        const date = new Date(data.created_at); // تحويل النص إلى كائن تاريخ

                        // استخراج السنة، الشهر، اليوم، الساعة، والدقائق
                        const year = date.getFullYear();
                        const month = String(date.getMonth() + 1).padStart(2, '0'); // إضافة صفر إلى الشهر إذا كان أقل من 10
                        const day = String(date.getDate()).padStart(2, '0'); // إضافة صفر إلى اليوم إذا كان أقل من 10

                        // تنسيق الوقت بصيغة 12 ساعة مع AM/PM
                        let hours = date.getHours();
                        const minutes = String(date.getMinutes()).padStart(2, '0'); // إضافة صفر إلى الدقائق إذا كانت أقل من 10
                        const amPm = hours >= 12 ? 'PM' : 'AM'; // تحديد AM أو PM
                        hours = hours % 12 || 12; // تحويل الساعة إلى صيغة 12 ساعة

                        // دمج التاريخ والوقت بالشكل المطلوب
                        return `${year}-${month}-${day}, ${String(hours).padStart(2, '0')}:${minutes} ${amPm}`;
                    },
                    title: "{{ __('messages.payment_date_time') }}",
                    render: function(data, type, row) {
                            return `<span dir="ltr">${data}</span>`;
                        }

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
                        data: (data) => ((data.price ?? data.amount ?? 0) - (data.user_payment?.[0]?.totalAmount ?? 0) ),
                        title: "{{ __('messages.remaining_balance') }}"
                    },
                    {
                        data: 'id',
                        title: "{{ __('messages.Bill_Number') }}"
                    },
                    {
                        data: (data) => data.startDate ?? "___",
                        title: "{{ __('messages.Start_Subscription') }}"
                    },
                    {
                        data: (data)=> data.endDate ?? "___",
                        title: "{{ __('messages.End_Subscription') }}"
                    },
                    {
                    data: (data) => {
                        return data.startDateFreeze && data.endDateFreeze ? "{{ __('messages.YES') }}" : "{{ __('messages.NO') }}";
                    },
                    title: "{{ __('messages.subscription_frozen') }}"
                },
                // {
                //     data: 'frozenByUser',
                //     title: "{{ __('messages.modified_by') }}"
                // },
                {
                    data: (data) => data.startDateFreeze ?? "___",
                    title: "{{ __('messages.freeze_start_date') }}"
                },
                {
                    data: (data) => data.endDateFreeze ?? "___",
                    title: "{{ __('messages.freeze_end_date') }}"
                },

                    {
                        data: (data) => data.isEnd ? "{{ __('messages.active') }}" : "{{ __('messages.inactive') }}" ,
                        title: "{{ __('messages.status') }}"
                    },
                    {
                        data: (data)=> data.action,
                        title: "{{ __('messages.action') }}"
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




        // // Event Listeners:
        // $('#startDate').change(function() {
        //       // إذا كان هناك تاريخ تم تحديده، نفعّل الزر
        //           $('#quick-action-apply').prop('disabled', false);  // تمكين الزر
        //       // تحديث الجدول بناءً على الفلترة
        //   });


        //   $('#endDate').change(function() {
        //       // إذا كان هناك تاريخ تم تحديده، نفعّل الزر
        //           $('#quick-action-apply').prop('disabled', false);  // تمكين الزر
        //       // تحديث الجدول بناءً على الفلترة
        //   });

    

        // $(document).on('click', '[data-ajax="true"]', function (e) {
        // renderedDataTable.draw();
        // });

        // التأكد من تعبئة كلا التاريخين قبل تفعيل الزر
function checkDatesFilled() {
    const startDate = $('#startDate').val(); // قيمة تاريخ البداية
    const endDate = $('#endDate').val(); // قيمة تاريخ النهاية

    // تفعيل الزر فقط إذا كان كلا الحقلين غير فارغين
    if (startDate && endDate) {
        $('#quick-action-apply').prop('disabled', false); // تمكين الزر
    } else {
        $('#quick-action-apply').prop('disabled', true); // تعطيل الزر
    }
}

// الحدث عند تغيير تاريخ البداية
$('#startDate').on('change', function () {
    checkDatesFilled(); // التحقق من الحقول
});

$('.dt-search').on('keyup', function() {
            renderedDataTable.draw();
        });
// الحدث عند تغيير تاريخ النهاية
$('#endDate').on('change', function () {
    checkDatesFilled(); // التحقق من الحقول
});

// منع النقر على الزر إذا كان معطلاً
$(document).on('click', '[data-ajax="true"]', function (e) {
    if ($('#quick-action-apply').prop('disabled')) {
        e.preventDefault(); // إلغاء الحدث إذا كان الزر معطلاً
        return false;
    }

    // إذا كان الزر مفعلاً، يتم إعادة تحميل الجدول
    renderedDataTable.draw();
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
