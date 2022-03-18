<div class="confirm-summary">

    <div class="summary-item">
        <div class="row">

            <div class="col-sm-6 col-xs-12" style='width: 100%'>
                @if ($cart['device'] != null)
                    <div class="img-wrap">
                        <img src="{{ $cart['device']['primary_image'] ?: asset('imgs/placeholders/default.png') }}" alt="">
                    </div>
                @endif

                <div class="confirm-calculation pull-right">
                    <table>
                        <tr>
                            <td>
                                @isset($cart['device'])
                                    @if ($cart['device'] === 0)
                                        <strong class="device-name">Bringing Own device</strong>
                                    @else
                                        <strong>{{ $cart['device']['name'] }}</strong>
                                    @endif
                                @endisset
                            </td>
                            <td style='white-space:nowrap;'>
                                @if($cart['device'] != null)
                                    <strong>
                                        @isset($cart['device'])
                                            @if ($cart['plan'] == null)
                                                @if ($activeGroupID == $cart['id'])
                                                    $ @convert($cart['device']['amount_w_plan'])
                                                @else
                                                    $ @convert($cart['device']['amount'])
                                                @endif
                                            @else
                                                $ @convert($cart['device']['amount_w_plan'])
                                            @endif
                                        @endisset
                                    </strong>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @isset($cart['plan'])
                                    Plan:
                                        <strong class="text-violet">{{ $cart['plan']['name'] }}</strong>
                                @endisset
                            </td>
                            <td style='white-space:nowrap;'>
                                @isset($cart['plan'])
                                    <strong>
                                        @if (!$cart['plan_prorated_amt'])
                                            $ @convert($cart['plan']['amount_recurring'])/mo
                                        @else
                                            $ @convert($cart['plan_prorated_amt'])
                                        @endif
                                    </strong>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @isset($cart['sim'])
                                    Sim Card: <strong> {{ $cart['sim']['name'] }} </strong>
                                @endisset
                            </td>
                            <td style='white-space:nowrap;'>
                                @isset($cart['sim'])
                                    @if ($cart['plan'] != null)
                                        $ @convert($cart['sim']['amount_w_plan'])
                                    @elseif ($cart['plan'] == null)
                                        $ @convert($cart['sim']['amount_alone'])
                                    @endif
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @isset($cart['addons'])
                                    @foreach ($cart['addons'] as $addon)
                                        <div>
                                            @if ($addon['prorated_amt'] && $addon['prorated_amt'] ==0)
                                                Addon: <strong> {{ $addon['name'] }} </strong> (REMOVED)
                                            @else
                                                Addon:{{ $addon['name'] }}
                                            @endif
                                        </div> <br> <br>
                                    @endforeach
                                @endisset
                            </td>
                            <td>
                                @isset($cart['addons'])
                                    @foreach ($cart['addons'] as $addon)
                                        <div>
                                            @if (!$addon['prorated_amt'])
                                                $ @convert($addon['amount_recurring'])/mo
                                            @else
                                                $ @convert($addon['prorated_amt'])
                                            @endif
                                        </div> <br> <br>
                                    @endforeach
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @isset ($cart['plan']['amount_onetime'])
                                    <strong>Activation Fee</strong>
                                @endisset
                            </td>
                            <td style='white-space:nowrap;'>
                                @isset ($cart['plan']['amount_onetime'])
                                    $
                                    @if($cart['plan']['amount_onetime']== 0)
                                        0
                                    @else
                                        @convert($cart['plan']['amount_onetime'])
                                    @endif
                                @endisset
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
