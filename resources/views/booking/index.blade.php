        <x-master-layout>

    <head>
        <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    </head>
      @if(!Auth::user()->isAdmin)

      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ __('messages.home') }}</h5>
                            <form action="{{ route('addFundLog') }}" method="post">
                                @csrf
                                @method('post')
                                <div class="d-flex justify-content-center align-items-center gap-3 mx-auto">
                                    <div class="d-flex align-items-center gap-3">
                                        <label for="amountInput"  style="margin:unset"
                                            class="value-label font-weight-bold">{{ __('messages.Box_Value:') }}</label>
                                        <input readonly id="amountInput" class="value-amount font-weight-bold"
                                            style="border: 0px;padding-bottom: 0px; width: fit-content" name="amount"
                                            value="{{ App\Models\fund::where([ 'branchId' => auth()->user()->branchId])->first()->amount }}">
                                        <button class="btn btn-success btn-deliver-box">{{ __('messages.Deliver_Box') }}</button>
                                    </div>
                                </div>
                            </form>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between">

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
                        <input type="text" class="form-control dt-search" placeholder="{{ __('messages.search') }}"
                            aria-label="Search" aria-describedby="addon-wrapping" aria-controls="dataTableBuilder">
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped border">

                    </table>
                </div>
            </div>
        </div>
    </div>

    @if(!Auth::user()->isAdmin)
    <div class="toolbar-buttons" dir="ltr">
        <button id="demoBtn"><span>{{ __('messages.login') }}</span></button>
        <button id="helpBtn"><span>{{ __('messages.e_Subscription') }}</span></button>

    </div>



