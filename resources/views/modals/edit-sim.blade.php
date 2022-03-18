<!-- Edit Sim Modal -->
<div id="simEditModal" class="modal fade" role="dialog" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <h4>Edit Sim Number</h4>
                <hr>
                <form class='sim-edit-input'>
                    <input style='border-top: none; border-left: none; border-right: none' name='sim_number_modal' class='modal-buttons' type='text' id='sim-number-modal' value='' placeholder='Enter sim number'>
                    <small class="sim-text text-muted text-danger"></small>
                </form>
            </div>
            <div>
                <button type="button" class="button-color fonts-phones" data-dismiss="modal" id='close-sim-modal'>Close</button>
                <button type="submit" class="button-color fonts-phones" id='save-sim-details'>Save</button>
            </div>
        </div>
    </div>
</div>
