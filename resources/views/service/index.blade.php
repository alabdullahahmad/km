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
                            <h5 class="font-weight-bold">{{ __('messages.Bodybuilding') }}</h5>
                            @if($auth_user->can('subscription add') &&  Route::currentRouteName() !=='servicepackage.service')
                            <a href="{{ route('service.creat.id',$id) }}" class="float-right mr-1 btn btn-sm btn-primary "><i class="fa fa-plus-circle"></i> {{ __('messages.add_form_title',['form' => __('messages.Subscription')  ]) }}</a>
                            @endif
                        </div>
                        {{-- {{ $dataTable->table(['class' => 'table  w-100'],false) }} --}}
                    </div>
                </div>
            </div>
        </div>
      </div>
    <div class="card">
        <div class="card-body">
        <div class="row justify-content-between">
           
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
                url: '{{ route("Subscription", $id) }}',
                data: function (d) {
                    d.filter = {
                        column_status: $('#column_status').val()
                    };
                }
            },
            columns: [
                {
                    data: 'name',
                    name: 'name',
                    title: "{{ __('messages.name') }}"
                },
                {
                    data: 'price',
                    name: 'price',
                    title: "{{ __('messages.price') }}"
                },
                {
                    data: 'numOfDays',
                    name: 'numOfDays',
                    title: "{{ __('messages.number_day') }}"
                },
                {
                    data: 'numOfSessions',
                    name: 'numOfSessions',
                    title: "{{ __('messages.Number_sessions') }}"
                },
                {
                    data: 'price',
                    name: 'price',
                    title: "{{ __('messages.price') }}"
                },
                {
                    data: (data) => {
                        return data.tag.name;
                    },
                    name: 'tag',
                    title: "{{ __('messages.Subscription type') }}"
                },
                {
                    data: 'description',
                    name: 'description',
                    title: "{{ __('messages.description') }}"
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    title: "{{ __('messages.action') }}"
                }
            ],
        });

        // البحث اليدوي
        $('.dt-search').on('keyup', function () {
            const searchTerm = this.value.toLowerCase(); // نص البحث
            dataTable.rows().every(function () {
                const rowData = this.data(); // بيانات الصف
                const searchableFields = [
                    rowData.name ?? '',                             // الاسم
                    (rowData.price ?? '').toString(),               // السعر
                    (rowData.numOfDays ?? '').toString(),           // عدد الأيام
                    (rowData.numOfSessions ?? '').toString(),       // عدد الجلسات
                    (rowData.tag?.name ?? ''),                      // نوع الاشتراك
                    rowData.description ?? ''                       // الوصف
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</x-master-layout>
