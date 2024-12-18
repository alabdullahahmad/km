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
                            <h5 class="font-weight-bold"><?php echo e(__('messages.category_list')); ?></h5>
                            <?php if($auth_user->can('category add')): ?>
                                <a href="<?php echo e(route('category.create')); ?>"
                                    class="float-right mr-1 btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i>
                                    <?php echo e(trans('messages.add_form_title', ['form' => trans('messages.category')])); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between ">



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
                        "type": "GET",
                        "url": '<?php echo e(route('categories')); ?>',
                        "data": function(d) {
                            d.search = {
                                value: $('.dt-search').val()
                            };
                            d.filter = {
                                column_status: $('#column_status').val()
                            }

                        },

                    },
                    columns: [
                        // {
                        //     name: 'check',
                        //     data: (data) => {
                        //         console.log(data.id);
                        //         return 'jazem'
                        //     },
                        //     title: '<input type="checkbox" class="form-check-input" name="select_all_table" id="select-all-table" data-type="category" onclick="selectAllTable(this)">',
                        //     exportable: false,
                        //     orderable: false,
                        //     searchable: false,
                        // },
                    {
                        data: 'name',
                        name: 'name',
                        title: "<?php echo e(__('messages.name')); ?>"
                    },

                    // {
                    //     data: 'status',
                    //     name: 'status',
                    //     title: "<?php echo e(__('messages.status')); ?>"
                    // },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        title: "<?php echo e(__('messages.action')); ?>"
                    }

                ]

            });
        });

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
                if (actionValue == 'change-featured') {
                    $('.quick-action-featured').addClass('d-none');
                    $('#change-featured-action').removeClass('d-none');
                } else {
                    $('.quick-action-featured').addClass('d-none');
                }

            } else {
                $('#quick-action-apply').attr('disabled', true);
                $('.quick-action-field').addClass('d-none');
                $('.quick-action-featured').addClass('d-none');
            }
        }

        $('#quick-action-type').change(function() {
            resetQuickAction()
        });

        $(document).on('update_quick_action', function() {})

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
    </script>
    <style>
        .d-flex .mr-3 .delete-category {

            display: unset !important;

        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?>
<?php /**PATH C:\Users\USER\Desktop\km\resources\views/category/index.blade.php ENDPATH**/ ?>