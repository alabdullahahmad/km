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
                            <h5 class="font-weight-bold"><?php echo e(__('messages.Report_player')); ?></h5>
                            <div class="d-flex justify-content-center align-items-center gap-3 mx-auto">
                                <span class="value-label font-weight-bold"><?php echo e(__('messages.num_player')); ?></span>
                               <span class="value-amount font-weight-bold" id="player-count">0</span>


                            </div>
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
                <form  id="date-filter-form" class="form-disabled d-flex gap-3 align-items-center">
                    <?php echo csrf_field(); ?>
                    <div class="input-group" >
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                        <input type="text" class="form-control datepicker" id="startDate" name="startDate" placeholder="<?php echo e(__('messages.Select_Start_Date')); ?>">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                        <input type="text" class="form-control datepicker" id="endDate" name="endDate" placeholder="<?php echo e(__('messages.Select_End_Date')); ?>">
                    </div>
                    <button id="apply-date-filter" class="btn btn-primary">
                        <?php echo e(__('messages.apply')); ?>

                    </button>
                </form>
                <div class="d-flex align-items-center gap-3 mt-3">
                    <form id="filter-form" class="form-disabled d-flex gap-3 align-items-center">
                    <select name="gender_filter" id="gender_filter" class="select2 form-control" data-filter="select" style="width: 100%">
                        <option value=""><?php echo e(__('messages.gender')); ?></option>
                        <option value="0" <?php echo e($filter['status'] == '0' ? "selected" : ''); ?>><?php echo e(__('messages.male')); ?></option>
                        <option value="1" <?php echo e($filter['status'] == '1' ? "selected" : ''); ?>><?php echo e(__('messages.female')); ?></option>
                    </select>

                    <!-- عنصر select بجانب حقل البحث -->
                    <select name="status_filter" id="status_filter" class="select2 form-control" data-filter="select" style="width: 100%">
                        <option value=""><?php echo e(__('messages.status')); ?></option>
                        <option value="0" <?php echo e($filter['status'] == '0' ? "selected" : ''); ?>><?php echo e(__('messages.inactive')); ?></option>
                        <option value="1" <?php echo e($filter['status'] == '1' ? "selected" : ''); ?>><?php echo e(__('messages.active')); ?></option>
                    </select>
                    <button id="apply-filters" class="btn btn-primary">
                        <?php echo e(__('messages.apply')); ?>

                    </button>
                </form>
                </div>

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

    window.renderedDataTable = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        dom: '<"row align-items-center"><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" l><"col-md-6" p>><"clear">',
        ajax: {
            "type": "post",
            "url": '<?php echo e(route("userReport")); ?>',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "data": function(d) {
                d.search = {
                    value: $('.dt-search').val()
                };
                d.filter = {
                    gender: $('#gender_filter').val(),
                    status: $('#status_filter').val(),
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val()
                }
                d.startDate = $('#startDate').val();
                d.endDate = $('#endDate').val();
            },
        },
        columns: [
            {
                data: 'name',
                name: 'name',
                title: "<?php echo e(('messages.player_name')); ?>"
            },
            {
                data: 'gender',
                name: 'gender',
                title: "<?php echo e(('messages.gender')); ?>"
            },
            {
                data: 'birthDay',
                name: 'birthDay',
                title: "<?php echo e(('messages.birthday')); ?>"
            },
            {
                data: 'phoneNumber',
                name: 'phoneNumber',
                title: "<?php echo e(('messages.phone')); ?>"
            },
            {
                data: 'bills_count',
                name: 'bills_count',
                title: "<?php echo e(('messages.Subscription_Count')); ?>"
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                title: "<?php echo e(('messages.action')); ?>"
            }
        ],
        drawCallback: function(settings) {
            const playerCount = settings.json.recordsTotal || 0; 
            $('#player-count').text(playerCount); 
        }
    });
});
// سكربت لتطبيق فلترة التواريخ
$('#apply-date-filter').click(function (e) {
    e.preventDefault();
   
    // التحقق من تعبئة كلا الخانتين
    const startDate = $('#startDate').val();
    const endDate = $('#endDate').val();
   
    if (!startDate || !endDate) {
        Swal.fire({
            icon: 'warning',
            title: '<?php echo e(__("messages.warning")); ?>',
            text: '<?php echo e(__("messages.fill_both_dates")); ?>',
        });
        return;
    }
   
    // إعادة تحميل الجدول
    window.renderedDataTable.ajax.reload();
});

    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?>
<?php /**PATH C:\Users\HP\OneDrive\سطح المكتب\km\resources\views/bookingrating/index.blade.php ENDPATH**/ ?>