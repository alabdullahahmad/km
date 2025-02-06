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
                            <h5 class="font-weight-bold">{{ __('messages.Report_cash') }}</h5>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-12">
              <div class="card card-block card-stretch">
                  <div class="card-body p-0">
                      <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                        <span class="value-label font-weight-bold">{{ __('messages.Total:') }}</span>
                        <span id="total" class="value-amount font-weight-bold">275,000</span>
                          <div class="d-flex justify-content-center align-items-center gap-3 mx-auto">

                            <span class="value-label font-weight-bold">{{ __('messages.Total_CashIn') }}</span>
                            <span id="fundCashIn" class="value-amount font-weight-bold">275,000</span>


                        </div>
                        <span class="value-label font-weight-bold">{{ __('messages.Total_CashOut') }}</span>
                            <span id="fundCashOut" class="value-amount font-weight-bold">2700000005,000</span>
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

        let totalIn = 0;
        let totalOut = 0;
        window.renderedDataTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                dom: '<"row align-items-center"><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" l><"col-md-6" p>><"clear">',
                ajax: {
                  "type"   : "post",
                  "url"    : '{{ route("fundReport") }}',
                  headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                  "data"   : function( d ) {
                    d.search = {
                      value: $('.dt-search').val()
                    };
                    d.filter = {
                      column_status: $('#column_status').val()
                    }
                    d.startDate = $('#startDate').val();
                    d.endDate = $('#endDate').val();
                  }
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
                            totalIn+=parseInt(data.cashIn);
                            return data.cashIn;
                        },
                        name: 'cashIn',
                        title: "{{__('messages.Cash_In')}}"
                    },
                    {
                        data: (data)=>{
                            totalOut+=parseInt(data.cashOut);
                            return data.cashOut;
                        },
                        name: 'cashOut',
                        title: "{{__('messages.Cash_out')}}"
                    },
                    {
                    data: (data)=>data.branch.name,
                    name: 'branchName',
                    title: "{{ __('messages.branchName') }}"
                },
                    {
                        data: (data)=>{
                            return data.cashIn - data.cashOut;
                        },
                        name: 'customer_id',
                        title: "{{__('messages.Total')}}"
                    },
                    // {
                    //     data: 'status',
                    //     name: 'status',
                    //     title: "{{__('messages.status')}}"
                    // },
                    {
                        data: 'date',
                        name: 'date',
                        title: "{{__('messages.Payment_Data')}}",
                        render: function(data, type, row) {
                            return `<span dir="ltr">${data}</span>`;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        title: "{{__('messages.action')}}"
                    }

                ],
                drawCallback : ()=>{
                    $("#fundCashIn").text(totalIn);
                    $("#fundCashOut").text(totalOut);
                    $("#total").text((totalIn - totalOut));
                    totalIn = 0;
                    totalOut = 0;
                }

            });

      });



    </script>
    <script>
         // عند تغيير تاريخ الفلترة، يتم تمكين زر التطبيق
         $('#startDate').change(function() {
              // إذا كان هناك تاريخ تم تحديده، نفعّل الزر
                  $('#quick-action-apply').prop('disabled', false);  // تمكين الزر
              // تحديث الجدول بناءً على الفلترة
          });


          $('#endDate').change(function() {
              // إذا كان هناك تاريخ تم تحديده، نفعّل الزر
                  $('#quick-action-apply').prop('disabled', false);  // تمكين الزر
              // تحديث الجدول بناءً على الفلترة
          });
          // فلترة البيانات عند كتابة نص في حقل البحث
          $('.dt-search').on('keyup', function () {
              renderedDataTable.draw();
          });


      $(document).on('click', '[data-ajax="true"]', function (e) {
        renderedDataTable.draw();
      });
    </script>

</x-master-layout>
