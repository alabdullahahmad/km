<?php if (isset($component)) { $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\MasterLayout::class, []); ?>
<?php $component->withName('master-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
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
                          <h5 class="font-weight-bold"><?php echo e(__('messages.Receptions')); ?></h5>
                          <?php if($list_status != 'pending'): ?>
                          <?php if($auth_user->can('receptions add')): ?>
                          <a href="<?php echo e(route('provider.create')); ?>" class="float-right mr-1 btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> <?php echo e(__('messages.add_form_title',['form' => __('messages.Receptions')  ])); ?></a>
                          <?php endif; ?>
                          <?php endif; ?>
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
                <form action="<?php echo e(route('provider.bulk-action')); ?>" id="quick-action-form" class="form-disabled d-flex gap-3 align-items-center">
                  <?php echo csrf_field(); ?>



          </div>

          </form>
        </div>
            <div class="d-flex justify-content-end">
              
              <div class="input-group ml-2">
                  <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                  <input type="text" class="form-control dt-search" placeholder="<?php echo e(__('messages.search')); ?>" aria-label="Search" aria-describedby="addon-wrapping" aria-controls="dataTableBuilder">
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
                url: '<?php echo e(route("Staf")); ?>',
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
                    title: "<?php echo e(__('messages.name')); ?>"
                },
                {
                    data: 'gender',
                    name: 'gender',
                    title: "<?php echo e(__('messages.gender')); ?>"
                },
                {
                    data: 'birthDay',
                    name: 'providertype_id',
                    title: "<?php echo e(__('messages.birthday')); ?>"
                },
                {
                    data: 'phoneNumber',
                    name: 'contact_number',
                    title: "<?php echo e(__('messages.phone')); ?>"
                },
                {
                    data: 'isAdmin',
                    name: 'isAdmin',
                    title: "<?php echo e(__('messages.isAdmin')); ?>",
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
                    title: "<?php echo e(__('messages.action')); ?>"
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
      url: "<?php echo e(route('changeStafStatus')); ?>", // المسار المناسب في الـ Backend
      method: 'POST',
      data: {
          stafId: stafId,
          isAdmin: isAdmin,
          _token: '<?php echo e(csrf_token()); ?>' // إرسال CSRF Token
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?>
<?php /**PATH C:\Users\USER\Desktop\km\resources\views/provider/index.blade.php ENDPATH**/ ?>