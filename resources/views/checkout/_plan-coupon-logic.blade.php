
<!-- Modal -->
<div style='background: rgb(212, 219, 222);' class="modal fade" id="couponModal" tabindex="-1" role="dialog" aria-labelledby="couponModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="couponModalLabel">All Coupons</h3>
            <div class='coupon-message'></div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table style="width: 100%;" id='coupon-list'>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" style="width: 30%; border-radius: 0px;" class="btn style1" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            let orderGroups         = @json(session('cart')['order_groups']);
            var planWithCoupons     = orderGroups.filter((data) => {
                return data.plan && data.plan.auto_add_coupon_id;
            }).map(planOrder => {
                if (planOrder.plan.auto_add_coupon_id) {
                    let data = {
                        'plan_id': planOrder.plan.id,
                        'coupon_id': planOrder.plan.auto_add_coupon_id,
                        'order_group_id': planOrder.id
                    }
                    return data;
                }
            });

            if (planWithCoupons.length) {
                getCouponDetails(planWithCoupons);
            }

            function getCouponDetails(data)
            {
                $.ajax({
                    url: '{{ route("coupon.store") }}',
                    method: 'POST',
                    data: {
                        'data': data,
                        'for_plans': true
                    },
                    beforeSend: () => {
                        $('.myOverlay').removeClass('d-none');
                        $('.loadingGIF').removeClass('d-none');
                    },
                    success: (response) => {
                        $('.myOverlay').addClass('d-none');
                        $('.loadingGIF').addClass('d-none');
                        if (response.coupon_data) {
                            if (response.coupon_data) {
                                $('#remove-coupon').hide();
                            }
                            addToCarts(response.coupon_data);
                        }
                    },
                    error: () => {
                        $('.myOverlay').addClass('d-none');
                        $('.loadingGIF').addClass('d-none');
                    }
                });
            }

            function addToCarts(data)
            {
                let orderCoupons    = $('.c-buttons'),
                    couponList      = $('#coupon-list'),
                    message         = $('#coupon-list-message'),
                    codeInput       = $('#coupon'),
                    codes           = data.map((e) => e.coupon.code);
                // Apply first coupon by default
                var couponCodes = @json(session('couponCodes'));

                {{--if (!@json(session('couponCodes')) || !codes.includes(@json(session('couponAmount')['code']))) {--}}
                    {{--    codeInput.val(data[0].coupon.code);--}}
                    {{--    applyCoupon();--}}
                    {{--}--}}
                if(couponCodes && couponCodes.length) {
                    couponCodes.forEach(function (couponCode) {
                        applyCoupon(couponCode);
                    });
                }

                if (data.length > 1) {
                    orderCoupons.append(
                        '<button type="button" class="btn style1 coupon-modal-button" data-toggle="modal" data-target="#couponModal">Plan coupons</button>'
                    );
                    for (let i = 0; i < data.length; i++) {
                        couponList.append(
                            '<tr style="border-bottom: 1px solid black;">' +
                            '<td>' +
                            '<h4><u>' + data[i].coupon.code + '</u></h4>' +
                            data[i].coupon.info.details +
                            '<button data-dismiss="modal" data-code="'+data[i].coupon.code+'" style="border-radius: 0px; width: 100px;float: right;" class="btn style1 apply-coupon-modal">Apply</button>' +
                            '</td>' +
                            '</tr>'
                        );
                    }
                }
                let applyCouponButton   = $('.apply-coupon-modal');
                applyCouponButton.on('click', function () {
                    codeInput.val($(this).attr('data-code'));
                    applyCoupon();
                    $('.coupon-modal-button').attr('disabled', true);
                    location.reload();
                });
            }
        });
    </script>
@endpush


