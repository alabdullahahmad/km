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
                            <h5 class="font-weight-bold">{{ __('messages.Active-subscriptions-report') }}</h5>
                            <div class="d-flex justify-content-center align-items-center gap-3 mx-auto">
                                <span class="value-label font-weight-bold">{{ __('messages.num_player') }}</span>
                                <span class="value-amount font-weight-bold" id="player-count">0</span>

                            </div>
                            <button id="export-excel" class="btn btn-success btn-sm ml-2"><i class="fa fa-file-excel"></i> Export to Excel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between">
                <div>
                    <div class="col-md-12">
                        <form id="date-filter-form" class="form-disabled d-flex gap-3 align-items-center">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="text" class="form-control datepicker" id="start_date" name="start_date"
                                    placeholder="{{ __('messages.Select_Start_Date') }}">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="text" class="form-control datepicker" id="end_date" name="end_date"
                                    placeholder="{{ __('messages.Select_End_Date') }}">
                            </div>
                            <button id="apply-date-filter" class="btn btn-primary">
                                {{ __('messages.apply') }}
                            </button>
                    </div>

                    </form>
                </div>
                <div class="d-flex justify-content-end">

                    <div class="input-group ml-2">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control dt-search" placeholder="Search..." aria-label="Search"
                            aria-describedby="addon-wrapping" aria-controls="dataTableBuilder">
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
                    "type": "get",
                    "url": '{{ route("usersDues") }}',
                    "data": function(d) {
                        d.search = {
                            value: $('.dt-search').val() || ''
                        };
                    }
                },
                columns: [
                    {
                        data: (data) => {
                            return data.user.name; // اسم المشترك
                        },
                        name: 'user_name',
                        title: "{{ __('messages.player_name') }}"
                    },
                    {
                    data: (data)=>data.branch.name,
                    name: 'branchName',
                    title: "{{ __('messages.branchName') }}"
                },
                    {
                        data: (data) => {
                            return data.subscription.name; // طبيعة الاشتراك
                        },
                        name: 'subscription_type',
                        title: "{{ __('messages.Subscription type') }}"
                    },
                    {
                        data: 'startDate', // تاريخ بداية الاشتراك
                        name: 'start_date',
                        title: "{{ __('messages.Start_Subscription') }}"
                    },
                    {
                        data: 'endDate', // تاريخ نهاية الاشتراك
                        name: 'end_date',
                        title: "{{ __('messages.End_Subscription') }}"
                    },
                    {
                        data: (data) => {
                            return data.isActive ? "{{ __('messages.active') }}" : "{{ __('messages.inactive') }}"; // الحالة
                        },
                        name: 'status',
                        title: "{{ __('messages.status') }}"
                    }
                ],
                drawCallback: function(settings) {
            const playerCount = settings.json.recordsTotal || 0;
            $('#player-count').text(playerCount);
        }
            });

        });






        $('#export-excel').on('click', function() {
                const wb = XLSX.utils.table_to_book(document.getElementById('datatable'), {sheet: "Sheet JS"});
                XLSX.writeFile(wb, 'Report.xlsx');
            });

            $('#export-pdf').on('click', function() {
                const element = document.getElementById('datatable');
                html2pdf(element, {
                    margin: 1,
                    filename: 'Report.pdf',
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                });
            });
        // سكربت لتطبيق فلترة التواريخ
        $('#apply-date-filter').click(function(e) {
            e.preventDefault();

            // التحقق من تعبئة كلا الخانتين
            const startDate = $('#start_date').val();
            const endDate = $('#end_date').val();

            if (!startDate || !endDate) {
                Swal.fire({
                    icon: 'warning',
                    title: '{{ __('messages.warning') }}',
                    text: '{{ __('messages.fill_both_dates') }}',
                });
                return;
            }

            // إعادة تحميل الجدول
            window.renderedDataTable.ajax.reload();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
