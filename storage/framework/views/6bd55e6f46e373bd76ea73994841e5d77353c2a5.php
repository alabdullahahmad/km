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
                            <?php if($auth_user->can('provider add')): ?>
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
                  <select name="action_type" class="form-control select2" id="quick-action-type" style="width:100%" disabled>
                      <option value=""><?php echo e(__('messages.no_action')); ?></option>
                      <option value="change-status"><?php echo e(__('messages.status')); ?></option>
                      <option value="delete"><?php echo e(__('messages.delete')); ?></option>
                     
                  </select>

                <div class="select-status d-none quick-action-field" id="change-status-action" style="width:100%">
                    <select name="status" class="form-control select2" id="status" style="width:100%">
                    <?php if($list_status == 'pending'): ?>
                      <option value="1"><?php echo e(__('messages.approve')); ?></option>
                    <?php else: ?>
                      <option value="1"><?php echo e(__('messages.active')); ?></option>
                      <option value="0"><?php echo e(__('messages.inactive')); ?></option>
                    <?php endif; ?>
                    </select>
                </div>
                <a id="quick-action-apply" class="btn btn-primary" 
                    href="<?php echo e(route('ExportExcel')); ?>"><?php echo e(__('messages.Export Excel')); ?></a>
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

        window.renderedDataTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                dom: '<"row align-items-center"><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" l><"col-md-6" p>><"clear">',
                ajax: {
                  "type"   : "GET",
                  "url"    : '<?php echo e(route("Staf")); ?>',
                  "data"   : function( d ) {
                    d.search = {
                      value: $('.dt-search').val()
                    };
                    d.filter = {
                      column_status: $('#column_status').val()
                    }
                  }
                },
                columns: [
                    // {
                    //     name: 'check',
                    //     data: 'check',
                    //     title: '<input type="checkbox" class="form-check-input" name="select_all_table" id="select-all-table" data-type="user" onclick="selectAllTable(this)">',
                    //     searchable: false,
                    //     exportable: false,
                    //     orderable: false,
                    // },
                    {
                        data: 'name',
                        name: 'display_name',
                        title: "<?php echo e(__('messages.name')); ?>",
                        orderable: false,
                    },

                    {
                        data: 'gender',
                        name: 'created_at',
                        title: "<?php echo e(__('messages.gender')); ?>"
                    },
                    {
                      data:'birthDay',
                      name:'providertype_id',
                      title:"<?php echo e(__('messages.birthday')); ?>"
                    },
                    {
                      data:'phoneNumber',
                      name:'contact_number',
                      title:"<?php echo e(__('messages.phone')); ?>"
                    },
                    {
                      data:'address',
                      name:'wallet',
                      title:"<?php echo e(__('messages.Address')); ?>",
                      searchable: false,
                      orderable: false,
                    },
                    {
                      data:'personalid',
                      name:'wallet',
                      title:"<?php echo e(__('messages.National_Id')); ?>",
                      searchable: false,
                      orderable: false,
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


<?php /**PATH /home/kmpower/public_html/resources/views/provider/index.blade.php ENDPATH**/ ?>