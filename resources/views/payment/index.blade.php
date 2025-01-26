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
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">{{ __('messages.Coach_Percentage_Total') }}</h5>
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
                            <form action="{{ route('user.bulk-action') }}" id="quick-action-form" class="form-disabled d-flex gap-3 align-items-center">
                                @csrf
                            <div class="input-group" >
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="text" class="form-control datepicker" id="startDate" name="startDate" placeholder="{{ __('messages.Select_Start_Date') }}">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="text" class="form-control datepicker" id="endDate" name="endDate" placeholder="{{ __('messages.Select_End_Date') }}">
                            </div>
                            <button id="quick-action-apply" class="btn btn-primary" data-ajax="true" data--submit="{{ route('user.bulk-action') }}" data-datatable="reload" title="{{ __('user',['form'=>  __('user') ]) }}">
                                {{__('messages.apply')}}
                            </button>
                    </div>

                    </form>
                  </div>
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
                  "type"   : "post",
                  "url"    : '{{ route("classReport")}}',
                  headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                  "data"   : function( d ) {
                    d.search = {
                      value: $('.dt-search').val()
                    };
                    d.startDate = $('#startDate').val() || null;
                    d.endDate = $('#endDate').val() || null;
                  },
                },
                columns: [
                    // {
                    //     name: 'check',
                    //     data: 'check',
                    //     title: '<input type="checkbox" class="form-check-input" name="select_all_table" id="select-all-table" onclick="selectAllTable(this)">',
                    //     exportable: false,
                    //     orderable: false,
                    //     searchable: false,
                    // },
                    {
                        data: (data)=>{
                            return data.coach.name
                        },
                        name: 'coachName',
                        title: "{{__('messages.coash_name')}}",
                         orderable: false,
                    },
                    {
                    data: (data)=>data.branch.name,
                    name: 'branchName',
                    title: "{{ __('messages.branchName') }}"
                },
                    {
                        data: (data)=>{
                            return data.subscription.name
                        },
                        name: 'subscriptionNamw',
                        title: "{{__('messages.Subscription_Name')}}"
                    },
                    {
                        data: 'total',
                        name: 'total',
                        title: "{{__('messages.Total')}}"
                    },
                    {
                        data: 'totalPercentage',
                        name: 'totalPercentage',
                        title: "{{__('messages.Coach_Percentage_Total')}}"
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        title: "{{__('messages.action')}}",
                    }

                ]

            });
      });

            // سكربت لتطبيق فلترة التواريخ
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
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
