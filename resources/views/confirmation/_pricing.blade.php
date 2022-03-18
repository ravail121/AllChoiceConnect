<div class="confirm-summary">

    <div class="summary-item">
        <div class="row">

            <div class="col-sm-6 col-xs-12">
                @if ($cart['device'] != null)
                    <div class="img-wrap">
                        <img src="{{ $cart['device']['primary_image'] ?: asset('imgs/placeholders/default.png') }}" alt="">
                    </div>
                @endif

                <div class="info">

                    @if($cart['device'] != null)
                        <h5 class="device-name">{{ $cart['device']['name'] }}</h5>
                    @elseif($cart['device'] === 0)
                        <h5 class="device-name">Bringing Own device</h5>
                    @endif

                    @if($cart['device'] != null)
                        <p>Device: {{ $cart['device']['name'] }}</p>
                    @elseif($cart['device'] === 0)
                        <p>Device: Own Device</p>
                    @endif

                    @isset($cart['plan'])
                        <p>Plan: <span class="text-violet">{{ $cart['plan']['name'] }}</span></p>
                    @endisset
                    @isset($cart['sim'])
                        {{-- <div class="img-wrap">
                            <img src="{{ $cart['sim']['image'] ?: asset('imgs/placeholders/default.png') }}" alt="" height="70px" width="100px">
                        </div> --}}
                        <p>Sim Card: {{ $cart['sim']['name'] }}</p>
                    @endisset
                    @isset($cart['addons'])
                        @foreach ($cart['addons'] as $addon)
                            @if ($addon['prorated_amt'] && $addon['prorated_amt'] ==0)
                                <p>Addon:{{ $addon['name'] }} (REMOVED)</p>
                            @else
                                <p>Addon:{{ $addon['name'] }}</p>
                            @endif
                        @endforeach
                    @endisset

                    @if (isset($cart['plan']['amount_onetime']) && $cart['plan']['amount_onetime'])
                        <p>
                            Activation Fee
                        </p>
                    @endisset
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                @if($cart['device'] === null)
                <div class="pricing padding-none">
                @else
                <div style='margin-top:10px' class="pricing">
                @endif

                    @isset($cart['device'])
                        @if ($cart['plan'] == null)
                            @if ($activeGroupID == $cart['id'])
                                <p>$ @convert($cart['device']['amount_w_plan'])
                            @else
                                <p>$ @convert($cart['device']['amount'])</p>
                            @endif
                        @else
                            <p>$ @convert($cart['device']['amount_w_plan'])</p>
                        @endif
                    @endisset

                    @isset($cart['plan'])
                        @if (!$cart['plan_prorated_amt'])
                            <p>$ @convert($cart['plan']['amount_recurring'])/mo</p>
                        @else
                            <p>$ @convert($cart['plan_prorated_amt']) </p>
                        @endif
                    @endisset

                    @isset($cart['sim'])
                        @if ($cart['plan'] != null)
                            <p>$ @convert($cart['sim']['amount_w_plan'])</p>

                        @elseif ($cart['plan'] == null)
                            <p>$ @convert($cart['sim']['amount_alone'])</p>
                        @endif

                    @endisset

                    @isset($cart['addons'])
                        @foreach ($cart['addons'] as $addon)
                            @if (!$addon['prorated_amt'])
                                <p>$ @convert($addon['amount_recurring'])/mo</p>
                            @else
                                <p>$ @convert($addon['prorated_amt'])</p>
                            @endif
                        @endforeach
                    @endisset

                    @isset($cart['plan']['amount_onetime'])
                        <p>
                            @if($cart['plan']['amount_onetime'])
                                $ @convert($cart['plan']['amount_onetime'])
                            @endif
                        </p>
                    @endisset
                </div>
            </div>

        </div>
    </div>

    {{-- <div class="summary-item">
        <div class="row">

            <div class="col-sm-6 col-xs-12">
                <div class="img-wrap">
                    <img src="images/summary-img-02.png">
                </div>
                <div class="info">
                    <h5 class="device-name">Samsung Galaxy S7 Edge</h5>
                    <p>Plan: <span class="text-violet">2GB</span></p>
                    <p>Sim Card: 3-in-1</p>
                    <p>Add-On(s): International Calling</p>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="pricing">
                    <p>$340.95</p>
                    <p>$20/mo</p>
                    <p>$15.00</p>
                </div>
            </div>

        </div>
    </div>

    <div class="summary-item">
        <div class="row">

            <div class="col-sm-6 col-xs-12">
                <div class="img-wrap">
                    <img src="images/summary-img-03.png">
                </div>
                <div class="info">
                    <h5 class="device-name">Samsumg Galaxy S9</h5>
                    <p>Plan: <span class="text-violet">2GB</span></p>
                    <p>Sim Card: 3-in-1</p>
                    <p>Add-On(s): International Calling</p>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="pricing">
                    <p>$340.95</p>
                    <p>$20/mo</p>
                    <p>$15.00</p>
                </div>
            </div>

        </div>
    </div> --}}

</div>
