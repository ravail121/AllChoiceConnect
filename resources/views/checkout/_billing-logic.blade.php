@push('js')
    <script>
        let $customerBillingForm  = $('.customer-billing-form'),
            iTag  = '<i class="fa fa-check f16"></i>';
            liTag = '<li><a href="#" class="t-violet-2"><i class="fa f16 caret-btn fa-caret-right"></i></a></li>';

        function billingInputValues(billingAddress1, billingAddress2, billingCity, billingStateId, billingZip, billingFname, billingLname, sessionId)
        {
            if (@json(session('id'))) {
                billingAddress1.val(sessionStorage.getItem('billing_address1'));
                billingAddress2.val(sessionStorage.getItem('billing_address2'));
                billingCity.val(sessionStorage.getItem('billing_city'));
                billingStateId.val(sessionStorage.getItem('billing_state'));
                billingZip.val(sessionStorage.getItem('billing_zip'));
                billingFname.val(sessionStorage.getItem('billing_fname'));
                billingLname.val(sessionStorage.getItem('billing_lname'));
            }
        }

        function copyShippingAddressToBilling(checkbox, $billingFname, $billingLname, $billingAddress1, $billingAddress2, $billingCity, $billingState, $billingZip)
        {
            if(checkbox.checked) {
                $billingAddress1.val($('#shipping-address1').val() ? $('#shipping-address1').val() : '');
                $billingAddress2.val($('#shipping-address2').val() ? $('#shipping-address2').val() : '');
                $billingFname.val($('#shipping-fname').val() ? $('#shipping-fname').val() : '');
                $billingLname.val($('#shipping-lname').val() ? $('#shipping-lname').val() : '');
                $billingState.val($('#shipping-state').val() ? $('#shipping-state').val() : '');
                $billingCity.val($('#shipping-city').val() ? $('#shipping-city').val() : '');
                $billingZip.val($('#shipping-zip').val() ? $('#shipping-zip').val() : '');

            } else {
                $billingFname.val(sessionStorage.getItem('billing_fname') ? sessionStorage.getItem('billing_fname') : '');
                $billingLname.val(sessionStorage.getItem('billing_lname') ? sessionStorage.getItem('billing_lname') : '');
                $billingAddress1.val(sessionStorage.getItem('billing_address1') ? sessionStorage.getItem('billing_address1') : '');
                $billingAddress2.val(sessionStorage.getItem('billing_address2') ? sessionStorage.getItem('billing_address2') : '');
                $billingCity.val(sessionStorage.getItem('billing_city') ? sessionStorage.getItem('billing_city') : '');
                $billingZip.val(sessionStorage.getItem('billing_zip') ? sessionStorage.getItem('billing_zip') : '');
                $billingState.val(sessionStorage.getItem('billing_state') ? sessionStorage.getItem('billing_state') : '');
            }

        }

        function saveTax(clickTrigger = true)
        {
            storeBillingInputsInSession();
            if (billingFormValidate()) {
                let previousTax = $('.tax-cart').html().replace(',','');
                $.ajax({
                    url:'{{ route("billing-info.save") }}',
                    method:'post',
                    data: $customerBillingForm.serialize(),
                    beforeSend: function () {
                        $('.myOverlay').removeClass('d-none');
                        $('.loadingGIF').removeClass('d-none');
                    },
                    error: (response)=>{
                        $('.myOverlay').addClass('d-none');
                        $('.loadingGIF').addClass('d-none');

                        $('html, body').animate({
                            // scrollTop: $("#collapseTwo").position().top - 560
                        }, 2000);
                        swal({
                            title:'Server error',
                            icon:'error'
                        });
                    }
                }).done((response) => {
                    $.ajax({
                        url:'{{route("calculate.tax")}}',
                        method:'get',
                        data: {
                            'tax_id': response['id']
                        },
                        complete: ()=>{
                            $('.myOverlay').addClass('d-none');
                            $('.loadingGIF').addClass('d-none');
                        },
                        success: (res)=>{
                            let panelTitle2             = $('#panel-tile-2'),
                                panelTitle3             = $('#panel-tile-3'),
                                panelTitleTrigger2      = $('#panel-tile-2').find('.collapse-trigger'),
                                panelTitleTrigger3      = $('#panel-tile-3').find('.collapse-trigger');
                                if (panelTitle2.find('li > a').find('i').hasClass('fa-pencil')) {
                                    panelTitle2.find('li > a').remove();
                                    panelTitle2.find('li').append(iTag);
                                    panelTitle2.find('a').attr('href', '#collapseTwo');
                                    panelTitle2.find('ul').append(liTag);
                                    panelTitle3.find('a').attr('href', '#collapseThree');
                                    panelTitle3.find('ul').append('<li><a href="#" class="f16"><i class="fa fa-pencil customer-info-edit"></i></a></li>');
                                    panelTitleTrigger2.trigger('click');
                                    panelTitleTrigger3.trigger('click');
                                } else {
                                    clickTrigger ? panelTitleTrigger2.trigger('click') : null;
                                    if (!$('#collapseThree').hasClass('in')) {
                                        panelTitleTrigger3.trigger('click');
                                    }
                                }
                            var totalDueCart = $('.total-due-cart');
                            var totalDue     = parseFloat(totalDueCart.html().replace(',',''));
                            var updatedTax   = parseFloat(res);

                            $('.tax-cart').html(updatedTax ? updatedTax.toFixed(2) : "0");
                            $('#place-order').removeClass('d-none');
                            $('#place-order-tip').addClass('d-none');
                            $('#save-tax').html('Update');
                            totalDue = totalDue - previousTax;
                            var updatedDue = addCommas((totalDue + updatedTax).toFixed(2));
                            totalDueCart.html(updatedDue ? updatedDue : '0');
                            clickTrigger ? scrollTrigger('#accordionThree') : null;
                            //clickTrigger ? location.reload() : null;
                        }
                    })
                });
            }
        }
        function storeBillingInputsInSession()
        {
            if (@json(session('id'))) {
                let sessionBillingFname = '{{ isset(session('cart')['business_verification']['billing_fname']) ? session('cart')['business_verification']['billing_fname'] : '' }}',
                    sessionBillingLname = '{{ isset(session('cart')['business_verification']['billing_lname']) ? session('cart')['business_verification']['billing_lname'] : '' }}',
                    sessionAddress1     = '{{ isset(session('cart')['business_verification']['billing_address1']) ? session('cart')['business_verification']['billing_address1'] : '' }}',
                    sessionAddress2     = '{{ isset(session('cart')['business_verification']['billing_address2']) ? session('cart')['business_verification']['billing_address2'] : '' }}',
                    sessionBillingId    = '{{ isset(session('cart')['business_verification']['billing_state_id']) ? session('cart')['business_verification']['billing_state_id'] : '' }}',
                    sessionBillingCity  = '{{ isset(session('cart')['business_verification']['billing_city']) ? session('cart')['business_verification']['billing_city'] : '' }}',
                    sessionBillingZip   = '{{ isset(session('cart')['business_verification']['billing_zip']) ? session('cart')['business_verification']['billing_zip'] : '' }}';

                sessionStorage.setItem('billing_address1', $('#billing-address1').val() ? $('#billing-address1').val() : sessionAddress1);
                sessionStorage.setItem('billing_address2', $('#billing-address2').val() ? $('#billing-address2').val() : sessionAddress2);
                sessionStorage.setItem('billing_fname', $('#billing-fname').val() ? $('#billing-fname').val() : sessionBillingFname);
                sessionStorage.setItem('billing_lname', $('#billing-lname').val() ? $('#billing-lname').val() : sessionBillingLname);
                sessionStorage.setItem('billing_state', $('#billing-state').val() ? $('#billing-state').val() : sessionBillingId);
                sessionStorage.setItem('billing_city', $('#billing-city').val() ? $('#billing-city').val() : sessionBillingCity);
                sessionStorage.setItem('billing_zip', $('#billing-zip').val() ? $('#billing-zip').val() : sessionBillingZip);
            }
        }
    </script>
@endpush
