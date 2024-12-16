<x-master-layout>
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
                                <h5 class="font-weight-bold">{{ __('messages.Report_classes') }}</h5>
                                <div class="d-flex justify-content-center align-items-center gap-3 mx-auto">
                                    <span class="value-label font-weight-bold">{{ __('messages.num_player') }}</span>
                                    <span class="value-amount font-weight-bold">27</span>
                                    
                                   
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
                      "type"   : "GET",
                      "url"    : '{{ route("payment.index_data")}}',
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
                        data: 'customer_id',
                        name: 'customer_id',
                        title: "{{__('messages.player_name :')}}"
                    },
                    {
                        data: 'service_id',
                        name: 'service_id',
                        title: "{{__('messages.gender')}}"
                    },
                    {
                        data: 'rating',
                        name: 'rating',
                        title: "{{__('messages.birthday')}}"
                    },
                    {
                        data: 'review',
                        name: 'review',
                        title: "{{__('messages.phone')}}"
                    },
                        
                    ]
                    
                });
          });
    
          $(document).ready(function() {
            $('#statusSelect').change(function() {
                var selectedValue = $(this).val();
                var selectedOption = $('#statusSelect option:selected');
                var route = selectedOption.data('route');
    
                if (selectedValue === 'cash' && route) {
                    window.location.href = route;
                }
                window.location.href = route;
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
    </x-master-layout>