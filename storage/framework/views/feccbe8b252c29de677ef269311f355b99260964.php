<?php if (isset($component)) { $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\MasterLayout::class, []); ?>
<?php $component->withName('master-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                            <div class="input-group">
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
                                <select name="gender_filter" id="gender_filter" class="select2 form-control" data-filter="select" style="width: auto">
                                    <option value=""><?php echo e(__('messages.gender')); ?></option>
                                    <option value="0" <?php echo e($filter['status'] == '0' ? "selected" : ''); ?>><?php echo e(__('messages.male')); ?></option>
                                    <option value="1" <?php echo e($filter['status'] == '1' ? "selected" : ''); ?>><?php echo e(__('messages.female')); ?></option>
                                </select>

                                <select name="status_filter" id="status_filter" class="select2 form-control" data-filter="select" style="width: auto">
                                    <option value=""><?php echo e(__('messages.status')); ?></option>
                                    <option value="0" <?php echo e($filter['status'] == '0' ? "selected" : ''); ?>><?php echo e(__('messages.new_player')); ?></option>
                                    <option value="1" <?php echo e($filter['status'] == '1' ? "selected" : ''); ?>><?php echo e(__('messages.old_player')); ?></option>
                                </select>
                                <button id="apply-filters" class="btn btn-primary">
                                    <?php echo e(__('messages.apply')); ?>

                                </button>
                                
                            </form>
   
                            <button id="export-excel" class="btn btn-success btn-sm ml-2"><i class="fa fa-file-excel"></i> Export to Excel</button>
                            <button id="export-pdf" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i> Export to PDF</button>
                       
                         
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
                        title: "<?php echo e(__('messages.player_name')); ?>"
                    },
                    {
                        data: 'status',
                        name: 'status',
                        title: "<?php echo e(__('messages.status')); ?>",
                        render: function(data, type, row) {
                            const createdAt = new Date(row.created_at);
                            const now = new Date();
                            const oneMonthAgo = new Date();
                            oneMonthAgo.setMonth(now.getMonth() - 1);

                            return createdAt >= oneMonthAgo ? '<?php echo e(__('messages.new_player')); ?>' : '<?php echo e(__('messages.old_player')); ?>';
                        }
                    }
                ],
                drawCallback: function(settings) {
                    const playerCount = settings.json.recordsTotal || 0;
                    $('#player-count').text(playerCount);
                }
            });

            $('#export-excel').on('click', function() {
                const wb = XLSX.utils.table_to_book(document.getElementById('datatable'), {sheet: "Sheet JS"});
                XLSX.writeFile(wb, 'Report.xlsx');
            });

            $('#export-pdf').on('click', function() {
                const element = document.getElementById('datatable');
                html2pdf(element, {
                    margin: 1,
                    filename: 'Report.pdf',
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                });
            });
        });

        $('#apply-date-filter').click(function (e) {
            e.preventDefault();

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

            window.renderedDataTable.ajax.reload();
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?>
<?php /**PATH C:\Users\USER\Desktop\km\resources\views/bookingrating/index.blade.php ENDPATH**/ ?>