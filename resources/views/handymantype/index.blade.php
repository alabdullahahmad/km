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
                            <h5 class="font-weight-bold">{{__('messages.Update_list') }}</h5>
                       
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
                  type: "GET",
                  url: "{{ route('showBillLog') }}",
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data: function(d) {
                      d.search = {
                          value: $('.dt-search').val() || ''
                      };
                      d.billId = {!! $billId !!};
                      d.filter = {
                          column_status: $('#column_status').val() || 'all'
                      };
                      d.startDate = $('#startDate').val() || null;
                      d.endDate = $('#endDate').val() || null;
                  }
              },
              columns: [
                {
                    data: (data) => {
                        return data.subscriptionDateModified === 1 ? "{{ __('messages.YES') }}" : "{{ __('messages.NO') }}";
                    },
                    title: "{{ __('messages.modify_subscription_date') }}"
                },

                  {
                    data: (data)=>data.staf.name,
                      title: "{{ __('messages.modified_by') }}"
                  },
                  {
                    data: (data)=>data.startDateAfterEdit?? '___',
                    
                      title: "{{ __('messages.date_after_modification') }}"
                  },
                
                  {
                    data: (data) => {
                        return data.isTypeModified === 1 ? "{{ __('messages.YES') }}" : "{{ __('messages.NO') }}";
                    },
                    
                      title: "{{ __('messages.type_modified') }}"
                  },
                  {
                    data: (data)=>data.subscription_before?.name?? '___',
                     
                      title: "{{ __('messages.type_before_modification') }}"
                  },

                  {
                    data: (data)=>data.subscription_after?.name ?? '___',
                    
                      title: "{{ __('messages.type_after_modification') }}"
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
                    title: "{{ __('messages.type_modification_date_time') }}"

                   },      
               
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
                
                      rowData.subscriptionDateModified ?? '', // تاريخ تعديل الاشتراك
                      rowData.modifierName ?? '', // تم التعديل بواسطة
                      rowData.modifiedDate ?? '', // تاريخ التعديل
                    
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
