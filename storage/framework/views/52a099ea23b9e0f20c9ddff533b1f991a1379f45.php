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
                            <h5 class="font-weight-bold"><?php echo e(__('messages.Bills')); ?></h5>
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
            
            window.renderedDataTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                dom: '<"row align-items-center"><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" l><"col-md-6" p>><"clear">',
                ajax: {
                    "type": "post",
                    "url": "<?php echo e(route('userReportDetails')); ?>",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "data": function(d) {
                        d.search = {
                            value: $('.dt-search').val()
                        };
                        d.filter = {
                            column_status: $('#column_status').val()
                        };
                        d.userId = "<?php echo e($userId); ?>";
                    },
                },
                columns: [{
                        name: 'stafName',
                        data: (data)=>{
                            return data.staf.name
                        },
                        title: "<?php echo e(__('messages.Reception_name')); ?>",
                        exportable: false,
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'payType',
                        name: 'payType',
                        title: "<?php echo e(__('messages.payment_type')); ?>"
                    },
                    {
                        data: 'date',
                        name: 'date',
                        title: "<?php echo e(__('messages.payment_time')); ?>"
                    },
                    {
                        data: 'paymrentNote',
                        name: 'paymrentNote',
                        title: "<?php echo e(__('messages.payment_note')); ?>"
                    },
                    {
                        data: (data)=> {return (data.price ?? data.amount) + (data.discountAmount ?? 0)},
                        name: 'price',
                        title: "<?php echo e(__('messages.Amount_Before_Discount')); ?>"
                    },
                    {
                        data: 'discountAmount',
                        name: 'discountAmount',
                        title: "<?php echo e(__('messages.Discount_Percentage')); ?>"
                    },
                    // {
                    //     data: 'price',
                    //     name: 'price',
                    //     title: "<?php echo e(__('messages.Discount_reason')); ?>"
                    // },
                    {
                        data: (data)=>{
                            return data.price ?? data.amount
                        },
                        name: 'price',
                        title: "<?php echo e(__('messages.Amount_After_Discount')); ?>"
                    },
                    {
                        data: (data)=>{
                            return data.user_payment?.totalAmount ?? 0
                        },
                        name: 'amount',
                        title: "<?php echo e(__('messages.Received_Amount')); ?>"
                    },
                    {
                        data: 'description',
                        name: 'description',
                        title: "<?php echo e(__('messages.Description')); ?>"
                    },
                    {
                        data: (data)=>{
                            return data.subscription?.name ?? ''
                        },
                        name: 'subscription',
                        title: "<?php echo e(__('messages.Subscription_Name')); ?>"
                    },
                    {
                        data: (data)=>{
                            return (data.isEnd == 1) ?"غير فعال":"فعال"
                        },
                        title: 'الحالة'
                    },
                ]
            });
        });

        $('#expire_date').change(function() {
            if ($('#expire_date').val()) {
                $('#quick-action-apply').prop('disabled', false);
            } else {
                $('#quick-action-apply').prop('disabled', true);
            }
            renderedDataTable.draw();
        });

        $('.dt-search').on('keyup', function() {
            renderedDataTable.draw();
        });

        if ($('#expire_date').val()) {
            $('#quick-action-apply').prop('disabled', false);
        } else {
            $('#quick-action-apply').prop('disabled', true);
        }

        $(document).on('click', '[data-ajax="true"]', function(e) {
            e.preventDefault();
            const submitUrl = $(this).data('submit');
            const form = $(this).closest('form');
            form.attr('action', submitUrl);
            form.submit();
        });
    </script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?>
<?php /**PATH /home/kmpower/public_html/resources/views/service/bill_for_palyer_report.blade.php ENDPATH**/ ?>