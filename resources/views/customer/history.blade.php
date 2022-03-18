@extends('layouts.app')
<!-- end header -->

<!-- content -->
@section('content')

<section class="cp">
    <div class="wrapper">

        @include('customer._sidebar')

        <div class="cp-sections">

            <section class="cp-history cp-section section-billing">
                <h1>Billing History</h1>

                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Notes</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($billingDetails as $key => $billingDetail)
                                    <tr>
                                        <td>
                                            {{ $billingDetail['created_at_formatted_with_time'] }}
                                        </td>
                                        <td>{{ $billingDetail['type_description'] }}</td>
                                        <td>NA</td>
                                        @if(isset($billingDetail['subtotal']))
                                            <td><strong>-$@convert($billingDetail['subtotal'])</strong></td>
                                            @isset($billingDetail['order'])
                                                <td><a href={{ $url }}{{ $billingDetail['order']['hash'] }}>Download</a></td>
                                            @else
                                                <td><a href={{ $invoiceUrl }}{{ bin2hex('invoice='.$billingDetail['id']) }}>Download</a></td>
                                            @endisset
                                        @else
                                            <td><strong>
                                                $@convert($billingDetail['amount'])
                                            </strong></td>
                                            @if(isset($billingDetail['invoice']))
                                            <td><a href={{ $invoiceUrl }}{{ bin2hex('invoice='.$billingDetail['invoice']['id']) }}>Download</a></td>
                                            @else
                                            <td></td>
                                            @endif
                                        @endif
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="cp-history cp-section section-orders">
                <h1>Orders</h1>

                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Order Date</th>
                                <th>Amount</th>
                                <th>Details</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($customer['orders'] as $key => $order)
                                @if ($order['invoice']['subtotal'] && $order['invoice']['type'] != 1)
                                    <tr>
                                        <td><a href="#">{{ $order['order_num'] }}</a></td>
                                        <td>
                                            {{ $order['created_at'] }}
                                        </td>
                                        <td><strong>${{ $order['invoice']['subtotal'] }}</strong></td>
                                        <td><a href="#" class="show">show</a></td>
                                    </tr>
                                    <tr class="hidden-details hide">
                                        <td colspan="6">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Shipping Date</th>
                                                        <th>Tracking Number</th>
                                                        <th>Device Name</th>
                                                        <th>Plans</th>
                                                        <th>SIMs</th>
                                                        <th>Add-ons</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order['all_order_group'] as $group => $orderGroup)
                                                        <tr>
                                                            @if (isset($orderGroup['plan']['subscription']))
                                                                <td>
                                                                    {{ $orderGroup['plan']['subscription']['shipping_date'] }}
                                                                </td>
                                                                <td>
                                                                    {{ $orderGroup['plan']['subscription']['tracking_num'] }}
                                                                </td>
                                                            @elseif (isset($orderGroup['device']))
                                                                <td>
                                                                    {{ $orderGroup['device']['customer_standalone_device']['shipping_date'] }}
                                                                </td>
                                                                <td>
                                                                    {{ $orderGroup['device']['customer_standalone_device']['tracking_num']}}
                                                                </td>
                                                            @elseif (isset($orderGroup['sim']))
                                                                <td>
                                                                    {{$orderGroup['sim']['customer_standalone_sim']['shipping_date'] }}
                                                                </td>
                                                                <td>
                                                                    {{ $orderGroup['sim']['customer_standalone_sim']['tracking_num']}}
                                                                </td>
                                                            @endif
                                                            <td>
                                                                {{ $orderGroup['device']['name'] ?? 'NA' }}
                                                            </td>
                                                            <td>
                                                                {{ $orderGroup['plan']['name'] ?? 'NA' }}
                                                            </td>
                                                            <td>
                                                                {{ $orderGroup['sim']['name'] ?? 'NA' }}
                                                            </td>
                                                            <td>
                                                                @if(isset($orderGroup["order_group_addon"][0]))
                                                                <?php
                                                                    $orderAddon = array_column($orderGroup["order_group_addon"], 'addon');
                                                                $addonName = array_column($orderAddon, 'name');
                                                                ?>
                                                                {{ implode(",",$addonName) }}
                                                                @else
                                                                NA
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
$('.section-orders .table .show').on('click', function(e){
    e.preventDefault();
    $this = $(this)
    const $parentTr = $this.parents('tr');
    const $allHidden = $('tr.hidden-details');

    if( $parentTr.next().is('tr.hidden-details') ){

        if( $parentTr.next().hasClass('hide') ){
            $allHidden.addClass('hide');
            $('.section-orders .table .show').text('show');
            $parentTr.next().removeClass('hide');
            $this.text('hide');
        }
        else{
            $parentTr.next().addClass('hide');
            $this.text('show');
        }

    }

});
</script>
@endpush
