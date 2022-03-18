@extends('layouts.app')

@section('content')
	<!-- content -->
	<section class="choose-device-content">
		<div class="container">
			@include('processes.process-steps')
			<div class="row no-margin pad-top-10 text-center">
				<h1 style='text-align:center' class="content-title-modified">Start Your Business Package By Choosing Your Wireless Solution Below.</h1>
				<p class="t-gray-2 bold f14 add-top-35">All accounts are bundled with our powerful business Cloud-phone service.</p>

				<div class="add-top-6 xs-add-top-4">
                    <!-- Nav tabs -->
		            <ul class="nav nav-tabs" id="chooseDeviceTab" role="tablist">
                        <li role="presentation" class='active tablets-button'><a href="#tablets" aria-controls="home" role="tab" data-toggle="tab">Tablets</a></li>
                        <li role="presentation" class="phones-button"><a href="#phones" aria-controls="profile" role="tab" data-toggle="tab">Phones</a></li>
    				    <li role="presentation" class='accessories-button'><a href="#accessories" aria-controls="messages" role="tab" data-toggle="tab">Accessories</a></li>
    				</ul>
				    <!-- Tab panes -->
				    <div class="tab-content pad-top-3">
    				    <div role="tabpanel" class="tab-pane active" id="tablets">
    				    	<div class="device-wrap">
                                @if ($data != null)
                                    @foreach($data['devices'] as $key => $devices)
                                        @if($devices['show'] == 1 || $devices['show'] == 2)
                                            @if($devices['type'] == 2)

                    				    		<div class="col-md-4 col-sm-12 item{{ (in_array($devices['id'], $checkSession)) ? ' added' : '' }}">

                    				    			<div class="item-wrap">
                    				    				<div class="triangle">
                    					    				<i class="fa fa-check"></i>
                    					    			</div>
                    					    			<div class="row">
                    					    				<div class="col-lg-12 col-md-12 col-sm-5 col-xs-5 xs-pad-left xs-pad-right">
                    					    					<div class="img-wrap">
                    						    					<img src="{{ $devices['primary_image'] ?: asset('imgs/placeholders/default-tablet.png') }}" alt="">
                    						    				</div>
                    					    				</div>
                    					    				<div style="margin-bottom: 10px;" class=" devdd_name col-lg-12 col-md-12 col-sm-7 col-xs-7 xs-pad-left xs-pad-right">
                    						    				<h5 class="device-name{{ ($devices['description']) ? '' : ' add-device-line-height' }}">{{ $devices['name'] }}</h5>
                                                                {{-- {!! str_limit($devices['description'], 33, '<ul><li class="desc">....</li></ul>') !!} --}}
                                                                @if (preg_match('#<\s*\b[^>]*>(.*?)<//*\b[^>]*>#s', $devices['description'], $matches))
                                                                    @if(strlen(strip_tags($matches[0])) >33)
                                                                        {{ substr(strip_tags($matches[0]), 0, strpos(strip_tags($matches[0])," ", 33)?: strlen(strip_tags($matches[0]))) }}
                                                                    @else
                                                                        {{ substr(strip_tags($matches[0]), 0, 33) }}
                                                                    @endif
                                                                @endif
                                                                @if (strlen(strip_tags($devices['description'])) > 33)
                                                                    <br><span style="opacity: 0.7">...</span>
                                                                @endif
                    						    				{{-- <p class="desc">Excludes ports from T-Mobile</p> --}}
                    						    				{{-- <p class="desc req">
                    						    					<i class="fa fa-power-off"></i>
                    												Requires new activation
                    											</p> --}}
                                                            </div>
                											<div class="price-wrap">
                												<span class="sign">$</span>
                												<span class="price">{{ $devices['amount_w_plan'] }}</span>
                												<span class="month">
                													<i>with</i>
                													<i>PLAN</i>
                												</span>
                                                                <div class="text-center without-price">
                                                                    <span class="sign">$</span>
                                                                    <span class="price">{{ $devices['amount'] }}</span>
                                                                    <span class="month">w/o PLAN</span>
                                                                </div>
                                                                <div class="clearfix add-top"></div>
                                                                @if($devices['show'] == 2)
                                                                    <p class="desc" style="margin-top: 10px;">Coming Soon</p>
                                                                @else
                                                                <a href="#" class="btn style2 device-btn" data-id="{{ $devices['id'] }}" data-name="{{ $devices['name'] }}" data-description="{{ $devices['description'] }}" data-type="{{ $devices['type'] }}" data-amount="{{ $devices['amount'] }}" data-amount_with_plan="{{ ($devices['amount_w_plan'] != null) ? $devices['amount_w_plan'] : '0.00' }}" data-toggle="modal" data-target="#modalDevice" id='device-{{ $devices['id'] }}' data-associate_with_plan="{{ $devices['associate_with_plan'] }}">
                                                                        Add Device
                                                                        {{-- {{ (in_array($devices['id'], $checkSession)) ? ' Device Added' : 'View More' }} --}}
                                                                    </a>
                                                                @endif
                    					    				</div>
                    					    			</div>
                    				    			</div>
                    				    		</div>
                                            @endif
                                        @endif
                                    @endforeach

                                    @if (count($data['sims']))
                                        @foreach ($data['sims'] as $sim)
                                            <div class="col-md-4 col-sm-12 item">
                                                <div class="item-wrap">
                                                    <div class="triangle">
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-5 col-xs-5 xs-pad-left xs-pad-right">
                                                            <div class="img-wrap">
                                                                <img src="{{ $sim['image'] ?: asset('imgs/placeholders/default-sim.png') }}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-7 col-xs-7 xs-pad-left xs-pad-right">
                                                            <h5 class="device-name{{ ($sim['description']) ? '' : ' add-device-line-height' }}">{{ $sim['name'] }}</h5>
                                                            {{-- {!! str_limit($sim['description'], 33, '<ul><li class="desc">....</li></ul>') !!} --}}
                                                            @if (preg_match('#<\s*\b[^>]*>(.*?)<//*\b[^>]*>#s', $sim['description'], $matches))
                                                                @if(strlen(strip_tags($matches[0])) >33)
                                                                    {{ substr(strip_tags($matches[0]), 0, strpos(strip_tags($matches[0])," ", 33)?: strlen(strip_tags($matches[0]))) }}
                                                                @else
                                                                    {{ substr(strip_tags($matches[0]), 0, 33) }}
                                                                @endif
                                                            @endif
                                                            @if (strlen(strip_tags($sim['description'])) > 33)
                                                                <br><span style="opacity: 0.7">...</span>
                                                            @endif
                                                            {{-- <p class="desc">Excludes ports from T-Mobile</p> --}}
                                                            {{-- <p class="desc req">
                                                                <i class="fa fa-power-off"></i>
                                                                Requires new activation
                                                            </p> --}}
                                                        </div>
                                                        <div class="price-wrap">
                                                            <span class="sign">$</span>
                                                            <span class="price">{{ $sim['amount'] }}</span>
                                                            <span class="month">
                                                                <i>full</i>
                                                                <i>PRICE</i>
                                                            </span>

                                                            <div class="clearfix add-top"></div>

                                                            @if($sim['show'] == 2)
                                                                <p class="desc" style="margin-top: 10px;">Coming Soon</p>
                                                            @else
                                                            <a href="#" class="btn style2 sim-btn" data-id="{{ $sim['id'] }}" data-name="{{ $sim['name'] }}" data-description="{{ $sim['description'] }}"  data-amount="{{ $sim['amount'] }}"  data-toggle="modal" data-target="#modalSim">
                                                                Add Sim
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    @endif
                                @endif
    				    	</div>
    				    	<div class="add-top-8 xs-add-top-4">
    				    		{{-- <a href="{{ route('devices.create') }}" class="btn style2">Bring Your Own Device</a> --}}
                                <a href="{{ route('devices.create') }}" class="btn style2 own-device">Bring Your Own Device</a>
    				    	</div>
    				    </div>
    				    <div role="tabpanel" class="tab-pane" id="phones">
    				    	<div class="device-wrap">
                                @isset ($data)
                                    @foreach($data['devices'] as $key => $devices)
                                        @if($devices['show'] == 1 || $devices['show'] == 2)
                                            @if($devices['type'] == 0 || $devices['type'] == 1)
                    				    		<div class="col-md-4 col-sm-12 item{{ (in_array($devices['id'], $checkSession)) ? ' added' : '' }}">

                    				    			<div class="item-wrap">
                    				    				<div class="triangle">
                    					    				<i class="fa fa-check"></i>
                    					    			</div>
                    					    			<div class="row">
                    					    				<div class="col-lg-12 col-md-12 col-sm-5 col-xs-5 xs-pad-left xs-pad-right">
                    					    					<div class="img-wrap">
                    						    					<img src="{{ $devices['primary_image'] ?: asset('imgs/placeholders/default-phone.png') }}" alt="">
                    						    				</div>
                    					    				</div>
                    					    				<div style="margin-bottom: 10px;" style="margin-bottom: 10px;" class="col-lg-12 col-md-12 col-sm-7 col-xs-7 xs-pad-left xs-pad-right">
                                                                <h5 class="device-name{{ ($devices['description']) ? '' : ' add-device-line-height' }}">{{ $devices['name'] }}</h5>
                                                                {{-- {!! str_limit($devices['description'], 33, '<ul><li class="desc">....</li></ul>') !!} --}}
                                                                @if (preg_match('#<\s*\b[^>]*>(.*?)<//*\b[^>]*>#s', $devices['description'], $matches))
                                                                    @if(strlen(strip_tags($matches[0])) >33)
                                                                        {{ substr(strip_tags($matches[0]), 0, strpos(strip_tags($matches[0])," ", 33)?: strlen(strip_tags($matches[0]))) }}
                                                                    @else
                                                                        {{ substr(strip_tags($matches[0]), 0, 33) }}
                                                                    @endif
                                                                @endif
                                                                @if (strlen(strip_tags($devices['description'])) > 33)
                                                                    <br><span style="opacity: 0.7">...</span>
                                                                @endif
                                                                {{-- <p class="desc">Excludes ports from T-Mobile</p> --}}
                                                                {{-- <p class="desc req">
                                                                    <i class="fa fa-power-off"></i>
                                                                    Requires new activation
                                                                </p> --}}
                                                            </div>
                                                            <div class="price-wrap">
                                                                <span class="sign">$</span>
                                                                <span class="price">{{ $devices['amount_w_plan'] }}</span>
                                                                <span class="month">
                                                                    <i>with</i>
                                                                    <i>PLAN</i>
                                                                </span>
                                                                <div class="text-center without-price">
                                                                    <span class="sign">$</span>
                                                                    <span class="price">{{ $devices['amount'] }}</span>
                                                                    <span class="month">w/o PLAN</span>
                                                                </div>
                                                                <div class="clearfix add-top"></div>
                                                                @if($devices['show'] == 2)
                                                                    <p class="desc" style="margin-top: 10px;">Coming Soon</p>
                                                                @else
                                                                    <a href="#" class="btn style2 device-btn" data-id="{{ $devices['id'] }}" data-name="{{ $devices['name'] }}" data-description="{{ $devices['description'] }}" data-type="{{ $devices['type'] }}" data-amount="{{ $devices['amount'] }}" data-amount_with_plan="{{ ($devices['amount_w_plan'] != null) ? $devices['amount_w_plan'] : '0.00' }}" data-toggle="modal" data-target="#modalDevice"  id='device-{{ $devices['id'] }}' data-associate_with_plan="{{ $devices['associate_with_plan'] }}">
                                                                        Add Device
                                                                        {{-- {{ (in_array($devices['id'], $checkSession)) ? ' Device Added' : 'View More' }} --}}
                                                                    </a>
                                                                @endif
                                                            </div>
                    					    			</div>
                    				    			</div>
                    				    		</div>
                                            @endif
                                        @endif
                                    @endforeach
                                    @if (count($data['sims']))
                                        @foreach ($data['sims'] as $sim)
                                            <div class="col-md-4 col-sm-12 item">
                                                <div class="item-wrap">
                                                    <div class="triangle">
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-5 col-xs-5 xs-pad-left xs-pad-right">
                                                            <div class="img-wrap">
                                                                <img src="{{ $sim['image'] ?: asset('imgs/placeholders/default-sim.png') }}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-7 col-xs-7 xs-pad-left xs-pad-right">
                                                            <h5 class="device-name{{ ($sim['description']) ? '' : ' add-device-line-height' }}">{{ $sim['name'] }}</h5>
                                                            {{-- {!! str_limit($sim['description'], 33, '<ul><li class="desc">....</li></ul>') !!} --}}
                                                            @if (preg_match('#<\s*\b[^>]*>(.*?)<//*\b[^>]*>#s', $sim['description'], $matches))
                                                                @if(strlen(strip_tags($matches[0])) >33)
                                                                    {{ substr(strip_tags($matches[0]), 0, strpos(strip_tags($matches[0])," ", 33)?: strlen(strip_tags($matches[0]))) }}
                                                                @else
                                                                    {{ substr(strip_tags($matches[0]), 0, 33) }}
                                                                @endif
                                                            @endif
                                                            @if (strlen(strip_tags($sim['description'])) > 33)
                                                                <br><span style="opacity: 0.7">...</span>
                                                            @endif
                                                        </div>
                                                        <div class="price-wrap">
                                                            <span class="sign">$</span>
                                                            <span class="price">{{ $sim['amount'] }}</span>
                                                            <span class="month">
                                                                <i>full</i>
                                                                <i>PRICE</i>
                                                            </span>

                                                            <div class="clearfix add-top"></div>

                                                            @if($sim['show'] == 2)
                                                                <p class="desc" style="margin-top: 10px;">Coming Soon</p>
                                                            @else
                                                            <a href="#" class="btn style2 sim-btn" data-id="{{ $sim['id'] }}" data-name="{{ $sim['name'] }}" data-description="{{ $sim['description'] }}"  data-amount="{{ $sim['amount'] }}"  data-toggle="modal" data-target="#modalSim">
                                                                Add Sim
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    @endif
                                @endisset
    				    	</div>
    				    	<div class="add-top-8 xs-add-top-4">
    				    		{{-- <a href="{{ route('devices.create') }}" class="btn style2">Bring Your Own Device</a> --}}
                                <a href="{{ route('devices.create') }}" class="btn style2 own-device">Bring Your Own Device</a>
    				    	</div>
    				    </div>
    				    <div role="tabpanel" class="tab-pane" id="accessories">
    				    	<div class="device-wrap">
                                @isset ($data)
                                    @foreach($data['devices'] as $key => $devices)
                                        @if($devices['show'] == 1 || $devices['show'] == 2)
                                            @if($devices['type'] == 8)
                    				    		<div class="col-md-4 col-sm-12 item{{ (in_array($devices['id'], $checkSession)) ? ' added' : '' }}">

                    				    			<div class="item-wrap">
                    				    				<div class="triangle">
                    					    				<i class="fa fa-check"></i>
                    					    			</div>
                    					    			<div class="row">
                    					    				<div class="col-lg-12 col-md-12 col-sm-5 col-xs-5 xs-pad-left xs-pad-right">
                    					    					<div class="img-wrap">
                    						    					<img src="{{ $devices['primary_image'] ?: asset('imgs/placeholders/default-accessories.png') }}" alt="">
                    						    				</div>
                    					    				</div>
                    					    				<div style="margin-bottom: 10px;" class="col-lg-12 col-md-12 col-sm-7 col-xs-7 xs-pad-left xs-pad-right">
                                                                <h5 class="device-name{{ ($devices['description']) ? '' : ' add-device-line-height' }}">{{ $devices['name'] }}</h5>
                                                                {{-- {!! str_limit($devices['description'], 33, '<ul><li class="desc">....</li></ul>') !!} --}}
                                                                @if (preg_match('#<\s*\b[^>]*>(.*?)<//*\b[^>]*>#s', $devices['description'], $matches))
                                                                    @if(strlen(strip_tags($matches[0])) >33)
                                                                        {{ substr(strip_tags($matches[0]), 0, strpos(strip_tags($matches[0])," ", 33)?: strlen(strip_tags($matches[0]))) }}
                                                                    @else
                                                                        {{ substr(strip_tags($matches[0]), 0, 33) }}
                                                                    @endif
                                                                @endif
                                                                @if (strlen(strip_tags($devices['description'])) > 33)
                                                                    <br><span style="opacity: 0.7">...</span>
                                                                @endif
                                                                {{-- <p class="desc">Excludes ports from T-Mobile</p> --}}
                                                                {{-- <p class="desc req">
                                                                    <i class="fa fa-power-off"></i>
                                                                    Requires new activation
                                                                </p> --}}
                                                            </div>
                                                            <div class="price-wrap">
                                                                <span class="sign">$</span>
                                                                <span class="price">{{ $devices['amount'] }}</span>
                                                                {{-- <span class="month">
                                                                    <i>with</i>
                                                                    <i>PLAN</i>
                                                                </span>
                                                                <div class="text-center without-price">
                                                                    <span class="sign">$</span>
                                                                    <span class="price">{{ $devices['amount'] }}</span>
                                                                    <span class="month">w/o PLAN</span>
                                                                </div> --}}
                                                                <div class="clearfix add-top"></div>
                                                                @if($devices['show'] == 2)
                                                                    <p class="desc" style="margin-top: 10px;">Coming Soon</p>
                                                                @else
                                                                    <a href="#" class="btn style2 device-btn" data-id="{{ $devices['id'] }}" data-name="{{ $devices['name'] }}" data-description="{{ $devices['description'] }}" data-type="{{ $devices['type'] }}" data-amount="{{ $devices['amount'] }}" data-amount_with_plan="{{ ($devices['amount_w_plan'] != null) ? $devices['amount_w_plan'] : '0.00' }}" data-toggle="modal" data-target="#modalDevice"  id='device-{{ $devices['id'] }}' data-associate_with_plan="{{ $devices['associate_with_plan'] }}">
                                                                        Add Device
                                                                        {{-- {{ (in_array($devices['id'], $checkSession)) ? ' Device Added' : 'View More' }} --}}
                                                                    </a>
                                                                @endif
                                                            </div>
                    					    			</div>
                    				    			</div>
                    				    		</div>
                                            @endif
                                        @endif
                                    @endforeach
                                @endisset
    				    	</div>
    				    	<div class="add-top-8 xs-add-top-4">
    				    		<a href="{{ route('devices.create') }}" class="btn style2 own-device">Bring Your Own Device</a>
    				    	</div>
    				    </div>
				    </div>
				</div>
			</div>
        </div>

	</section>
	<!-- end content -->


	@include('modals.sim')
    @include('modals.device')

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> --}}

