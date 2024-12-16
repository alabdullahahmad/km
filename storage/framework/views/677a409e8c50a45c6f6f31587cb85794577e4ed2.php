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
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold"><?php echo e(__('messages.Report_classes')); ?></h5>
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
                          <form id="date-filter-form" class="form-disabled d-flex gap-3 align-items-center">
                            <div class="input-group" >
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="text" class="form-control datepicker" id="start_date" name="start_date" placeholder="<?php echo e(__('messages.Select_Start_Date')); ?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="text" class="form-control datepicker" id="end_date" name="end_date" placeholder="<?php echo e(__('messages.Select_End_Date')); ?>">
                            </div>
                            <button id="apply-date-filter" class="btn btn-primary">
                                <?php echo e(__('messages.apply')); ?>

                            </button>
                    </div>
                  
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
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {

        window.renderedDataTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                dom: '<"row align-items-center"><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" l><"col-md-6" p>><"clear">',
                ajax: {
                  "type"   : "post",
                  "url"    : '<?php echo e(route("classReport")); ?>',
                  headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                  "data"   : function( d ) {
                    d.search = {
                      value: $('.dt-search').val()
                    };
                    d.filter = {
                        start_date: $('#start_date').val(),
                        end_date: $('#end_date').val(),
                    }
                  },
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
                            return data.coach.name
                        },
                        name: 'coachName',
                        title: "<?php echo e(__('messages.coash_name')); ?>",
                         orderable: false,
                    },
                    {
                        data: (data)=>{
                            return data.subscription.name
                        },
                        name: 'subscriptionNamw',
                        title: "<?php echo e(__('messages.player_name')); ?>"
                    },
                    {
                        data: 'total',
                        name: 'total',
                        title: "<?php echo e(__('messages.Total')); ?>"
                    },
                    {
                        data: 'totalPercentage',
                        name: 'totalPercentage',
                        title: "<?php echo e(__('messages.Coach_Percentage_Total')); ?>"
                    },
                
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        title: "<?php echo e(__('messages.action')); ?>",
                    }
                    
                ]
                
            });
      });

            // سكربت لتطبيق فلترة التواريخ
            $('#apply-date-filter').click(function (e) {
            e.preventDefault();
            
            // التحقق من تعبئة كلا الخانتين
            const startDate = $('#start_date').val();
            const endDate = $('#end_date').val();
            
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
<?php endif; ?><?php /**PATH /home/kmpower/public_html/resources/views/payment/index.blade.php ENDPATH**/ ?>