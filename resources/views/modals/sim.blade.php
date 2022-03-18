<div id="modalSim" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
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
               					<h1 class="sim-name">{{-- SIM NAME HERE --}}</h1>
               				</div>
               				<div class="col-md-5 col-sm-12 text-right">
               					<div class="price-wrap">
        							<span class="sign">$</span>
        							<span class="price sim-price">{{-- PRICE HERE --}}</span>
        							<span class="month">
        								<i>full</i>
        								<i>PRICE</i>
        							</span>
        						</div>
               				</div>
               			</div>
               			<div class="row">
               				<div class="col-xs-12 pad-right-4">

        						<div class="tab-content add-top-3">
        						    <div role="tabpanel" class="tab-pane active" id="gb16">
        						    	{{-- DESCRIPTION HERE --}}
        						    </div>

        						</div>

        						<div class="add-top-5">
        							{!! Form::open(['route' => 'devices.store', 'id' => 'form-sims']) !!}

                                        {!! Form::hidden('sim_id', null) !!}

                                        <a href="#" class="btn style2 sm-half-left xs-full-width add-to-cart">Add to cart</a>

        							{!! Form::close() !!}

        						</div>
               				</div>
               			</div>
               		</div>
               	</div>
            </div>
        </div>
    </div>
</div>
