@extends('layouts.app')

@section('content')
    <!-- Modal -->
    <div id="myModal_neworexisting" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body mobile_vompit text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <h3>New or Existing Number </h3>

                    <p>Please enter your zip code so we can verify your coverage then choose an option below.</p>
                    <!--<h5 class="comp_mess">Remember, you must have an unlocked phone in order to use the Teltik service.<h5>-->
                    <input type="text" class="form-control input_color" name="zipcode" placeholder="Zip code">
                    <p>Transfer your number from your current carrier.</p>
                    <a href="#myModal_extnumberselt" class="update_phoe" >Transfer an Existing  Number</a>

                    <p class="or_class">-------------------OR--------------------</p>
                    <p>Request a new phone number based on your zip code</p>
                    <a href="#" class="update_phoe" >Get A New Number</a>
                </div>

            </div>
        </div>
    </div>
    <div id="myModal_extnumberselt" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">



                <div class="modal-body mobile_vompit text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Transfer Details</h3>
                    <p>Please enter your account information from your current carrier below:</p>
                    <form method="post" name="" action="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="form-group col-sm-12 col-md-6">
                            <!--<label for="authorized_name">Authorized Name*</label>-->
                            <input type="text" id="authorized_name" name="authorized_name" class="form-control effect-1 input_color" aria-describedby="emailHelp" placeholder="Authorized Name">
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <!-- <label for="address_line1">Address Line 1*</label>-->
                            <input type="text" id="address_line1" name="address_line1" class="form-control input_color effect-1" aria-describedby="emailHelp" placeholder="Address Line 1">
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <!--<label for="address_line2">Address Line 2</label>-->
                            <input type="text" id="address_line2" name="address_line2" class="form-control input_color effect-1" aria-describedby="emailHelp" placeholder="Address Line 2">
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <!--  <label for="city">City*</label>-->
                            <input type="text" id="city" name="city" class="form-control input_color effect-1" aria-describedby="emailHelp" placeholder="City">
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <!-- <label for="state">State*</label>-->
                            <select id="state" class="input_color form-control" name="state"><option value="" selected="selected">Select State</option><option value="DC">District of Columbia</option><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option></select>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <!--<label for="zip">Zip Code*</label>-->
                            <input type="text" id="zip" name="zip" class="form-control effect-1 input_color" aria-describedby="emailHelp" placeholder="Zip">
                            <span class="focus-border"></span> </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <!-- <label for="ssn_taxid">SSN/Tax ID(Optional)</label>-->
                            <input type="text" id="ssn_taxid" name="ssn_taxid" class="form-control input_color effect-1" aria-describedby="emailHelp" placeholder="SSN/Tax ID(Optional)">
                            <span class="focus-border"></span> </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <!--<label for="sim_card_number">SIM Card Number</label>-->
                            <input type="text" id="sim_card_number" name="sim_card_number" class="form-control effect-1 input_color" aria-describedby="emailHelp" placeholder="7474747474747474747" disabled="">
                            <span class="focus-border"></span> </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <!-- <label for="number_to_port">Number to Port*</label>-->
                            <input type="text" id="number_to_port" name="number_to_port" class="form-control input_color effect-1" required aria-describedby="emailHelp" placeholder="Number to Port" maxlength="10">
                            <span class="focus-border"></span> </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <!--<label for="company_porting_from">Phone Company you are porting from* </label>-->
                            <input type="text" id="company_porting_from" name="company_porting_from" class="form-control effect-1 input_color " required aria-describedby="emailHelp" placeholder="Phone Company you are porting from*">
                            <span class="focus-border"></span> </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <!--<label for="account_number_porting_from">Account Number of former carrier*</label>-->
                            <input type="text" id="account_number_porting_from" name="account_number_porting_from" class="form-control effect-1 input_color" required aria-describedby="emailHelp" placeholder="Account Number of former carrier*">
                            <span class="focus-border"></span> </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <!-- <label for="account_pin_porting_from">Account Pin of former carrier* </label>-->
                            <input type="text" id="account_pin_porting_from" name="account_pin_porting_from" class="form-control effect-1 input_color" required aria-describedby="emailHelp" placeholder="Account Pin of former carrier*">
                            <span class="focus-border"></span> </div>

                        <div class="col-sm-12 col-md-12 mt-4">
                            <button type="submit" class="btn lightbtn final-port-submit-btn center-block">Submit</button>
                        </div>


                        <!--<input type="text" class="form-control" name="phonenumber" placeholder="Phone Number">
                        <input type="text" class="form-control" name="accountnumber" placeholder="Account Number">
                        <input type="text" class="form-control" name="pip" placeholder="Pip">
                        <input type="text" class="form-control" name="zip" placeholder="Zip">
                        <input type="submit" class="form-control" name="submittransfer" value="Transfer">-->


                    </form>

                    <a href="" class="update_phoe" >Gobc99</a>


                </div>
            </div>
        </div>

        @endsection
        @push('js')
            <script>
                $(document).ready(function(){
                    $('#myModal_neworexisting').modal('show');
                    $('a[href$="#myModal_extnumberselt"]').on( "click", function() {
                        $('#myModal_extnumberselt').modal();
                    });
                });
            </script>
    @endpush('js')