@endsection

@section('footerCart')
    @include('cart.footer-mobile-cart-items')

@endsection

@push('js')
    <script>
        $(function(){

            var devciesData, sessionCart, device, sims;

            devciesData = @json($data);
            sessionCart = @json($sessionCart);

            // WHen data is filtered on based on already selected plan,
            // It returns an object that needs to be converted to array
            device  = Object.values(devciesData.devices);
            sims    = devciesData.sims;

            const $deviceBtn                 = $('.device-btn'),
                  $simBtn                    = $('.sim-btn'),
                  $noMargin                  = $('.no-margin > ul');
                  $changeStyleOfDescription  = $('.item-wrap').find('.row').find('ul > li');

            $noMargin.addClass('step1');
            $changeStyleOfDescription.addClass('desc');

            openAdditionalModal();

            $('.add-top-8.xs-add-top-4').find('a.own-device').on('click', function(h) {
                if (sessionCart.length != 0) {

                    var activeGroupId = sessionCart.active_group_id;
                    var orderGroups   = sessionCart.order_groups;

                    for (var k = 0; k < orderGroups.length; k++) {

                        if (activeGroupId == orderGroups[k].id) {

                            var plan   = orderGroups[k].plan;
                            var device = orderGroups[k].device;

                            if (plan != null) {
                                h.preventDefault();
                                $('#additional-form-popup').find('h6.product-type').text(plan.name+' added to cart');

                                $.ajax({
                                    type: 'POST',
                                    url: '{{ route('plans.store') }}',
                                    dataType: 'json',
                                    data:{
                                        plan_id          : plan.id,
                                        bring_own_device : 'yes',

                                    },
                                    success: function (data) {
                                        $('#modalProceed').modal('show');

                                    },
                                    error: function (data) {
                                        console.log('Error: ', data);
                                    }
                                });
                                openAdditionalModal();
                            }
                        }
                    }
                }
            });

            $simBtn.on('click', function(e){
                e.preventDefault();

                const $this              = $(this),
                      $simModal          = $('#modalSim .modal-body'),
                      $images            = $simModal.find('.images').find('.preview.pull-left').find('.img-wrap'),
                      $imagesUL          = $simModal.find('.images > ul'),
                      $imagesList        = $imagesUL.find('li'),
                      $simName        = $simModal.find('.sim-name'),
                      $simDescription = $simModal.find('.tab-content').find('#gb16'),
                      $simId          = $simModal.find('#form-sims').find('input[name="sim_id"]'),
                      $simAmount      = $simModal.find('.price-wrap').find('.price.sim-price');


                var id             = $this.data('id'),
                    name           = $this.data('name'),
                    amount         = $this.data('amount'),
                    description    = $this.data('description'),
                    i, j, simImage, imageDestination, list, imgWrap;



                // $('#modalProceed .modal-body').find('#additional-form-popup').find('input[name="sim_id"]').val(id);
                $('#modalProceed .modal-body').find('#additional-form-popup').find('h6.product-type').text(name+' added to cart');

                openAdditionalModal();

                for (i = 0; i < sims.length; i++) {

                    if (sims[i].id == id) {

                        simImage = sims[i].image;

                        if (!simImage || simImage.length != '') {

                            imageDestination = "{{ asset('imgs/placeholders/default-sim.png') }}" ;

                            list = "<li><a href='#' class='clicker' data-img='"+imageDestination+"'><span class='img-wrap' style='background: url("+imageDestination+") no-repeat;background-size: cover;'><span class='overlay-wrap'></span></span></a></li>";


                            if ($imagesList.length > 0) {
                                $imagesList.remove();
                            }
                            $imagesUL.append(list);

                            imgWrap = "<div class='img-wrap'><img src='"+imageDestination+"' alt=''></div>";
                            $images.replaceWith(imgWrap);

                            $imagesUL.find('li:first').addClass('active');

                        }
                    }
                }

                $simName.text(name);
                $simAmount.text(amount);
                $simDescription.html(description);
                $simDescription.find('ul').addClass('f13 t-black-1 lh-15 regular');

                $simId.val(id);

            });

            $('#modalSim .modal-body').find('#form-sims').find('a.add-to-cart').on('click', function(r){
                r.preventDefault();

                var simId = $('#form-sims').find('input[name="sim_id"]').val();

                insertDevice({ sim_id : simId });


            });

            function insertDevice(data) {
                 $.ajax({
                    type: 'POST',
                    url: '{{ route('insert.device') }}',
                    dataType   : 'json',
                    beforeSend : showLoader,
                    data:data,
                    success: function (data) {

                    },
                    complete: hideLoader,
                    error: function (data) {
                        console.log('Error: ', data);
                    }
                });

                $('#modalProceed').modal('show');
            }

            $('#modalDevice .modal-body').find('#form-plans').find('a.add-to-cart').on('click', function(r){
                r.preventDefault();

                var deviceId = $('#form-plans').find('input[name="device_id"]').val();

                insertDevice({ device_id : deviceId });
            });

            function showLoader() {
                $('.myOverlay').removeClass('d-none');
                $('.loadingGIF').removeClass('d-none');
            }

            function hideLoader() {
                $('.myOverlay').addClass('d-none');
                $('.loadingGIF').addClass('d-none');
            }


            $deviceBtn.on('click', function(e){
                e.preventDefault();

                const $this              = $(this),
                      $modal             = $('#modalDevice .modal-body'),
                      $images            = $modal.find('.images').find('.preview.pull-left').find('.img-wrap'),
                      $imagesUL          = $modal.find('.images > ul'),
                      $imagesList        = $imagesUL.find('li'),
                      $deviceName        = $modal.find('.device-name'),
                      $deviceDescription = $modal.find('.tab-content').find('#gb16'),
                      $deviceId          = $modal.find('#form-plans').find('input[name="device_id"]'),
                      $deviceInputName   = $modal.find('#form-plans').find('input[name="device_name"]'),
                      $deviceType        = $modal.find('#form-plans').find('input[name="device_type"]'),
                      $amount            = $modal.find('#form-plans').find('input[name="amount"]'),
                      $amountPlan        = $modal.find('#form-plans').find('input[name="amount_w_plan"]'),
                      $deviceAmount      = $modal.find('.price-wrap').find('.price.without-plan'),
                      $deviceAmountWithPlan = $modal.find('.price-wrap').find('.price.with-plan');



                var id             = $this.data('id'),
                    type           = $this.data('type'),
                    name           = $this.data('name'),
                    amount         = $this.data('amount'),
                    description    = $this.data('description'),
                    amountWithPlan = $this.data('amount_with_plan'),
                    associateWithPlan = $this.data('associate_with_plan'),
                    i, j, image, imageDestination, list, imgWrap, src, descriptionDetail;


                // $('#modalProceed .modal-body').find('#additional-form-popup').find('input[name="device_id"]').val(id);
                $('#modalProceed .modal-body').find('#additional-form-popup').find('h6.product-type').text(name+' added to cart');

                openAdditionalModal();



                const url = ("{{ route('get.plans', ['INSERT_ID_HERE']) }}").replace('INSERT_ID_HERE', id);

                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'json',
                    data:{deviceId:id},
                    beforeSend: showLoader,
                    success: function (data) {
                        var activeGroupId = sessionCart.active_group_id;
                        (associateWithPlan == 2) && !activeGroupId ? $modal.find('#form-plans').find('.add-to-cart-btn').hide() : $modal.find('#form-plans').find('.add-to-cart-btn').show();
                        if (typeof data != 'undefined' && data.length != 0) {
                            $modal.find('#form-plans').find('button[name="with_plan"]').removeClass('d-none');
                            (associateWithPlan == 0) ? $modal.find('#form-plans').find('.add-to-cart-btn').text('Add to cart') : $modal.find('#form-plans').find('.add-to-cart-btn').text('Add to cart without plan');
                            $modal.find('.device-compatable-plan').removeClass('d-none');
                            $modal.find('.device-non-compatable-plan').addClass('d-none');
                        } else {
                            if($modal.find('#form-plans').find('input[name="device_type"]').val() == 8){
                                $modal.find('#form-plans').find('.add-to-cart-btn').text('Add to cart');
                                $modal.find('.device-compatable-plan').addClass('d-none');
                                $modal.find('.device-non-compatable-plan').removeClass('d-none');
                            }else{
                                (associateWithPlan == 0) ? $modal.find('#form-plans').find('.add-to-cart-btn').text('Add to cart') : $modal.find('#form-plans').find('.add-to-cart-btn').text('Add to cart without plan');
                                $modal.find('.device-compatable-plan').removeClass('d-none');
                                $modal.find('.device-non-compatable-plan').addClass('d-none');
                            }
                            $modal.find('#form-plans').find('button[name="with_plan"]').addClass('d-none');

                        }

                        if (sessionCart.length != 0) {

                            var orderGroups   = sessionCart.order_groups;

                            for (var k = 0; k < orderGroups.length; k++) {

                                if (orderGroups[k].id == activeGroupId) {

                                    var plan   = orderGroups[k].plan;
                                    var device = orderGroups[k].device;

                                    if (device == null && plan != null) {

                                        $modal.find('#form-plans').find('button[name="with_plan"]').addClass('d-none');

                                        $modal.find('#form-plans').find('a.add-to-cart').html('Add to cart');

                                    }
                                }
                            }
                        }
                    },
                    complete: hideLoader,
                    error: function (data) {
                        console.log('Error: ', data);
                    }


                });
                /*function showLoader() {
                    $('.myOverlay').removeClass('d-none');
                    $('.loadingGIF').removeClass('d-none');
                }

                function hideLoader() {
                    $('.myOverlay').addClass('d-none');
                    $('.loadingGIF').addClass('d-none');
                }*/

                for (i = 0; i < device.length; i++) {

                    if (device[i].id == id) {

                        image             = device[i].device_image;
                        descriptionDetail = device[i].description_detail;

                        if (!image || image.length == 0) {

                            if (type == 1) {

                                imageDestination = "{{ asset('imgs/placeholders/default-phone.png') }}" ;
                            } else if (type == 2) {
                                imageDestination = "{{ asset('imgs/placeholders/default-tablet.png') }}" ;

                            } else if (type == 3) {
                                imageDestination = "{{ asset('imgs/placeholders/default-accessories.png') }}" ;

                            } else {
                                imageDestination = "{{ asset('imgs/placeholders/default.png') }}" ;
                            }

                            list = "<li><a href='#' class='clicker' data-img='"+imageDestination+"'><span class='img-wrap' style='background: url("+imageDestination+") no-repeat;background-size: cover;'><span class='overlay-wrap'></span></span></a></li>";


                            if ($imagesList.length > 0) {
                                $imagesList.remove();
                            }
                            $imagesUL.append(list);

                            imgWrap = "<div class='img-wrap'><img src='"+imageDestination+"' alt=''></div>";
                            $images.replaceWith(imgWrap);

                            $imagesUL.find('li:first').addClass('active');

                        }


                        for (j = 0; j < image.length; j++) {

                            imageDestination = image[j].source;

                            if (image[j].source == '') {
                                if (type == 1) {

                                    imageDestination = "{{ asset('imgs/placeholders/default-phone.png') }}" ;
                                } else if (type == 2) {
                                    imageDestination = "{{ asset('imgs/placeholders/default-tablet.png') }}" ;

                                } else if (type == 3) {
                                    imageDestination = "{{ asset('imgs/placeholders/default-accessories.png') }}" ;

                                } else {
                                    imageDestination = "{{ asset('imgs/placeholders/default.png') }}" ;
                                }
                            }

                            list = "<li><a href='#' class='clicker' data-img='"+imageDestination+"'><span class='img-wrap' style='background: url("+imageDestination+") no-repeat;background-size: cover;'><span class='overlay-wrap'></span></span></a></li>";


                            if ($imagesList.length > 0) {
                                $imagesList.remove();
                            }

                            $imagesUL.append(list);


                            imgWrap = "<div class='img-wrap'><img src='"+imageDestination+"' alt=''></div>";
                            $images.replaceWith(imgWrap);

                            $imagesUL.find('li:first').addClass('active');
                        }


                        // if ($modal.find('.row.add-top-55.specifications').length == 0) {
                        //     $modal.append(descriptionDetail);

                        // } else {
                        //     $modal.find('.row.add-top-55.specifications').replaceWith(descriptionDetail);

                        // }
                        // if (descriptionDetail == '') {
                        //     $modal.find('.row.add-top-55.specifications').remove();
                        // }
                        $(".device-description-detail").html(descriptionDetail);
                    }
                }

                $deviceName.text(name);
                $deviceAmount.text(amount);
                $deviceDescription.html(description);
                $deviceDescription.find('ul').addClass('f13 t-black-1 lh-15 regular');
                $deviceAmountWithPlan.text(amountWithPlan);

                $deviceId.val(id);
                $deviceType.val(type);
                $deviceInputName.val(name);
                $amount.val(amount);
                $amountPlan.val(amountWithPlan);


			});

            function openAdditionalModal()
            {

                $('#modalProceed .modal-body').find('#additional-form-popup').find('a').on('click', function(e){

                    e.preventDefault();


                    const $this      = $(this),
                          $formPopup = $('#additional-form-popup');
                    var inputField;

                    $formPopup.find('input[name="select_plans"]').remove();
                    $formPopup.find('input[name="select_devices"]').remove();
                    $formPopup.find('input[name="checkout"]').remove();


                    if ($this.hasClass('select-plans')) {
                        inputField = '<input type="hidden" name="select_plans" value="select_plans">';

                    } else if ($this.hasClass('select-devices')) {
                        inputField = '<input type="hidden" name="select_devices" value="select_devices">';

                    } else if ($this.hasClass('checkout')) {
                        inputField = '<input type="hidden" name="checkout" value="checkout">';
                    }

                    $formPopup.append(inputField);
                    $formPopup.submit();

                });

            }
		});

        var totalDueCart    = $('.total-due-cart');

        let activeGroupId = @json(isset(session('cart')['active_group_id']) ? session('cart')['active_group_id'] : 'null'),
            orderGroups   = @json(session('cart')['order_groups']),
            tablets       = $('#tablets'),
            phones        = $('#phones'),
            accessories   = $('#accessories'),
            tabLinks      = $('#chooseDeviceTab');

        if (orderGroups) {
            for (let i = 0; i < orderGroups.length; i++) {
                let og = orderGroups[i];
                if (og['id'] == activeGroupId) {
                    if (og['plan']) {
                        let type = og['plan']['type'];
                        if (type == 1) {
                            tabLinks.find('.phones-button').addClass('active');
                            tabLinks.find('.tablets-button').removeClass('active');
                            tabLinks.find('.accessories-button').removeClass('accessories-button');
                            tablets.removeClass('active');
                            phones.addClass('active');
                            accessories.removeClass('active');
                        } else if (type == 2) {
                            tabLinks.find('.phones-button').removeClass('active');
                            tabLinks.find('.tablets-button').addClass('active');
                            tabLinks.find('.accessories-button').removeClass('accessories-button');
                            tablets.addClass('active');
                            phones.removeClass('active');
                            accessories.removeClass('active');
                        }
                    }
                }
            }
        }
	</script>
@endpush
