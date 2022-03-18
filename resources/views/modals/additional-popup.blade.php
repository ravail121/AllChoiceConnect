<div id="modalProceed" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'confirmation.store', 'id' => 'additional-form-popup']) !!}

                    {{-- {!! Form::hidden('device_id', null) !!}
                    {!! Form::hidden('plan_id', null) !!}
                    {!! Form::hidden('sim_id', null) !!} --}}

                    <h6 class="text-center add-bottom-3 t-violet-2 product-type">{{-- PRODUCT TYPE HERE --}}</h6>
                    <h5 class="text-center add-bottom-3">How would you like to proceed?</h5>
                    <ul class="text-center">
                        <li class="add-bottom-4">
                            <a href="#" class="btn style2 checkout" id='checkout'>Check Out</a>
                        </li>
                        <li class="add-bottom-15">
                            <a href="#" class="btn style3 select-devices">+ Add New Device</a>
                        </li>
                        <li>
                            <a href="#" class="btn style3 select-plans">+ Add New Plan</a>
                        </li>
                    </ul>

                {!! Form::close() !!}

            </div>
        </div>
    </div>

</div>


