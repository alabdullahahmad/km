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
                            <h5 class="font-weight-bold">{{ __('messages.Tag_Subscriptions') }}</h5>
                            @if($auth_user->can('tagsubscriptions add'))
                            <a href="{{ route('subcategory.create') }}" class="float-right mr-1 btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> {{ trans('messages.add_form_title',['form' => trans('messages.Tag_Subscriptions')  ]) }}</a>
                            @endif
                        </div>
                        {{-- {{ $dataTable->table(['class' => 'table  w-100'],false) }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

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
                  "url"    : '{{ route("Tag") }}',
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
                    //     title: '<input type="checkbox" class="form-check-input" name="select_all_table" id="select-all-table" data-type="subcategory" onclick="selectAllTable(this)">',
                    //     exportable: false,
                    //     orderable: false,
                    //     searchable: false,
                    // },
                    {
                        data: 'name',
                        name: 'name',
                        title: "{{ __('messages.name') }}"
                    },
                    {
                        data:(data) => {
                            return data.category.name
                        },
                        name:'category_id',
                        title: "{{ __('messages.category') }}"
                    },
                 

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        title: "{{ __('messages.action') }}"
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
  $('#quick-action-type').change(function () {
    resetQuickAction()
  });

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