{{-- 
    <div id="demoSidebar" class="sidebar" dir="ltr">
        <button class="close-btn" onclick="closeSidebar()">×</button>
        <h3 style=" margin-bottom: 10px;"><i class="fas fa-clock icon-style"></i>{{ __('messages.last_login') }}</h3>

    </div> --}}
    <div id="demoSidebar" class="sidebar" dir="ltr">
        <button class="close-btn" onclick="closeSidebar()">×</button>
        <h3 style="margin-bottom: 10px;"><i class="fas fa-clock icon-style"></i>{{ __('messages.last_login') }}</h3>
      
        <!-- حاوية الكروت -->
        <div class="card subscription-card"></div>
        <ul id="log-container" style="list-style: none; padding: 0;"></ul>
       
      </div>
   

    <div id="helpSidebar" class="sidebar " dir="ltr">
        <!-- Header -->
        <div class="sidebar-header">
            <button class="close-btn" onclick="closeSidebar()">×</button>
            <h3><i class="fas fa-hourglass-end icon-style"></i>{{ __('messages.Subscriptions') }}</h3>
        </div>

        <!-- Card داخل الـ Sidebar -->
       <div class="card subscription-card"></div>
    </div>
     @endif
    
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
        // إنشاء جدول DataTable
        const dataTable = $('#datatable').DataTable({
            processing: true,
            serverSide: false, // Client-side فقط
            autoWidth: false,
            responsive: true,
            order: false,
            columnDefs: [{
                    targets: '_all',
                    className: 'text-wrap',
                    width: '20%'
                }],
            ajax: {
                type: "get",
                url: '{{ route("showBill") }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (d) {
                    d.filter = {
                        gender: $('#gender_filter').val(),
                        status: $('#status_filter').val(),
                        start_date: $('#start_date').val(),
                        end_date: $('#end_date').val()
                    };
                }
            },
            dom: '<"row align-items-center"><"table-responsive my-4" rt><"row align-items-center"<"col-md-6" l><"col-md-6" p>><"clear">',
            columns: [
                {
                    data: (data) => data.user.name ?? '', // التحقق من وجود الاسم
                    title: "{{ __('messages.name') }}"
                },
                @if(Auth::user()->hasRole('admin'))
                {
                
                    data: (data)=>data.branch.name,
                    name: 'branchName',
                    title: "{{ __('messages.branchName') }}"
                },
                @endif
                {
                    data: 'startDate',
                    title: "{{ __('messages.subscription_start') }}"
                },
                {
                    data: 'endDate',
                    title: "{{ __('messages.subscription_end') }}"
                },
                {
                    data: (data) => data.subscription.name ?? '', // اسم الاشتراك
                    title: "{{ __('messages.Subscription_Name') }}"
                },
                {
                    data: (data) => (data.isEnd == 1) ? "{{ __('messages.inactive') }}" : "{{ __('messages.active') }}" , // حالة الاشتراك
                     title: "{{ __('messages.status') }}"
                },
                {
                    data: (data) => data.subscription.numOfSessions ?? 0, // عدد الجلسات
                    title: "{{ __('messages.Number_sessions') }}"
                },
                {
                    data: (data) => data.subscription.numOfDays ?? 0, // عدد الأيام
                    title: "{{ __('messages.number_day') }}"
                },
                {
                    data: 'action',
                    title: "{{ __('messages.action') }}"
                },
            ],
        });

        // تنفيذ البحث اليدوي (Client-side)
        $('.dt-search').on('keyup', function () {
            const searchTerm = this.value.toLowerCase(); // الحصول على نص البحث
            dataTable.rows().every(function () {
                const rowData = this.data(); // بيانات الصف
                const searchableFields = [
                    rowData.user?.name ?? '',                    // الاسم
                    rowData.startDate ?? '',                     // بداية الاشتراك
                    rowData.endDate ?? '',                       // نهاية الاشتراك
                    rowData.subscription?.name ?? '',            // اسم الاشتراك
                    (rowData.isEnd == 1 ? "غير فعال" : "فعال"),  // حالة الاشتراك
                    (rowData.subscription?.numOfSessions ?? 0).toString(), // عدد الجلسات
                    (rowData.subscription?.numOfDays ?? 0).toString()       // عدد الأيام
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
        // دالة لتحديث قائمة الإجراءات السريعة
        function resetQuickAction() {
            const actionValue = $('#quick-action-type').val();
            if (actionValue != '') {
                $('#quick-action-apply').removeAttr('disabled');

                if (actionValue == 'change-status') {
                    $('.quick-action-field').addClass('d-none');
                    $('#change-status-action').removeClass('d-none');
                } else {
                    $('.quick-action-field').addClass('d-none');
                }
            } else {
                $('#quick-action-apply').attr('disabled', true);
                $('.quick-action-field').addClass('d-none');
            }
        }

        // مراقبة تغيير في قائمة الإجراءات السريعة
        $('#quick-action-type').change(function() {
            resetQuickAction();
        });

        // تنفيذ إجراء عند تحديث الإجراءات السريعة
        $(document).on('update_quick_action', function() {
            resetQuickAction();
        });

        // التحكم في الأزرار التي تحتوي على data-ajax
        $(document).on('click', '[data-ajax="true"]', function(e) {
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
        $(document).ready(function() {
            // تحديد لغة الصفحة الحالية من خاصية lang
            const currentLang = $('html').attr('lang');

            // إذا كانت اللغة عربية، غيّر اتجاه الأزرار إلى RTL
            if (currentLang === 'ar') {
                $('.toolbar-buttons').attr('dir', 'rtl');
            } else {
                $('.toolbar-buttons').attr('dir', 'ltr');
            }
        });
    </script>
<script>
  // الاتصال بخادم Node.js
const socket = io('http://localhost:3003');


// استقبال البيانات من خادم Node.js
socket.on('connect',()=>{
    console.log("ahmad2")
   
});
socket.on('checkInUser-{{ auth()->user()->branchId }}', function (data) {
  console.log('Data received:', data);

  const logContainer = document.getElementById('log-container');


  const responseData = data; 
  const userData = responseData.data.user;
  const billData = responseData.data.bill;

  const userName = userData ? userData.name : 'Unknown';
  const loginDate = userData ? userData.loginDate : 'N/A';
//   const subscriptionName =  billData && billData.subscription.name ? billData.subscription.name : '⭐';
  const status = userData.status ?? false;

  console.log(status)
  const cardColor = status =="1" ? '#ff293d' : '';
  const messages = {
        date: "{{ __('messages.Date') }}",
        Subscription: "{{ __('messages.Subscription') }}"
    };
  logContainer.innerHTML += `
    <li>
      <div class="card login-card" style="margin-bottom: 10px; background-color: ${cardColor};">
        <div class="card-body">
          <h5 class="card-title">${userName}</h5>
          <p class="card-text">
          <strong> ${messages.date} : </strong> <span dir="ltr">${loginDate}</span>

          </p>
        </div>
      </div>
    </li>`;
  
  $('#demoSidebar').addClass('active');

  const helpSidebar = document.getElementById('helpSidebar');

  billData.forEach((bill, index) => {
  const subscription = bill.subscription;
  
  if (subscription && subscription.name) {
    const subscriptionName = subscription.name || '⭐';
    const subscriptionCardColor = bill.status === 1 ? '#ff293d' : '';
    
    const isSelectable = billData.length > 1;
    
    helpSidebar.innerHTML += `
      <div class="card subscription-card" style="margin-bottom: 10px; background-color: ${subscriptionCardColor}; cursor: ${isSelectable ? 'pointer' : 'default'};"
        data-name="${subscriptionName}" data-user-id="${userData.id}" data-bill-id="${bill.id}">
        <div class="card-body">
          <h5 class="card-title">${userName}</h5>
          <p class="card-text">
             <strong>${messages.Subscription} : </strong> ${subscriptionName}
          </p>
        </div>
      </div>`;
  }
});
let selectedUserId = null; // متغير لتتبع المستخدم الذي اختار بطاقة

if (billData.length > 1) {
  document.querySelectorAll('.subscription-card').forEach(card => {
    card.addEventListener('click', function () {
      const userId = this.getAttribute('data-user-id');

      // تحقق مما إذا كان المستخدم قد اختار بطاقة مسبقًا
      if (selectedUserId && selectedUserId === userId) {
        alert("لا يمكنك اختيار بطاقة أخرى بعد تحديد بطاقة بالفعل.");
        return;
      }

      // إزالة التحديد السابق (إن وجد)
      document.querySelectorAll('.subscription-card').forEach(c => c.style.border = '');
      this.style.border = '2px solid blue';

      const name = this.getAttribute('data-name');
      const billId = this.getAttribute('data-bill-id');

      // تعيين userId بعد الاختيار الأول
      selectedUserId = userId;

      recordEntry(name, userId, billId);
    });
  });
}

function recordEntry(name, userId, billId) {
  $.ajax({
    url: "{{ route('addPlayerLoginLog') }}",
    method: "POST",
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    contentType: "application/json",
    data: JSON.stringify({ subscription_name: name, user_id: userId, billId: billId }),
    success: function (data) {
      console.log(data);
      
      if (data.data.success) {
        alert('تم دخول اللاعب بنجاح');
      } else {
        alert('حدث خطأ أثناء تسجيل الدخول');
      }
    },
    error: function (xhr) {
      try {
        var response = JSON.parse(xhr.responseText);
        alert(response.message);
      } catch (e) {
        alert("خطأ غير متوقع.");
      }
    }
  });
}

});


  </script>
  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</x-master-layout>

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

<style>
    .card.login-card .card-body {
        padding: 15px;
    }

    .card.login-card .card-title {
        font-size: 16px;
        font-weight: bold;
        color: #5F60B9;
    }

    .card.login-card .card-text {
        font-size: 14px;
        color: #333;
        margin-top: 10px;
    }
    .card.subscription-card .card-body {
        padding: 15px;
    }

    .card.subscription-card .card-title {
        font-size: 16px;
        font-weight: bold;
        color: #5F60B9;
    }

    .card.subscription-card .card-text {
        font-size: 14px;
        color: #333;
        margin-top: 10px;
    }

    .sidebar h3 {
        font-size: 18px;
        /* حجم الخط */
        font-weight: bold;
        /* جعل النص سميكًا */
        color: #5F60B9;
        /* لون النص */
        text-align: center;
        /* محاذاة النص في الوسط */
        margin-bottom: 20px;
        /* مسافة تحت العنوان */
        padding: 10px;
        /* مسافة داخلية */
        background: #f1f1f1;
        /* خلفية العنوان */
        border-radius: 8px;
        /* زوايا مستديرة */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* إضافة ظل للعناصر */
    }

    .icon-style {
        font-size: 20px;
        /* حجم الأيقونة */
        vertical-align: middle;
        /* محاذاة الأيقونة عموديًا مع النص */
        padding: 10px;

    }

    .toolbar-buttons {
        position: fixed;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1000;
    }

    /* الاتجاه الافتراضي (للإنجليزية) */
    .toolbar-buttons[dir="ltr"] {
        right: 0;
    }

    /* الاتجاه عند العربية */
    .toolbar-buttons[dir="rtl"] {
        left: 0;
        right: auto;
    }

    .toolbar-buttons button {
        display: flex;
        /* لجعل العناصر داخل الزر مرنة */
        justify-content: center;
        /* لجعل النص في منتصف الزر أفقياً */
        align-items: center;
        /* لجعل النص في منتصف الزر عمودياً */
        margin: 5px 0;
        padding: 10px 0;
        width: 40px;
        height: 125px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        writing-mode: vertical-rl;
        /* الكتابة بالطول */
        text-orientation: upright;
        /* الحفاظ على الأحرف مستقيمة */
        font-size: 14px;
        text-align: center;

    }

    .toolbar-buttons button span {
        font-family: 'Courier New', Courier, monospace;
        display: inline-block;
        transform: rotate(90deg);
        /* تدوير النص 90 درجة */
        transform-origin: center center;
        /* تحديد مركز التدوير */
        font-size: 16px;
        font-weight: bold;
        writing-mode: initial;
        /* إلغاء الكتابة بالطول */
        text-orientation: initial;
        /* إلغاء الاتجاه الرأسي */
    }



    .toolbar-buttons button:hover {
        background-color: #5F60B9;
    }

    .sidebar {
        position: fixed;
        top: 0;
        right: -300px;
        width: 300px;
        height: 100%;
        background: #fff;
        border-left: 1px solid #ddd;
        box-shadow: -5px 0 15px rgba(0, 0, 0, 0.2);
        padding: 20px;
        transition: right 0.3s ease-in-out;
        z-index: 1100;
        max-height: 100%; 
        overflow-y: auto;

    }

    .sidebar.active {
        right: 0;
    }

    .sidebar .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 50%;
        font-size: 20px;
        cursor: pointer;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    /* الاتجاه الافتراضي (للإنجليزية) */
    .sidebar[dir="ltr"] {
        right: -300px;
        left: auto;
    }

    /* الاتجاه عند العربية */
    .sidebar[dir="rtl"] {
        left: -300px;
        right: auto;
    }

    .sidebar[dir="ltr"].active {
        right: 0;
        left: auto;
    }

    .sidebar[dir="rtl"].active {
        left: 0;
        right: auto;
    }

    /* الاتجاه الافتراضي (للإنجليزية) */
    .sidebar[dir="ltr"] .close-btn {
        right: 10px;
        left: auto;
    }

    /* الاتجاه عند العربية */
    .sidebar[dir="rtl"] .close-btn {
        left: 10px;
        right: auto;
    }
    
</style>
<script>
    function closeSidebar() {
        $('.sidebar').removeClass('active');
    }

    $(document).ready(function() {
        // تحديد لغة الصفحة الحالية من خاصية lang
        const currentLang = $('html').attr('lang');

        // تحديد الاتجاه بناءً على اللغة
        const direction = currentLang === 'ar' ? 'rtl' : 'ltr';

        // تعيين الاتجاه للـ sidebar
        $('.sidebar').attr('dir', direction);

        // تفعيل الـ Demo Sidebar
        $('#demoBtn').click(function() {
            closeSidebar(); // إغلاق أي Sidebar مفتوح
            $('#demoSidebar').addClass('active');
        });

        // تفعيل الـ Help Sidebar
        $('#helpBtn').click(function() {
            closeSidebar(); // إغلاق أي Sidebar مفتوح
            $('#helpSidebar').addClass('active');
        });
    });
</script>
