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
                          <h5 class="font-weight-bold">{{ __('messages.Receptions') }}</h5>
                          @if($list_status != 'pending')
                          @if($auth_user->can('provider add'))
                          <a href="{{ route('provider.create') }}" class="float-right mr-1 btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> {{ __('messages.add_form_title',['form' => __('messages.Receptions')  ]) }}</a>
                          @endif
                          @endif
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
                <form action="{{ route('provider.bulk-action') }}" id="quick-action-form" class="form-disabled d-flex gap-3 align-items-center">
                  @csrf
               

              
              <a id="quick-action-apply" class="btn btn-primary" 
                  href="{{ route('ExportExcel') }}">{{ __('messages.Export Excel') }}</a>
          </div>

          </form>
        </div>
            <div class="d-flex justify-content-end">
              {{-- <div class="datatable-filter ml-auto">
                <select name="column_status" id="column_status" class="select2 form-control" data-filter="select" style="width: 100%">
                  <option value="">{{ __('messages.all') }}</option>
                  <option value="0" {{$filter['status'] == '0' ? "selected" : ''}}>{{ __('messages.inactive') }}</option>
                  <option value="1" {{$filter['status'] == '1' ? "selected" : ''}}>{{ __('messages.active') }}</option>
                </select>
              </div> --}}
              <div class="input-group ml-2">
                  <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                  <input type="text" class="form-control dt-search" placeholder="{{ __('messages.search') }}" aria-label="Search" aria-describedby="addon-wrapping" aria-controls="dataTableBuilder">
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
        // إنشاء جدول DataTable
        const dataTable = $('#datatable').DataTable({
            processing: true,
            serverSide: false, // البحث Client-side فقط
            autoWidth: false,
            responsive: true,
            dom: '<"row align-items-center"><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" l><"col-md-6" p>><"clear">',
            ajax: {
                type: "GET",
                url: '{{ route("Staf") }}',
                data: function (d) {
                    d.filter = {
                        column_status: $('#column_status').val()
                    };
                }
            },
            columns: [
                {
                    data: 'name',
                    name: 'display_name',
                    title: "{{ __('messages.name') }}"
                },
                {
                    data: 'gender',
                    name: 'gender',
                    title: "{{ __('messages.gender') }}"
                },
                {
                    data: 'birthDay',
                    name: 'providertype_id',
                    title: "{{ __('messages.birthday') }}"
                },
                {
                    data: 'phoneNumber',
                    name: 'contact_number',
                    title: "{{ __('messages.phone') }}"
                },
                {
                    data: 'isAdmin',
                    name: 'isAdmin',
                    title: "{{ __('messages.isAdmin') }}",
                    render: function (data, type, row) {
                        return `
                            <div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
                                <div class="custom-switch-inner">
                                    <input type="checkbox" 
                                           class="custom-control-input change_status" 
                                           data-type="isAdmin" 
                                           value="${row.id}" 
                                           data-id="${row.id}" 
                                           ${data == 1 ? 'checked' : ''} 
                                           id="switch-${row.id}" 
                                           onchange="handleIsAdminChange(this)">
                                    <label class="custom-control-label" 
                                           for="switch-${row.id}" 
                                           data-on-label="" 
                                           data-off-label="">
                                    </label>
                                </div>
                            </div>`;
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    title: "{{ __('messages.action') }}"
                }
            ]
        });

        // البحث اليدوي
        $('.dt-search').on('keyup', function () {
            const searchTerm = this.value.toLowerCase(); // نص البحث
            dataTable.rows().every(function () {
                const rowData = this.data(); // بيانات الصف
                const searchableFields = [
                    rowData.name ?? '',                     // الاسم
                    rowData.gender ?? '',                   // الجنس
                    rowData.birthDay ?? '',                 // تاريخ الميلاد
                    rowData.phoneNumber ?? '',              // رقم الهاتف
                    (rowData.isAdmin === 1 ? 'admin' : 'user') // حالة المسؤولية (افتراضية)
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
///////////////////////////
function handleIsAdminChange(switchElement) {
  const stafId = $(switchElement).data('id');
  const isAdmin = $(switchElement).is(':checked') ? 1 : 0; // 1 إذا كان Checked، 0 إذا Unchecked

  $.ajax({
      url: '/update-admin-status', // المسار المناسب في الـ Backend
      method: 'POST',
      data: {
          stafid: stafId,
          isAdmin: isAdmin,
          _token: '{{ csrf_token() }}' // إرسال CSRF Token
      },
      success: function(response) {
          console.log('تم تحديث حالة المستخدم:', response.message);
      },
      error: function(xhr) {
          console.error('فشل تحديث الحالة:', xhr.responseText);
          // إعادة الحالة إذا فشل التحديث
          $(switchElement).prop('checked', !isAdmin);
      }
  });
}





















    ///////////////////////
  function resetQuickAction () {
  const actionValue = $('#quick-action-type').val();
  console.log(actionValue)
  if (actionValue != '') {
      // $('#quick-action-apply').removeAttr('disabled');

      if (actionValue == 'change-status') {
          $('.quick-action-field').addClass('d-none');
          $('#change-status-action').removeClass('d-none');
      } else {
          $('.quick-action-field').addClass('d-none');
      }
  } else {
      // $('#quick-action-apply').attr('disabled', true);
      $('.quick-action-field').addClass('d-none');
  }
}

$('#quick-action-type').change(function () {
  resetQuickAction()
});

$(document).on('update_quick_action', function() {

})

  $(document).on('click', '[data-ajax="true"]', function (e) {
    e.preventDefault();
    const button = $(this);
    const confirmation = button.data('confirmation');

    if (confirmation === 'true') {
        const message = button.data('message');
        if (confirm(message)) {
            const submitUrl = button.data('submit');
            const form = button.closest('form');
            form.attr('action', submitUrl);
            form.submit();
        }
    } else {
        const submitUrl = button.data('submit');
        const form = button.closest('form');
        form.attr('action', submitUrl);
        form.submit();
    }
});

  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</x-master-layout>