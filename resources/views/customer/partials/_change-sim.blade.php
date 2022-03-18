<div id="changeSim" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="change-sim-form">
                        <div class="form-group col-sm-12 col-md-12">
                            <label for="sim_num">Please Enter the new SIM number</label>
                            <input type="hidden" id = "old_sim_number">
                            <input type="hidden" id = "phone_number">
                            <input type="hidden" id = "is_ultra">
                            <input type="text" id="sim_num" name ="sim_num" class="form-control effect-1" placeholder="SIM Number" maxlength="20"><br>
                            <button type="submit" class="btn btn-info change_sim_sub_btn">Submit</button><br><br>
                            <p class="note-italic">NOTE: Your old SIM number will be changed.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(function(){

            $('#change-sim-form').validate({
                rules: {
                    sim_num: {
                        required:    true,
                        minlength:   19,
                        maxlength:   20
                    },
                },
                messages: {
                    sim_num: {
                        required:          "Please enter your New SIM Number",
                        minlength:         "Please enter a valid SIM Number",
                        maxlength:         "Please enter a valid SIM Number",
                    },
                },

                errorElement: "em",

                errorPlacement: function( error, element ){

                    $(element).addClass('is-invalid');
                    error.addClass('card-error');
                    error.insertAfter(element);
                },
                success: function( label, element ){
                    $(element).removeClass("is-invalid");
                },
            });

            $('.menu .change-sim').on('click', loadChangeSimData);

            $('#changeSim').on('submit', '#change-sim-form', function(e){
                e.preventDefault();
                let newSimNumber = $('#changeSim #sim_num').val();
                let oldSimNumber = $('#changeSim #old_sim_number').val();
                swal({
                    title: "Are you sure you want to proceed?",
                    text: "Your previous SIM Number "+oldSimNumber+" will changed to "+newSimNumber,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            submitChangePlanRequest(newSimNumber);
                        } else {
                            swal("Change SIM request Canceled");
                        }
                    });
            })

            function loadChangeSimData(){
                $this = $(this);
                $('#changeSim #sim_num').val("");
                $('#changeSim #old_sim_number').val($this.attr('data-sim_num'))
                $('#changeSim #phone_number').val($this.attr('data-phone_number'))
                $('#changeSim #is_ultra').val($this.attr('data-is_ultra'))
            }

            function submitChangePlanRequest(newSimNumber){
                var formData = {
                    'sim_num' : newSimNumber,
                    'phone_number' : $('#changeSim #phone_number').val(),
                    'is_ultra' : $('#changeSim #is_ultra').val()
                };
                $.ajax({
                    type: 'POST',
                    url: '{{ route('change.sim') }}',
                    data:formData,
                    beforeSend: showLoader,
                    success: function (data) {
                        if(data.message){
                            swal("Error!", data.message, "error");
                        }else{
                            swal('SIM Number Updated');
                            $('#changeSim .close').click();
                        }
                    },
                    complete: hideLoader,
                    error: function (xhr,status,error) {
                        swal("Error!", "Sorry Something went wrong", "error");
                    }
                });
            }
        });
    </script>
@endpush
