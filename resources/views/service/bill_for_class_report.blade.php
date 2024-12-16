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
                            <h5 class="font-weight-bold">{{ __('messages.Report_classes') }}</h5>
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
            "url": '{{ route("userReport") }}',
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
                title: "{{('messages.player_name')}}"
            },
            {
                data: 'gender',
                name: 'gender',
                title: "{{('messages.gender')}}"
            },
            {
                data: 'birthDay',
                name: 'birthDay',
                title: "{{('messages.birthday')}}"
            },
            {
                data: 'phoneNumber',
                name: 'phoneNumber',
                title: "{{('messages.phone')}}"
            },
            {
                data: 'bills_count',
                name: 'bills_count',
                title: "{{('messages.Subscription_Count')}}"
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                title: "{{('messages.action')}}"
            }
        ],
        drawCallback: function(settings) {
            const playerCount = settings.json.recordsTotal || 0; 
            $('#player-count').text(playerCount); 
        }
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

</x-master-layout>
