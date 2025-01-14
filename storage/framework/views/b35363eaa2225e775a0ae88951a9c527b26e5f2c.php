    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold"><?php echo e($pageTitle ?? trans('messages.list')); ?></h5>
                            <?php if($auth_user->can('role add')): ?>
                                <a href="<?php echo e(route('permission.add',['type'=>'role'])); ?>" class="float-right mr-1 btn btn-sm btn-primary loadRemoteModel"><i class="fa fa-plus-circle"></i> <?php echo e(trans('messages.add_form_title',['form' => trans('messages.role')  ])); ?></a>
                                
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
            
              <div class="d-flex justify-content-end">
                <div class="datatable-filter ml-auto">
                  <select name="column_status" id="column_status" class="select2 form-control" data-filter="select" style="width: 100%">
                    <option value=""><?php echo e(__('messages.all')); ?></option>
                    <option value="0" <?php echo e($filter['status'] == '0' ? "selected" : ''); ?>><?php echo e(__('messages.inactive')); ?></option>
                    <option value="1" <?php echo e($filter['status'] == '1' ? "selected" : ''); ?>><?php echo e(__('messages.active')); ?></option>
                  </select>
                </div>
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
         $(document).ready(function(event) {

        window.renderedDataTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                dom: '<"row align-items-center"><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" l><"col-md-6" p>><"clear">',
                ajax: {
                  "type"   : "GET",
                  "url"    : '<?php echo e(route("role.index_data")); ?>',
                  "data"   : function( d ) {
                    d.search = {
                      value: $('.dt-search').val()
                    };
                    d.filter = {
                      column_status: $('#column_status').val()
                    }
                  },
                },
                columns: [
                    {
                        name: 'check',
                        data: 'check',
                        title: '<input type="checkbox" class="form-check-input" name="select_all_table" id="select-all-table" onclick="selectAllTable(this)">',
                        exportable: false,
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'name',
                        name: 'name',
                        title: "<?php echo e(__('messages.name')); ?>"
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
      });

    function resetQuickAction () {
    const actionValue = $('#quick-action-type').val();
    console.log(actionValue)
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

  $('#quick-action-type').change(function () {
    resetQuickAction()
  });

  $(document).on('update_quick_action', function() {

  })

  $('#quick-action-form').on('submit', function(e) {
        e.preventDefault()
        const form = $(this)
        const url = form.attr('action')
        const message = form.find('button[data-ajax="true"]').data('message');
        const rowdIds = $("#datatable_wrapper .select-table-row:checked").map(function() {
            return $(this).val();
        }).get();
        
    
        confirmSwal(message).then((result) => {
            if(!result.isConfirmed) return
            callActionAjax({url: `${url}?rowIds=${rowdIds}`,body: form.serialize()})
          })
      
      })

      $(document).on('change', '#datatable_wrapper .switch-status-change', function() {
    let url = $(this).attr('data-url')
    let body = {
      status: $(this).prop('checked') ? 1 : 0,
      _token: $(this).attr('data-token')
    }
    callActionAjax({url: url, body: body})
  })

  $(document).on('change', '#datatable_wrapper .change-select', function() {
    let url = $(this).attr('data-url')
    let body = {
      value: $(this).val(),
      _token: $(this).attr('data-token')
    }
    callActionAjax({url: url, body: body})
  })

  function callActionAjax ({url, body}) {
    $.ajax({
      type: 'POST',
      url: url,
      data: body,
      success: function(res) {
        if (res.status) {
          const successMessage = res.message;
          showMessage(successMessage);
          window.renderedDataTable.ajax.reload(resetActionButtons, false)
          const event = new CustomEvent('update_quick_action', {detail: {value: true}})
          document.dispatchEvent(event)
        } else {
          Swal.fire({
            title: 'Error',
            text: res.message,
            icon: "error"
          })
        }
      }
    })
  }
  function showMessage(message) {
    Snackbar.show({
        text: message,
        pos: 'bottom-center'
    });
}
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php /**PATH C:\Users\USER\Desktop\km\resources\views/role/index.blade.php ENDPATH**/ ?>