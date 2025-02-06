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
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                          <h5 class="font-weight-bold">{{ __('messages.Reception_Movements') }}</h5>
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
                <div class="input-group ml-2">
                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control dt-search" placeholder="Search..." aria-label="Search" aria-describedby="addon-wrapping" aria-controls="dataTableBuilder">
                 
                  </div>
                          
                  <a id="quick-action-apply" class="btn btn-success btn-sm ml-2"
                  href="{{ route('ExportExcel') }}">{{ __('messages.Export_to_Excel') }}</a>   

          
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
                columnDefs: [{
                    targets: '_all',
                    className: 'text-wrap',
                    width: '20%'
                }],
                dom: '<"row align-items-center"><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" l><"col-md-6" p>><"clear">',
                ajax: {
                  "type"   : "GET",
                  "url"    : '{{ route("getStafLog") }}',
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
                      data: (data)=>data.staf.name,
                      name: 'name',
                      title: "{{ __('messages.name') }}"
                  },
                  {
                      data: 'date',
                      name: 'date',
                     title: "{{__('messages.Date')}}"
                  },
                  {
                      data: 'enterTime',
                      name: 'gender',
                        title: "{{ __('messages.Entry_timing') }}"
                  },
                  {
                      data: 'exitTime',
                      name: 'Exittiming',
                      title: "{{ __('messages.Exit_timing') }}"
                  },
                
                  
               
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
    <style>
      .dataTables_wrapper .dataTable th,
      .dataTables_wrapper .dataTable td {
          white-space: nowrap !important;
          text-overflow: ellipsis !important;
          overflow: hidden !important;
          text-align: center !important;
          /* يجعل النصوص والأرقام في منتصف الأعمدة */
          vertical-align: middle !important;
          /* يضمن توسيط النصوص عموديًا أيضًا */
      }
  
      /* .dataTables_wrapper .dataTable td.text-wrap {
          white-space: normal !important;
      } */
  
      .text-center {
          text-align: center !important;
          vertical-align: middle !important;
      }
  </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</x-master-layout>