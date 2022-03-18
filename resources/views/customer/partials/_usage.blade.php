<div id="usageModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <input type="hidden" id ="phone-no-usages" name="phone_number" readonly="true">
                <input type="hidden" id ="subscription-no-usages" name="subscription_id" readonly="true">
            </div>
            <div class="modal-body">
                <div class="tabsdata">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="tabstable">
                                <div class="tabsbx">
                                    <ul class="nav nav-tabs usages-tab" id="myTab" role="tablist">
                                        <li class="nav-item active">
                                            <a class="nav-link voice-btn" id="voice-tab" data-toggle="tab" href="#voice" role="tab" aria-controls="voice" aria-selected="true" data-type="voice">VOICE</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link internet-btn" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data" aria-selected="false" data-type="data">DATA</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-btn" id="text-tab" data-toggle="tab" href="#text" role="tab" aria-controls="text" aria-selected="false" data-type="text">TEXT</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-info">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6 width-70">
                                            {!! Form::label('cycle', 'Cycle  ') !!}
                                            {!! Form::select('cycle', [], null) !!}
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6 width-30 text-right">
                                            <button type="button" class="btn download-usages-btn" title="Download CSV"><i class="fa fa-download" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    @include('customer.partials.__voice')
                                    @include('customer.partials.__data')
                                    @include('customer.partials.__text')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(function(){
            let cycle_array = <?php echo json_encode($usages) ?>;
            $('#usageModal').on('change', '#cycle', function(e) {
                e.preventDefault();
                var subscriptionId = $('#usageModal #subscription-no-usages').val();
                var type = $('#usageModal .usages-tab .active .nav-link').attr('data-type');
                if(type === 'voice'){
                    getCallUsages(subscriptionId);
                }else if(type === 'data'){
                    getDataUsages(subscriptionId);
                }else{
                    getTextUsages(subscriptionId);
                }
            });

            $('.billPlans-line').on('click', '.show-usages', function(e) {
                e.preventDefault();
                let phone = $(this).attr('data-phone');
                let subscriptionId = $(this).attr('data-subscription');
                let cycleId = null;
                let cycleOption = "";
                $.each(cycle_array, function (index, value) {
                    if(index == subscriptionId){
                        cycleId = value.current_cycle_id;
                        let cycles = value.cycles;
                        $.each(cycles, function(cycle_index, cycle_value){
                            if(cycle_index == cycleId){
                                cycleOption+=`<option value="${cycle_index}" selected>${cycle_value}</option>`;
                            }else{
                                cycleOption+=`<option value="${cycle_index}" >${cycle_value}</option>`;
                            }
                        });
                    }
                })
                if(cycleOption){
                    $(document).find('#cycle').html(cycleOption);
                }else{
                    $(document).find('#cycle').html('<option value="">No Cycles Available</option>');
                }
                $('#usageModal #phone-no-usages').val(phone);
                $('#usageModal #subscription-no-usages').val(subscriptionId);
                $('#usageModal .voice-btn').click();
            });

            $('#usageModal').on('click', '.voice-btn', function(e) {
                e.preventDefault();
                getCallUsages($('#usageModal #subscription-no-usages').val());
            });

            $('#usageModal').on('click', '.internet-btn', function(e) {
                e.preventDefault();
                getDataUsages($('#usageModal #subscription-no-usages').val());
            });

            $('#usageModal').on('click', '.text-btn', function(e) {
                e.preventDefault();
                getTextUsages($('#usageModal #subscription-no-usages').val());
            });

            $('#usageModal').on('click', '.download-usages-btn', function(e) {
                e.preventDefault();
                var url = downloadUsages();
                window.open(url);
            });

            function downloadUsages() {
                let link = null;
                $.ajax({
                    type: 'POST',
                    url: '{{ route('download.usages') }}',
                    async: false,
                    data:{
                        phone: $('#usageModal #phone-no-usages').val(),
                        type:  $('#usageModal .usages-tab .active .nav-link').attr('data-type'),
                        cycle: $('#usageModal #cycle').val(),
                    },
                    beforeSend: showLoader,
                    success: function (data) {
                        link = data;
                    },
                    complete: hideLoader,

                    error: function (data) {
                        swal("Error", "Sorry Something went Wrong", "error");
                    }
                });
                return link;
            }

            function getTextUsages(subscriptionId) {
                var cycle = $('#usageModal #cycle').val()
                $('#usageModal #text-usages-table').DataTable( {
                    "scrollX": true,
                    "lengthMenu": [[100, 250, 500], [100, 250, 500]],
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "info": true,
                    "bDestroy": true,
                    "language": {
                        "processing": 'Please wait...',
                    },
                    "ajax": {
                        "type": "POST",
                        "url": '{{ route('usages.data') }}',
                        data: function ( d ) {
                            d.subscription_id = subscriptionId;
                            d.cycle = cycle;
                            d.usage_type = 'text';
                        },
                        beforeSend: showLoader,
                        complete: function (data) {
                            let total = data.responseJSON.total
                            $(document).find('.plan-details-modal__usages_summary_total').text(`Total: ${total}`);
                            hideLoader();
                        },
                        error: function (xhr, status, error) {
                            if(xhr.status === '401'){
                                location.reload();
                            }
                        },
                    },
                    "columns": [
                        { "data": 'date' },
                        { "data": 'time' }
                    ]
                });
            };

            function getDataUsages(subscriptionId) {
                var cycle = $('#usageModal #cycle').val()
                $('#usageModal #data-usages-table').DataTable( {
                    "scrollX": true,
                    "lengthMenu": [[100, 250, 500], [100, 250, 500]],
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "info": true,
                    "bDestroy": true,
                    "language": {
                        "processing": 'Please wait...',
                    },
                    "ajax": {
                        "type": "POST",
                        "url": '{{ route('usages.data') }}',
                        data: function ( d ) {
                            d.subscription_id = subscriptionId;
                            d.cycle = cycle;
                            d.usage_type = 'data';
                        },
                        beforeSend: showLoader,
                        complete: function (data) {
                            let total = (data.responseJSON.total).toFixed(2)
                            $(document).find('.plan-details-modal__usages_summary_total').text(`Total: ${total} MB`);
                            hideLoader();
                        },
                        error: function (xhr, status, error) {
                            if(xhr.status == '401'){
                                location.reload();
                            }
                        },
                    },
                    "columns": [
                        { "data": 'date' },
                        { "data": 'time' },
                        { "data": 'data' },
                    ]

                });
            };

            function getCallUsages(subscriptionId) {
                cycle = $('#usageModal #cycle').val()
                $('#usageModal #call-usages-table').DataTable( {
                    "scrollX": true,
                    "lengthMenu": [[100, 250, 500], [100, 250, 500]],
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "info": true,
                    "bDestroy": true,
                    "language": {
                        "processing": 'Please wait...',
                    },
                    "ajax": {
                        "type": "POST",
                        "url": '{{ route('usages.data') }}',
                        data: function ( d ) {
                            d.subscription_id = subscriptionId;
                            d.cycle = cycle;
                            d.usage_type = 'voice';
                        },
                        beforeSend: showLoader,
                        complete: function (data) {
                            let total = (data.responseJSON.total).toFixed(2)
                            $(document).find('.plan-details-modal__usages_summary_total').text(`Total: ${total} Min`);
                            hideLoader();
                        },
                        error: function (xhr, status, error) {
                            if(xhr.status == '401'){
                                location.reload();
                            }
                        },
                    },
                    "columns": [
                        { "data": 'date' },
                        { "data": 'time' },
                        { "data": 'voice' },
                    ]

                });
            };
        });
    </script>
@endpush
