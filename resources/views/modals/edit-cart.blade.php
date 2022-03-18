<div id="modal-edit-cart" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'edit.cart', 'id' => 'cart-edit-popup']) !!}

                    <h5 class="text-center add-bottom-5">You can edit details from below option</h5>
                    {!! Form::hidden('order_group_id', null) !!}

                    <ul class="text-center">
                        <li class="add-bottom-4">
                            {!! Form::button('Confirm Changes', ['type' => 'submit', 'class' => 'btn style2']) !!}
                        </li>
                    </ul>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

