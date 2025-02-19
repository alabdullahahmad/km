<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <h5 class="font-weight-bold">{{ __('messages.cash') }}</h5>
                        </div>
                        
                    </div>
                </div>
                <div class="card">
                        <div class="card-body">
                            <div class="float-right ">
                                <div class="d-flex justify-content-end">
                                    {{-- <div class="datatable-filter ml-auto">
                                        <select name="column_status" id="column_status" class="select2 form-control" data-filter="select" style="width: 100%">
                                          <option value="">{{__('messages.Select Bill Type :')}}</option>
                                          <option value="0" {{$filter['paymenttype'] == '0' ? "selected" : ''}}>{{__('messages.Cash_In')}}</option>
                                          <option value="1" {{$filter['paymenttype'] == '1' ? "selected" : ''}}>{{__('messages.Cash_out')}}</option>
                                        </select>
                                    </div> --}}
                                    <div class="input-group ml-auto">
                                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-search"></i></span>
                                        <input type="text" class="form-control dt-search" placeholder="Search..." aria-label="Search" aria-describedby="addon-wrapping" aria-controls="dataTableBuilder">
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
          "url"    : '{{ route("postrequest.index_data",['id' => $id]) }}',
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
                name: 'DT_RowIndex',
                data: 'DT_RowIndex',
                title: "{{__('messages.Reception_name')}}",
                exportable: false,
                orderable: false,
                searchable: false,
            },
            {
                data: 'name',
                name: 'post_request_id',
                title: "{{ __('messages.player_name') }}"
            },
            {
                data: 'paymentType',
                name: 'provider_id',
                title: "{{ __('messages.payment_type') }}"
            },
            {
                data: 'customer_id',
                name: 'customer_id',
                title: "{{ __('messages.payment_time') }}"
            },
            {
                data: 'price',
                name: 'price',
                title: "{{ __('messages.payment_note') }}"
            },
            {
                data: 'price',
                name: 'price',
                title: "{{ __('messages.Amount_Before_Discount') }}"
            },
            {
                data: 'price',
                name: 'price',
                title: "{{ __('messages.Discount_Percentage') }}"
            },
            {
                data: 'price',
                name: 'price',
                title: "{{ __('messages.Discount_reason') }}"
            },
            {
                data: 'price',
                name: 'price',
                title: "{{ __('messages.Amount_After_Discount') }}"
            },
            {
                data: 'price',
                name: 'price',
                title: "{{ __('messages.Received_Amount') }}"
            },
            {
                data: 'price',
                name: 'price',
                title: "{{ __('messages.Description') }}"
            },
            {
                data: 'price',
                name: 'price',
                title: "{{ __('messages.Subscription_Name') }}"
            },
            {
                data: 'price',
                name: 'price',
                title: "{{ __('messages.Bill_Number') }}"
            },
            
            
        ]
        
    });
});
</script>
</x-master-layout>