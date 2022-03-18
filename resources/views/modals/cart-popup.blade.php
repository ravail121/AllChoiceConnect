<div id="cart-popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="add-bottom-4 text-center">Please Add to Cart to proceed</h5>
                <ul class="text-center">
                    <li class="add-bottom-4">
                        <a href="{{ route('devices.index') }}" class="btn style2">+ Add New Device</a>
                    </li>
                    <li class="add-bottom-15">
                        <a href="{{ route('plans.index') }}" class="btn style3">+ Add New Plan</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>