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
                          <h5 class="font-weight-bold">{{ __('messages.Player') }}</h5>
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
    let tableData = []; // تخزين البيانات محليًا عند التحميل الأول
    window.renderedDataTable = $('#datatable').DataTable({
        processing: true,
        serverSide: false, // تعطيل جلب البيانات عند البحث
        searching: false,  // تعطيل البحث الافتراضي لـ DataTables
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
            "url": '{{ route("userReport") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataSrc: function(json) {
                tableData = json.data; // تخزين البيانات عند تحميلها
                return json.data;
            }
        },
        columns: [
            { data: 'id', name: 'id', title: "{{ __('messages.id') }}" },
            { data: 'name', name: 'name', title: "{{ __('messages.player_name') }}" },
            { data: 'gender', name: 'gender', title: "{{ __('messages.gender') }}" },
            { data: 'birthDay', name: 'birthDay', title: "{{ __('messages.birthday') }}" },
            { data: 'phoneNumber', name: 'phoneNumber', title: "{{ __('messages.phone') }}" },
            { data: 'bills_count', name: 'bills_count', title: "{{ __('messages.Subscription_Count') }}" },
            { data: 'action', name: 'action', orderable: false, searchable: false, title: "{{ __('messages.action') }}" }
        ],
        drawCallback: function(settings) {
            const playerCount = settings.json ? settings.json.recordsTotal : tableData.length;
            $('#player-count').text(playerCount);
        }
    });

    // البحث اليدوي عند الضغط على Enter فقط
    $('.dt-search').on('keypress', function (event) {
        if (event.key === "Enter") { // البحث فقط عند الضغط على Enter
            const searchTerm = this.value.toLowerCase();
            window.renderedDataTable.clear().rows.add(
                tableData.filter(row => {
                    return [
                        row.name ?? '',
                        row.gender ?? '',
                        row.birthDay ?? '',
                        row.phoneNumber ?? '',
                        row.bills_count?.toString() ?? '',
                    ].some(field => field.toLowerCase().includes(searchTerm));
                })
            ).draw();
        }
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
</x-master-layout>
