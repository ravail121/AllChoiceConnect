@extends('layouts.app')
<!-- end header -->

<!-- content -->
@section('content')

<section class="cp">
    <div class="wrapper">

        @include('customer._sidebar')

        <div class="cp-sections">
        {!! Form::open(['route' => 'change.plan']) !!}
            <section class="cp-history cp-section section-billing">
                <h1>Change my plan</h1>

                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Monthly Cost</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($compatiblePlans as $key => $compatiblePlan)
                                @if(isset($compatiblePlan['id']))
                                    @if($compatiblePlans['active_plan'] == $compatiblePlan['id'])
                                    <tr class="active-plan">
                                        <td>
                                            {!! Form::radio('plan', $compatiblePlan['id'], true, ['class' => 'radiobtn', 'id' => 'active-plan', 'data-type' => 'plan']) !!}
                                        </td>
                                    @else
                                    <tr>
                                        <td>
                                            {!! Form::radio('plan', $compatiblePlan['id'], false, ['class' => 'radiobtn', 'data-type' => 'plan', 'id' => 'option-'.$compatiblePlan['id']]) !!}
                                        </td>
                                    @endif
                                        <td><label id='plan-{{$compatiblePlan['id']}}' for='option-{{ $compatiblePlan['id'] }}'>{{ $compatiblePlan['name'] }}</label></td>
                                        <td>$ @convert($compatiblePlan['amount_recurring'])</td>
                                    </tr>

                                @endif
                            @endforeach

                            {!! Form::hidden('account_status', $compatiblePlans['account_status'], ['class' => 'account_status']) !!}
                            {!! Form::hidden('subscription_id', $id, ['class' => 'subscription_id']) !!}
                            {!! Form::hidden('active_plans', $compatiblePlans['active_plan'], ['class' => 'active_plans']) !!}
                            {!! Form::hidden('active_addons', $compatiblePlans['active_addons'], ['class' => 'active_addons']) !!}
                            {!! Form::hidden('removal_scheduled_addon', $compatiblePlans['removal_scheduled_addon'], ['class' => 'removal_scheduled_addon']) !!}
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="cp-history cp-section section-billing addons-section">
                <h1>Add ON</h1>
                <span style='margin-left: 30px' id='messageAddons'></span>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name
                                <th>Monthly Cost</th>
                            </tr>
                        </thead>
                        <tbody class="addons">
                        </tbody>
                    </table>
                </div>
            </section>

            <div class="formButtons float-right">
                <button type="submit" class="done-btn" disabled ="true" id='done-btn'>Done</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
    $(function(){
        let activePlanId = $('#active-plan').val();
        getAddons(activePlanId);

        $('.radiobtn').on('click', function () {
            const  $this = $(this);
            let id = $this.val();
            getAddons(id);
        });

        function getAddons(id) {
            const formData = {plan_id: id};
            $.ajax({
                type: 'POST',
                url: '{{ route('compatible.addons') }}',
                dataType: 'json',
                data:formData,
                beforeSend: showLoader,
                success: function (data) {
                    $(".addons tr").detach();
                    let activeAddonsId = $('.active_addons').val();
                    let removalAddonsId = $('.removal_scheduled_addon').val();
                    let activePlanId = $('#active-plan').val();
                    let active = 0;
                    if(id == activePlanId){
                        active = 1;
                    }
                    if(data.length){
                        $(".addons-section").show();
                        let accountStatus = $('.account_status').val();
                        data.forEach(function (item, index) {
                            appendValue(activeAddonsId,  item, index, active, accountStatus, removalAddonsId)
                        });
                        // if(accountStatus == "1" && !activeAddonsId.length ){
                        //     $(".addons-section").hide();
                        // }
                    }else{
                        $(".addons-section").hide();
                    }
                },
                complete: hideLoader,
                error: function (data) {
                    //alert("Something Went Wrong");

                }
            });
        };

        function appendValue(activeAddonsId, item, index, active, accountStatus, removal) {
            if( activeAddonsId.indexOf(item.addon.id) != -1){
                $('.addons').append('<tr class = "active-addons"><td>'+ '<input type="checkbox" class="addonbtn radiobtn" name="addon[]" value="'+item.addon.id+'"  checked>' +'</td><td>'+item.addon.name+'</td><td>$'+item.addon.amount_recurring+'</td></tr>');
            }else if(removal.indexOf(item.addon.id) != -1){
                $('.addons').append('<tr class = "active-addons"><td>'+ 'Removal-Sheduled' +'</td><td>'+item.addon.name+'</td><td>$'+item.addon.amount_recurring+'</td></tr>');
            }else if(active ==1 && accountStatus==1){

            }
            else{
                $('.addons').append('<tr><td>'+ '<input type="checkbox" class="addonbtn radiobtn" name="addon[]" value="'+item.addon.id+'">' +'</td><td>'+item.addon.name+'</td><td>$'+item.addon.amount_recurring+'</td></tr>');
            }
        }

        $('body').on('change', '.radiobtn', function() {
            let activePlan = $('#active-plan').val();
            if($(this).attr('data-type') == 'plan'){
                newPlan = $(this).val();
            }
            if(typeof(newPlan) == "undefined") {
                newPlan = activePlan;
            }
            if (activePlan == newPlan) {
                let addon = [];
                setTimeout(
              function()
              {
                $(':checkbox:checked').each(function(i){
                    addon[i] = $(this).val();
                });
                let activeAddon = $('.active_addons').val()
                if(activeAddon){
                    activeAddon = activeAddon.split(",");
                }else{
                    activeAddon = [];
                }
                let count = 0;
                if(activeAddon.length != 0){
                    $.each( addon, function( key, value ) {
                        var index = $.inArray( value, activeAddon );
                        if( index != -1 ) {
                            count++ ;
                        }else{
                            count = 0 ;
                        }
                    });
                }else{
                    count = addon.length;
                }
                if(activeAddon.length == count && addon.length == activeAddon.length){
                    $('.done-btn').attr('disabled', true);
                }else{
                    $('.done-btn').attr('disabled', false);
                }
              }, 200);

            }else{
                $('.done-btn').attr('disabled', false);
            }
        })

    });

    function showLoader() {
        $('.myOverlay').removeClass('d-none');
        $('.loadingGIF').removeClass('d-none');
    }

    function hideLoader() {
        $('.myOverlay').addClass('d-none');
        $('.loadingGIF').addClass('d-none');
    }
</script>
@endpush
