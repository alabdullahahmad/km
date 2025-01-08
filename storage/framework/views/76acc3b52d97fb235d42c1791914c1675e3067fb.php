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
                            <h5 class="font-weight-bold"><?php echo e(__('messages.Bodybuilding')); ?></h5>
                            <?php if($auth_user->can('subscription add') &&  Route::currentRouteName() !=='servicepackage.service'): ?>
                            <a href="<?php echo e(route('service.creat.id',$id)); ?>" class="float-right mr-1 btn btn-sm btn-primary "><i class="fa fa-plus-circle"></i> <?php echo e(__('messages.add_form_title',['form' => __('messages.Subscription')  ])); ?></a>
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
                url: '<?php echo e(route("Subscription", $id)); ?>',
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
                    title: "<?php echo e(__('messages.name')); ?>"
                },
                {
                    data: 'price',
                    name: 'price',
                    title: "<?php echo e(__('messages.price')); ?>"
                },
                {
                    data: 'numOfDays',
                    name: 'numOfDays',
                    title: "<?php echo e(__('messages.number_day')); ?>"
                },
                {
                    data: 'numOfSessions',
                    name: 'numOfSessions',
                    title: "<?php echo e(__('messages.Number_sessions')); ?>"
                },
                {
                    data: 'price',
                    name: 'price',
                    title: "<?php echo e(__('messages.price')); ?>"
                },
                {
                    data: (data) => {
                        return data.tag.name;
                    },
                    name: 'tag',
                    title: "<?php echo e(__('messages.Subscription type')); ?>"
                },
                {
                    data: 'description',
                    name: 'description',
                    title: "<?php echo e(__('messages.description')); ?>"
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    title: "<?php echo e(__('messages.action')); ?>"
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?>
<?php /**PATH C:\Users\USER\Desktop\km\resources\views/service/index.blade.php ENDPATH**/ ?>