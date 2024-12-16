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
                            <h5 class="font-weight-bold"><?php echo e(__('messages.Report_Bills')); ?></h5>
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
                    <form action="<?php echo e(route('user.bulk-action')); ?>" id="quick-action-form"
                        class="form-disabled d-flex gap-3 align-items-center">
                        <?php echo csrf_field(); ?>
                        <div class="input-group ml-2">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            <input type="text" class="form-control datepicker" id="expire_date" name="expire_date"
                                placeholder="<?php echo e(__('messages.Select_Date')); ?>">
                        </div>
                        <div class="input-group ml-2">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            <input type="text" class="form-control datepicker" id="expire_date" name="expire_date"
                                placeholder="<?php echo e(__('messages.Select_Date')); ?>">
                        </div>
                        <button id="quick-action-apply" class="btn btn-primary" data-ajax="true"
                            data--submit="<?php echo e(route('user.bulk-action')); ?>" data-datatable="reload"
                            title="<?php echo e(__('user', ['form' => __('user')])); ?>">
                            <?php echo e(__('messages.apply')); ?>

                        </button>
                    </form>

                    <!-- استخدام Flexbox لترتيب حقل البحث وselect بجانب بعضهما -->
                    <div class="d-flex align-items-center gap-3 mt-3">
                        <!-- حقل البحث -->
                        <div class="input-group">
                            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control dt-search" placeholder="Search..."
                                aria-label="Search" aria-describedby="addon-wrapping" aria-controls="dataTableBuilder">
                        </div>

                        <!-- عنصر select بجانب حقل البحث -->
                        <select name="column_status" id="column_status" class="select2 form-control"
                            data-filter="select" style="width: 50%">
                            <option value=""><?php echo e(__('messages.all')); ?></option>
                            <option value="0" <?php echo e($filter['status'] == '0' ? 'selected' : ''); ?>>
                                <?php echo e(__('messages.inactive')); ?></option>
                            <option value="1" <?php echo e($filter['status'] == '1' ? 'selected' : ''); ?>>
                                <?php echo e(__('messages.active')); ?></option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="datatable" class="table table-striped border"></table>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', () => {
    window.renderedDataTable = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        dom: '<"row align-items-center"<"col-md-6" l><"col-md-6" f>>' +
             '<"table-responsive my-3" rt>' +
             '<"row align-items-center"<"col-md-6" i><"col-md-6" p>>',
        ajax: {
            type: "POST",
            url: "<?php echo e(route('billReport')); ?>",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: function(d) {
                d.search = {
                    value: $('.dt-search').val() || ''
                };
                d.filter = {
                    column_status: $('#column_status').val() || 'all'
                };
                d.startDate = $('#startDate').val() || null;
                d.endDate = $('#endDate').val() || null;
            }
        },
        columns: [
            { data: (data) => data.staf?.name ?? 'N/A', title: "<?php echo e(__('messages.Reception_name')); ?>" },
            { data: (data) => data.user?.name ?? 'No User', title: "<?php echo e(__('messages.player_name')); ?>" },
            { data: 'payType', title: "<?php echo e(__('messages.payment_type')); ?>" },
            { data: 'date', title: "<?php echo e(__('messages.payment_time')); ?>" },
            { data: 'paymrentNote', title: "<?php echo e(__('messages.payment_note')); ?>" },
            {
                data: (data) =>{
                    const baseAmount = data.price ?? data.amount ?? 0;
                    return baseAmount + (data.discountAmount ?? 0);
                },
                title: "<?php echo e(__('messages.Amount_Before_Discount')); ?>"
            },
            { data: 'discountAmount', title: "<?php echo e(__('messages.Discount_Percentage')); ?>" },
            {
                data: (data) => {
                    const baseAmount = data.price ?? data.amount ?? 0;
                    return baseAmount ;
                },
                title: "<?php echo e(__('messages.Amount_After_Discount')); ?>"
            },
            { data: (data) => {console.log(data); return data.user_payment?.[0]?.totalAmount ?? 0}, title: "<?php echo e(__('messages.Received_Amount')); ?>" },
            { data: 'description', title: "<?php echo e(__('messages.Description')); ?>" },
            {
                data: (data) => data.subscription?.name ?? 'No Subscription',
                title: "<?php echo e(__('messages.Subscription_Name')); ?>"
            },
            { data: 'id', title: "<?php echo e(__('messages.Bill_Number')); ?>" }
        ]
    });
});

// Event Listeners:
$('#expire_date').change(function() {
    $('#quick-action-apply').prop('disabled', !$('#expire_date').val());
    renderedDataTable.draw();
});

$('.dt-search').on('keyup', function() {
    renderedDataTable.draw();
});

$(document).on('click', '[data-ajax="true"]', function(e) {
    e.preventDefault();
    const submitUrl = $(this).data('submit');
    $(this).closest('form').attr('action', submitUrl).submit();
});

    </script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?>
<?php /**PATH /home/kmpower/public_html/resources/views/service/user_service_list.blade.php ENDPATH**/ ?>