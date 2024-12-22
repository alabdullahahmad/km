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
                          <h5 class="font-weight-bold">{{ __('messages.Cash_archive') }}</h5>

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
                          <div class="input-group ml-2">
                              <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                              <input type="text" class="form-control datepicker" id="expire_date" name="expire_date" placeholder= {{__('messages.Select_Date')}}>
                          </div>
                          <button id="quick-action-apply" class="btn btn-primary" data-ajax="true" data--submit="{{ route('user.bulk-action') }}" data-datatable="reload" title="{{ __('user',['form'=>  __('user') ]) }}">
                              {{__('messages.apply')}}
                          </button>
                      </form>
                  </div>
              </div>
              <div class="d-flex justify-content-end">
                  <div class="input-group ml-2">
                      <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                      <input type="text" class="form-control dt-search" placeholder={{__('messages.search')}} aria-label="Search" aria-describedby="addon-wrapping" aria-controls="dataTableBuilder">
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
        // إعداد الـ DataTable ليعرض البيانات بشكل عام أولاً
        const dataTable = $('#datatable').DataTable({
            processing: true,
            serverSide: false, // تعطيل البحث Server-side
            autoWidth: false,
            responsive: true,
            dom: '<"row align-items-center"><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" l><"col-md-6" p>><"clear">',
            ajax: {
                type: "GET",
                url: '{{ route("fundLogStaf") }}',  // جلب البيانات بدون أي فلتر زمني في البداية
            },
            columns: [
                {
                    name: 'display_name',
                    data: (data) => {
                        return data.staf.name;
                    },
                    title: "{{ __('messages.name') }}"
                },
                {
                    data: 'date',
                    name: 'date',
                    title: "{{ __('messages.date') }}"
                },
                {
                    data: (data) => {
                        return data.staf.phoneNumber;
                    },
                    name: 'contact_number',
                    title: "{{ __('messages.phone') }}"
                },
                {
                    data: 'amount',
                    name: 'amount',
                    title: "{{ __('messages.amount_due') }}"
                },
            ]
        });

        // فلترة البيانات عند كتابة نص في حقل البحث
        $('.dt-search').on('keyup', function () {
            const searchTerm = this.value.toLowerCase(); // نص البحث
            dataTable.rows().every(function () {
                const rowData = this.data(); // بيانات الصف
                const searchableFields = [
                    rowData.staf.name ?? '',             // الاسم
                    rowData.staf.phoneNumber ?? '',      // رقم الهاتف
                    rowData.amount ?? '',                // المبلغ
                    rowData.date ?? ''                   // التاريخ
                ];

                // التحقق من وجود النص المدخل في أي من الحقول
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

        // عند تغيير تاريخ الفلترة، يتم تمكين زر التطبيق
        $('#expire_date').change(function () {
            // إذا كان هناك تاريخ تم تحديده، نفعّل الزر
            if ($('#expire_date').val()) {
                $('#quick-action-apply').prop('disabled', false);  // تمكين الزر
            } else {
                $('#quick-action-apply').prop('disabled', true);  // تعطيل الزر إذا لم يتم تحديد تاريخ
            }
            // تحديث الجدول بناءً على الفلترة
            dataTable.draw();
        });

        // التحقق من حالة زر التطبيق عند تحميل الصفحة
        if ($('#expire_date').val()) {
            $('#quick-action-apply').prop('disabled', false);  // تمكين الزر إذا تم تحديد تاريخ
        } else {
            $('#quick-action-apply').prop('disabled', true);  // تعطيل الزر في حال عدم تحديد تاريخ
        }
    });

    $(document).on('click', '[data-ajax="true"]', function (e) {
        e.preventDefault();
        // الآن عند الضغط على الزر سيتم إرسال النموذج مباشرة دون التأكيد
        const submitUrl = $(this).data('submit');
        const form = $(this).closest('form');
        form.attr('action', submitUrl);
        form.submit();
    });
</script>

  <!-- تم إزالة أي سكربت خاص بـ sweetalert2 هنا -->
</x-master-layout>
