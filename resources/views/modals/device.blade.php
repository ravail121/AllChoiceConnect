<div id="modalDevice" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               	<div class="row">
               		<div class="col-md-4 col-sm-5 col-xs-12">
               			<div class="images imageClicker">
           					<ul class="thumbs pull-left">

           					</ul>
               				<div class="preview pull-left">
               					<div class="img-wrap">
               					</div>
               				</div>
               			</div>
                       </div>
               		<div class="col-md-8 col-sm-7 col-xs-12">
               			<div class="row xs-add-top-2">
               				<div class="col-md-7 col-sm-12">
               					<h1 class="device-name">{{-- DEVICE NAME HERE --}}</h1>
               				</div>
               				<div class="col-md-5 col-sm-12 text-right">
               					<div class="price-wrap device-compatable-plan">
        							<span class="sign">$</span>
        							<span class="price with-plan">{{-- PRICE HERE --}}</span>
        							<span class="month">
        								<i>with</i>
        								<i>PLAN</i>
        							</span>
        							<div class="text-right without-price">
        								<span class="sign">$</span>
        								<span class="price without-plan">{{-- PRICE HERE --}}</span>
        								<span class="month">without PLAN</span>
        							</div>
        						</div>
                                <div class="price-wrap device-non-compatable-plan">
                                    <span class="sign">$</span>
                                    <span class="price with-plan">{{-- PRICE HERE --}}</span>
                                </div>
               				</div>
               			</div>
               			<div class="row">
               				<div class="col-xs-12 pad-right-4">
               					<ul class="nav nav-tabs" id="gb" role="tablist">
        						    {{-- <li role="presentation" class="active"><a href="#gb16" aria-controls="home" role="tab" data-toggle="tab">16GB</a></li> --}}
        						    {{-- <li role="presentation"><a href="#gb32" aria-controls="profile" role="tab" data-toggle="tab">32GB</a></li> --}}
        						</ul>
        						<div class="tab-content add-top-3">
        						    <div role="tabpanel" class="tab-pane active device-description" id="gb16">
        						    	{{-- DESCRIPTION HERE --}}
        						    </div>
        						    {{-- <div role="tabpanel" class="tab-pane" id="gb32">
        						    	<p class="f13 t-black-1 lh-15 regular">
        						    		Another Description
        						    	</p>
        						    </div> --}}
        						</div>

        						<div class="add-top-5">
        							{!! Form::open(['route' => 'devices.store', 'id' => 'form-plans']) !!}

                                        {!! Form::hidden('device_id', null) !!}
                                        {!! Form::hidden('device_type', null) !!}
                                        {!! Form::hidden('device_name', null) !!}
                                        {!! Form::hidden('amount', null) !!}
                                        {!! Form::hidden('amount_w_plan', null) !!}

                                        <a href="#" class="btn style2 sm-half-left xs-full-width add-to-cart add-to-cart-btn"{{--  data-toggle="modal" data-target="#modalProceed" --}}>Add to cart without plan</a>

                                        {{-- {!! Form::button('Add to cart without plan', ['type' => 'submit', 'class' => 'btn style2 sm-half-left xs-full-width', 'name' => 'without_plan', 'value' => 'without_plan']) !!} --}}

                                        {!! Form::button('Add to cart and choose plan', ['type' => 'submit', 'class' => 'btn style2 add-left-2 sm-half-left sm-add-top-15 xs-full-width d-none', 'name' => 'with_plan', 'value' => 'with_plan', 'id' => 'choose-plan']) !!}

        							{!! Form::close() !!}

        						</div>
               				</div>
               			</div>
               		</div>
               	</div>
                <div class="device-description-detail">
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.additional-popup')
