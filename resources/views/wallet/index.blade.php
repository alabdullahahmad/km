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
                            <h5 class="font-weight-bold">{{ __('messages.Bill') }}</h5>
                            <a href="{{ route('wallet.create') }}" class="float-right mr-1 btn btn-sm btn-primary">
                                <i class="fa fa-plus-circle"></i> {{ trans('messages.add_form_title',['form' => trans('messages.Bill')  ]) }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="d-flex justify-content-end">
                    <div class="input-group ml-2">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control dt-search" placeholder="Search..." aria-label="Search" aria-describedby="addon-wrapping" aria-controls="dataTableBuilder">
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped border">

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // تهيئة DataTables
            const dataTable = $('#datatable').DataTable({
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
                    type: "GET",
                    url: '{{ route("Bill") }}',
                    data: function (d) {
                        d.filter = {
                            column_status: $('#column_status').val()
                        };
                    }
                },
                searching: false, // تعطيل البحث الافتراضي للسيرفر
                columns: [
                    {
                        data: () => "cash", // عمود ثابت
                        name: 'title',
                        title: "{{__('messages.cash')}}"
                    },
                    {
                        data: (data) => data.staf?.name ?? '', // التحقق من وجود name داخل staf
                        name: 'user_id',
                        title: "{{__('messages.name')}}"
                    },
                    {
                        data: (data) => data.payType ?? '', // التعامل مع القيم الفارغة
                        name: 'payType',
                        title: "{{__('messages.type')}}"
                    },
                    {
                        data: (data) => data.date ?? '', // التعامل مع القيم الفارغة
                        name: 'date',
                        title: "{{__('messages.Date')}}"
                    },
                    {
                        data: (data) => data.user_payment?.[0]?.totalAmount ?? 0, // التأكد من التعامل مع القيم الرقمية
                        name: 'amount',
                        title: "{{__('messages.amount')}}"
                    },
                    @if(auth()->user()->hasRole('admin'))
                    {
                    data: (data)=>data.branch.name,
                    name: 'branchName',
                    title: "{{ __('messages.branchName') }}"
                    },
                    @endif
                    {
                        data: (data) => data.description ?? '', // التعامل مع القيم الفارغة
                        name: 'description',
                        title: "{{__('messages.description')}}"
                    },
                    {
                        data: (data) => data.action ?? '', // التعامل مع القيم الفارغة
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        title: "{{__('messages.action')}}"
                    }
                ]
            });

            // البحث الدقيق على الحقول
            $('.dt-search').on('keyup', function () {
                const searchTerm = this.value.toLowerCase();

                // تصفية البيانات حسب الحقول
                dataTable.rows().every(function () {
                    const rowData = this.data();
                    const searchableFields = [
                        "cash",                       // عمود ثابت
                        rowData.staf?.name ?? '',     // التحقق من وجود name داخل staf
                        rowData.payType ?? '',        // نوع الدفع
                        rowData.date ?? '',           // التاريخ
                        (rowData.user_payment?.[0]?.totalAmount ?? 0).toString(), // قيمة الدفع (تشمل 0)
                        rowData.description ?? ''     // الوصف
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    </x-master-layout>
