@push('js')
    <script>
        var orderGroups = @json(session('cart')['order_groups']);

        function applyCoupon(e, code=null)
        {
            var couponMessage = $('.coupon-message')
            var couponCode;
            if(code){
                couponCode = code
            } else {
                couponCode    = $('#coupon').val().trim();
            }
            couponMessage.html('');
            if (!couponCode || couponCode < 1) {
                couponMessage.html('<small class="coupon-text-red text-muted fonts-phones alert alert-danger">Please enter a code</small>');
                scrollTrigger('.coupon-message');
                return false;
            }
            couponVerify(couponCode);
        };


        function couponVerify(couponCode)
        {
            let orderid         = "{{ session('cart')['id'] }}",
                hash            = "{{ session('customer_hash') }}",
                couponMessage   = $('.coupon-message');
            $.ajax({
                url: '{{ route("coupon.store") }}',
                method: 'POST',
                data: {
                    'code': couponCode,
                    'order_id': orderid,
                    'hash': hash
                },
                beforeSend: () => {
                    if (couponCode) {
                        $('.myOverlay').removeClass('d-none');
                        $('.loadingGIF').removeClass('d-none');
                    }
                },
            }).done(function (response) {
                processCoupon(response, couponMessage, couponCode);
            });
        }

        function processCoupon(response, couponMessage, couponCode)
        {
            couponMessage.html('')
            $('.myOverlay').addClass('d-none');
            $('.loadingGIF').addClass('d-none');

            if (response['error']) {
                couponMessage.html('<small class="coupon-text-red text-muted fonts-phones alert alert-danger">' + response['error'] + '</small>');
            } else {
                couponMessage.html('<small class="coupon-text-green text-success alert alert-success fonts-phones">Coupon added successfully</small>');
                couponAdded(response, couponCode);
                saveTax(false);
                $('#coupon').val('');
            }
            scrollTrigger('.coupon-message');
        }

        function removeCouponOnClickTrigger(e)
        {
            var orderid   = "{{ session('cart')['id'] }}"
            var successMessage  = $('.coupon-text-green');
            var couponMessage = $('.coupon-message');
            var couponCode = e.target.dataset.couponId || null;

            if(couponCode) {
                $.ajax({
                    url: '{{ route("coupon.remove") }}',
                    method: 'POST',
                    data: {
                        'order_id': orderid,
                        'coupon_code': couponCode
                    },
                    beforeSend: () => {
                        $('.myOverlay').removeClass('d-none');
                        $('.loadingGIF').removeClass('d-none');
                    }
                }).done(function(response) {
                    if (response['error']) {
                        couponMessage.html('<small class="coupon-text-red text-muted fonts-phones alert alert-danger">' + response['error'] + '</small>');
                        scrollTrigger('.coupon-message');
                    } else {
                        couponAdded(response)
                        $('.myOverlay').addClass('d-none');
                        $('.loadingGIF').addClass('d-none');
                        var couponCodeWrapperId = '#coupon-code-cart-wrapper-' + couponCode;
                        $('.cart-coupon-wrapper').find(couponCodeWrapperId).remove();
                        if ($('.cart-coupon-wrapper').html().trim() === '') {
                            var noCouponCodeHtml = '<span class="tooltips tooltip-coupon no-coupon-applied" tooltip="No coupon applied" tooltip-position="bottom" class="footer-mobile-coupon-code-tooltip">\n' +
                                '                                        <i class="fa fa-question-circle" aria-hidden="true"></i>\n' +
                                '                                     </span>'
                            $('.cart-coupon-wrapper').html(noCouponCodeHtml);
                        }
                        $(e.target).closest('.coupon-code-text-wrapper').remove();
                        successMessage.html('Coupon Removed');
                    }
                });
            }
        }

        function couponAdded(response, couponCode = null)
        {
            var taxRate      = @json(session('taxrate'));
            if (couponCode) {
                var totalTax = parseFloat($('.tax-cart').html().allReplace(replaceFromHtml));
            } else {
                var totalTax = @json((session('cart')['subtotalPrice']+session('cart')['coupons'])*(session('taxrate')/100));
                $('.tax-cart').html(parseFloat(totalTax).toFixed(2));
            }
            var couponAmount = response['total'];

            var subtotal     = parseFloat($('.cart-subtotal').html().allReplace(replaceFromHtml)),
                shippingFee  = parseFloat($('.cart-shipping').html().allReplace(replaceFromHtml)),
                regulatory   = parseFloat($('.cart-regulatory').html().allReplace(replaceFromHtml)),
                taxCart      = parseFloat($('.tax-cart').html().allReplace(replaceFromHtml)),
                total        = subtotal + shippingFee + regulatory;

            if (couponCode) {
                var couponLists = $('#coupon-list-message').html();
                var toAppendHtml = '<div class="coupon-code-text-wrapper text-left mb-5"><div class="coupon-code-cart">' + couponCode + '<a class="remove-coupon-button cursor-pointer" title="Remove coupon ' + couponCode  + '"><i class="fa fa-trash remove-coupon" aria-hidden="true" data-coupon-id="' + couponCode + '"></i></a></div></div>';
                $('#coupon-list-message').html(couponLists + toAppendHtml);
                if($('.coupon-amount-cart').html() > 0){
                    var couponTempAmount = $('.coupon-amount-cart').html().trim();
                    if(couponTempAmount){
                        couponAmount = parseFloat(couponTempAmount) + response['total'];
                    }
                }

                var toolTipText;
                if(response.hasOwnProperty('coupon_amount_details') && response.coupon_amount_details.hasOwnProperty('details')){
                    toolTipText = response.coupon_amount_details.details;
                } else {
                    toolTipText = couponCode;
                }
                var couponCodeHtml = '<span class="coupon-code-cart-wrapper" id="coupon-code-cart-wrapper-' + couponCode + '"><b class="coupon-code-cart">' + couponCode + '</b> <span class="tooltips tooltip-coupon" tooltip="' + toolTipText + '" tooltip-position="bottom" class="footer-mobile-coupon-code-tooltip">\n' +
                    '<i class="fa fa-question-circle" aria-hidden="true"></i>\n' +
                    '</span></span>';
                if($('.cart-coupon-wrapper').find('.no-coupon-applied').length){
                    $('.cart-coupon-wrapper').html(couponCodeHtml);
                } else {
                    $('.cart-coupon-wrapper').append(couponCodeHtml);
                }
            }
            var totalDue     = (total + totalTax) - couponAmount;

            $('.coupon-amount-cart').html(addCommas(parseFloat(couponAmount).toFixed(2)));
            $('.total-due-cart').html(addCommas(parseFloat(totalDue).toFixed(2)));
        }

        function billingFormValidate()
        {
            return $('#billing-fname').valid() && $('#billing-lname').valid() && $('#billing-address1').valid() && $('#billing-city').valid() && $('#billing-state').valid() && $('#billing-zip').valid();
        }

        function getRawTax()
        {
            var totalTax = [];
            for (let i = 0; i < orderGroups.length; i++) {

                var og = orderGroups[i],
                    noPlan = true;

                if (og['plan']) {
                    noPlan = false;
                    if (og['plan']['taxable']) {
                        planAmount = og['plan_prorated_amt'] ? og['plan_prorated_amt'] : og['plan']['amount_recurring'];
                        planAmount = parseFloat(planAmount) + og['plan']['amount_onetime'];
                        totalTax.push(parseFloat(planAmount));
                    }
                }

                if (og['device'] && og['device']['taxable']) {
                    deviceAmount = noPlan ? og['device']['amount'] : og['device']['amount_w_plan'];
                    totalTax.push(parseFloat(deviceAmount));
                }

                if (og['sim'] && og['sim']['taxable']) {
                    simAmount = noPlan ? og['sim']['amount_alone'] : og['sim']['amount_w_plan'];
                    totalTax.push(parseFloat(simAmount));
                }

                if (og['addons']) {
                    for (let a = 0; a < og['addons'].length; a++) {
                        var og_addon = og['addons'][a];
                        if (og_addon['taxable']) {
                            var addonAmount = og_addon['prorated_amt'] ? og_addon['prorated_amt'] : og_addon['amount_recurring'];
                            totalTax.push(parseFloat(addonAmount));
                        }
                    }
                }
            }
            return parseFloat(totalTax.reduce((a, b) => {
                return a + b
            }, 0));
        }

        function isEmptyObject(obj){
            return JSON.stringify(obj) === '{}';
        }
    </script>
@endpush
