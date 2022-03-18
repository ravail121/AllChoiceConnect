<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>All Choice Connect</title>
    <link href="{{ asset('theme/images/logo-color.png') }}" rel="icon">

    {!! Html::style('https://use.fontawesome.com/releases/v5.3.1/css/all.css') !!}
    {!! Html::style('css/customstyle.css') !!}

    {!! Html::style('theme/css/styles.css') !!}
    {!! Html::style('theme/css/app.min.css') !!}
    {!! Html::style('css/vendors/dropzone/basic.css') !!}
    {!! Html::style('css/dropzone.css') !!}
    {!! Html::style('css/extra-dropzone.css') !!}
    {!! Html::style('css/vendors/sweetalert.css') !!}
    {!! Html::style('css/vendors/dataTables.bootstrap.min.css') !!}

    <!--new files added by ankur -->
    {!! Html::style('theme/newstyle/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('theme/newstyle/icofont/icofont.min.css') !!}
    {!! Html::style('theme/newstyle/boxicons/css/boxicons.min.css') !!}
    {!! Html::style('theme/newstyle/css/style.css?v='.time()) !!}
    {!! Html::style('theme/newstyle/css/custom_style.css?v='.time()) !!}
    {!! Html::style('theme/css/bootstrap.min.css') !!}

    <link rel="icon" type="image/png" href={{ asset('theme/images/logo-color.png') }} />
    <link rel="stylesheet" href="{{ asset('css/tooltip.css') }}">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/vendors/flickity.min.css') }}">

    <script src="{{ asset('js/vendors/font-awesome.js') }}"></script>

    @stack('css')

</head>
<body>

<div class="myOverlay d-none"></div>
<div class="loadingGIF d-none">
    <img src="{{ asset('theme/images/loader.gif') }}" />
</div>

@include('layouts.partials._header')
<div class='notify'></div>
@include('layouts.partials._notifications')


@yield('content')

@include('modals.edit-cart')
@include('modals.edit-sim')

@include('layouts.partials._footer')

@yield('footerCart')

@include('layouts.partials._javascript')


@include('sweet::alert')

<script>
    Dropzone.autoDiscover = false;

    $(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('.alert').find('button.close').on('click', function() {
            $(this).parent('div').parent('div').remove();

        });

        $('#cart-drop').find('.active-order-group').on('click', function(){
            var sessionCart = @json(session('cart'));
            var activeId = sessionCart.active_group_id;
            var orderGroups = sessionCart.order_groups;

            for (var i = 0; i < orderGroups.length; i++) {
                if (activeId == orderGroups[i].id) {
                    if (orderGroups[i].plan != null) {
                        var replaceHtml = '<div class="modal-body"><h5 class="add-bottom-4 text-center">Please choose Device for your active Plan <span class="t-violet-2" style="font-weight: 500;">'+orderGroups[i].plan.name+'</span></h5><ul class="text-center"><li class="add-bottom-4"><a href="{{ route('devices.index') }}" class="btn style2">Add Device</a></li></ul></div>'

                    } else if (orderGroups[i].device != null) {

                        var replaceHtml = '<div class="modal-body"><h5 class="add-bottom-4 text-center">Please choose Plan for your active Device <span class="t-violet-2" style="font-weight: 500;">'+orderGroups[i].device.name+'</span></h5><ul class="text-center"><li class="add-bottom-4"><a href="{{ route('plans.index') }}" class="btn style2">Add Plan</a></li></ul></div>'

                    }
                    $('#cart-popup').find('.modal-body').html(replaceHtml);
                    $('#cart-popup ul li').toggleClass('special');

                }
            }

        });
        let couponData = @json(session('couponAmount'));
        $('.tooltip-coupon').append("<span style='width: max-content; text-align: justify;'></span>");
        $('.tooltip-coupon:not([tooltip-position])').attr('tooltip-position','top');
        $(".tooltip-coupon").mouseenter(function(){
            setInterval(()=>{
                $(this).find('span').empty().append($(this).attr('tooltip'));
            },100);

            let couponCode    = $('#coupon').val(),
                cart          = @json(session('cart')),
                hash          = @json(session('customer_hash'));

            if (!couponData) {
                if (couponCode && cart['order_groups'].length > 0) {
                    $.ajax({
                        url: '{{ route("coupon.store") }}',
                        method: 'POST',
                        data: {'code':couponCode, 'order_id':cart['id'], 'hash':hash, 'only_details': true},
                    }).done(function (response) {
                        $('.tooltip-coupon').attr('tooltip', response.coupon_amount_details.details);
                    });
                }
            } else {
                $(this).attr('tooltip', couponData.coupon_amount_details.details);
            }
        });

        function showLoader() {
            $('.myOverlay').removeClass('d-none');
            $('.loadingGIF').removeClass('d-none');
        }

        function hideLoader() {
            $('.myOverlay').addClass('d-none');
            $('.loadingGIF').addClass('d-none');
        }

        @stack('jQuery')
    });

    $(function(){
        $('.login-form').validate({
            rules: {
                password:          "required",
                identifier:{
                    required: true,
                },
            },
            messages: {
                password:         "Please provide your password",
                identifier: {
                    required: "Please enter your Email ID or Customer ID",
                },
            },

            errorElement: "em",

            errorPlacement: function( error, element ){

                $(element).addClass('is-invalid');
                error.addClass('form-text text-muted error-msg');
                error.insertAfter(element);
            },
            success: function( label, element ){
                $(element).removeClass("is-invalid");
            },
        });

    });

    //Logic for prorated tooltip in carts
    var startDate = '{{ isset(session("cart")["customer"]["billing_start"]) ? session("cart")["customer"]["billing_start"] : null }}';
    var endDate   = '{{ isset(session("cart")["customer"]["billing_end"]) ? session("cart")["customer"]["billing_end"] : null }}';

    $('.tooltip-prorated').append("<span style='width: max-content; text-align: justify;' class='prorated-tooltip'></span>");
    $('.tooltip-prorated:not([tooltip-position])').attr('tooltip-position','bottom');
    $(".tooltip-prorated").mouseenter(function(){
        setInterval(()=>{
            $(this).find('span').empty().append($(this).attr('tooltip'));
        },100);

        if (startDate && endDate) {
            $.ajax({
                url: '{{ route("prorated.days") }}',
                method: 'post',
                data: {'start_date': startDate, 'end_date':endDate}
            }).done((response)=>{
                $(this).attr(
                    'tooltip',
                    'Prorated Days Left: '+response['remaining_days']+'<br>'+
                    'Total Days: '+response['total_days']+'<br>'+
                    'Prorated Amount: $'+$(this).attr('data-prorated')+'<br>'+
                    'After Prorated Period: $'+$(this).attr('data-amount_recurring')+'/Month'
                );

            });
        }
    });
    $('.agreement-tip').append("<span></span>");
    $('.agreement-tip:not([tooltip-position])').attr('tooltip-position','bottom');
    $(".agreement-tip").mouseenter(function(){
        setInterval(()=>{
            $(this).find('span').empty().append($(this).attr('tooltip'));
        },100);
        $(this).attr(
            'tooltip','Please agree to our terms of service.'
        );
    });

    let simNewNumber    = $('#sim-number-modal'),
        simNumber,
        orderGroupId;
    $formSim = $('.sim-edit-input');

    $('.edit-sim').on('click', function () {

        simNewNumber.val('');
        orderGroupId   = $(this).attr('data-id');

        let simData    = $(this)
        carrier    = simData.attr('data-carrier-id-'+orderGroupId);
        simNewNumber.val(simData.attr('data-internalid-'+orderGroupId));
        dynamicLength();
        function dynamicLength()
        {
            if (carrier == '1') {
                simNewNumber.attr('maxlength', 19);
                return 19;
            } else {
                simNewNumber.attr('maxlength', 20);
                return 20;
            }
        }

        $('#save-sim-details').on('click',function(){

            $('.sim-text').html('');

            $formSim.validate({
                rules: {
                    sim_number_modal:{
                        required : true,
                        number   : true,
                        minlength: dynamicLength,
                        maxlength: dynamicLength
                    }
                },
                messages: {
                    sim_number_modal: {
                        required : 'Please enter your sim number',
                        number   : 'Please enter a valid sim number',
                    }
                },
                errorElement: "em",

                errorPlacement: function( error, element ){
                    $('.sim-text').html(error);
                },
                success: function( label, element ){
                    $(element).removeClass("is-invalid");
                }

            });

            if($formSim.valid()) {

                if (orderGroupId && simNewNumber) {

                    $.ajax({
                        url: '{{ route("edit.sim") }}',
                        method: 'get',
                        data: {
                            'simNewNumber' : simNewNumber.val(),
                            'orderGroupId' : orderGroupId
                        },
                        beforeSend: ()=> {
                            $('.myOverlay').removeClass('d-none');
                            $('.loadingGIF').removeClass('d-none');
                            simData.attr('data-internalid-'+orderGroupId, simNewNumber.val());
                            $('.sim_num_'+orderGroupId).html('SIM: '+simNewNumber.val());
                        },
                        complete: ()=>{
                            $('.myOverlay').addClass('d-none');
                            $('.loadingGIF').addClass('d-none');
                            orderGroupId = null;
                            $('#simEditModal').modal('hide');
                        },

                    });

                }

            }

        });

        $('#close-sim-modal').on('click', ()=>{
            orderGroupId = null;
        });

        $('#simEditModal').on('hidden.bs.modal', function () {
            orderGroupId = null;
        });

    });

    let verificationHash = window.location.href.includes('verification_hash'),
        sessionId        = @json(session('id'));
    if (verificationHash && !sessionId) {
        $('.remove-cartItem').css('display', 'none');
        $('.remove-dummy').css('display', 'inline');
    } else {
        $('.remove-cartItem').css('display', 'inline');
        $('.remove-dummy').css('display', 'none');
    }


    window['_fs_debug'] = false;
    window['_fs_host'] = 'fullstory.com';
    window['_fs_org'] = 'P2WH6';
    window['_fs_namespace'] = 'FS';
    (function(m,n,e,t,l,o,g,y){
        if (e in m) {if(m.console && m.console.log) { m.console.log('FullStory namespace conflict. Please set window["_fs_namespace"].');} return;}
        g=m[e]=function(a,b,s){g.q?g.q.push([a,b,s]):g._api(a,b,s);};g.q=[];
        o=n.createElement(t);o.async=1;o.crossOrigin='anonymous';o.src='https://'+_fs_host+'/s/fs.js';
        y=n.getElementsByTagName(t)[0];y.parentNode.insertBefore(o,y);
        g.identify=function(i,v,s){g(l,{uid:i},s);if(v)g(l,v,s)};g.setUserVars=function(v,s){g(l,v,s)};g.event=function(i,v,s){g('event',{n:i,p:v},s)};
        g.shutdown=function(){g("rec",!1)};g.restart=function(){g("rec",!0)};
        g.log = function(a,b) { g("log", [a,b]) };
        g.consent=function(a){g("consent",!arguments.length||a)};
        g.identifyAccount=function(i,v){o='account';v=v||{};v.acctId=i;g(o,v)};
        g.clearUserCookie=function(){};
    })(window,document,window['_fs_namespace'],'script','user');

</script>

@if (session('login-status'))
    <script>
        $(function(){
            $(".dropdown").addClass("open");
        })
    </script>
@endif

@stack('js')

@include('layouts.partials._analytics')

</body>
</html>
