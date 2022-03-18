@extends('layouts.app')

@section('content')


<div class="global-wrap">

	<!-- content -->
	<section class="choose-device-content">
		<div class="container">
			@include('processes.process-steps')

			<div class="row no-margin pad-top-10 text-center">
				<h1 class="content-title">Verify Your Business</h1>

                <div style='text-align:left; margin-top:50px'>
                    <b style='font-size: 20px;'>To get your business verified, follow these simple steps:</b>
                    <p class='business-verify-text'>1. If you are a business (INC, LLC etc.) with a TAX ID/EIN, fill in the fields and no supporting documentation is required providing that the EIN matches.</p>
                    <p class='business-verify-text'>2. If you are self employed, sole proprietor or a contractor WITH an EIN please fill in the EIN field as well as upload the official letter you received confirming your EIN issuance.</p>
                    <p class='business-verify-text'>3. If you are self employed, sole proprietor or a contractor WITHOUT an EIN, please upload a document from an official entity stating the name of your business. This may include a business registration, DBA form, sales and use form, business license, permit, screenshot of website or online business listing.</p>
                </div>

				<div class="add-top-6 xs-add-top-4">

					{!! Form::open(['route' => 'verify-bussiness.store', 'class' => 'text-left verify-business-form', 'files' => true]) !!}

						<div class="row">
							<div class="col-sm-4 col-xs-12">
								<div class="form-group">
									{!! Html::decode(Form::label('fname', 'First Name<span class="text-danger"> *</span>')) !!}
									{!! Form::text('fname', null, ['class' => 'form-control business-fields', 'id' => 'fname', 'aria-describedby' => 'fname']) !!}
									<small class="form-text text-muted text-danger"></small>
								</div>
							</div>
							<div class="col-sm-4 col-xs-12">
								<div class="form-group">
									{!! Html::decode(Form::label('lname', 'Last Name<span class="text-danger"> *</span>')) !!}
									{!! Form::text('lname', null, ['class' => 'form-control business-fields', 'id' => 'lname', 'aria-describedby' => 'lname']) !!}
									<small class="form-text text-muted text-danger"></small>
								</div>
							</div>
							<div class="col-sm-4 col-xs-12">
								<div class="form-group">
									{!! Html::decode(Form::label('email', 'Email Address<span class="text-danger"> *</span>')) !!}
									{!! Form::text('email', null, ['class' => 'form-control business-fields', 'id' => 'email', 'aria-describedby' => 'email']) !!}
									<small class="form-text text-muted text-danger"></small>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									{!! Html::decode(Form::label('bussiness-name', 'Business Name<span class="text-danger"> *</span>')) !!}
									{!! Form::text('bussiness_name', null, ['class' => 'form-control business-fields', 'id' => 'bussiness-name', 'aria-describedby' => 'bussiness-name']) !!}

									<small class="form-text text-muted text-danger"></small>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									{!! Html::decode(Form::label('tax-id', 'Tax ID/EIN<span class="text-danger mandatory-taxid"> *</span>')) !!}
									{!! Form::text('tax_id', null, ['class' => 'form-control business-fields', 'id' => 'tax-id', 'aria-describedby' => 'tax-id']) !!}
									<small class="form-text text-muted text-danger"></small>
								</div>
							</div>
							{{-- <div class="col-sm-4 col-xs-12">
								<div class="form-check add-bottom-15">
									{!! Form::radio('bussiness', 'bussiness-owner', false, ['class' => 'form-check-input', 'id' => 'bussiness-owner']) !!}

									{!! Form::label('bussiness-owner', 'I am a business (INC, LLC etc.) with a TAX ID/EIN', ['class' => 'form-check-label']) !!}
                                </div>
                                <div class="form-check">
                                    {!! Form::radio('bussiness', 'self-employed', false, ['class' => 'form-check-input', 'id' => 'selfEmployed']) !!}
                                    {!! Form::label('selfEmployed', 'I am self employed. sole proprietor, contractor or others', ['class' => 'form-check-label']) !!}
                                </div>
                                <small class="form-text text-muted text-danger"></small>
							</div> --}}
						</div>
						{{-- <div class="row">
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									{!! Form::label('address-line1', 'Address 1') !!}
									{!! Form::textarea('address_line1', null, ['class' => 'form-control business-fields', 'id' => 'address-line1', 'aria-describedby' => 'address-line1', 'rows' => '2']) !!}
									<small class="form-text text-muted text-danger"></small>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="form-group">
									{!! Form::label('address-line2', 'Address 2') !!}
									{!! Form::textarea('address_line2', null, ['class' => 'form-control', 'id' => 'address-line2', 'aria-describedby' => 'address-line2', 'rows' => '2']) !!}
									<small class="form-text text-muted text-danger"></small>
								</div>
							</div>
						</div> --}}

						{{-- <div class="row">
							<div class="col-sm-4 col-xs-12">
								<div class="form-group">
									{!! Form::label('city', 'City') !!}
									{!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'aria-describedby' => 'city']) !!}
									<small class="form-text text-muted text-danger"></small>
								</div>
							</div>
							<div class="col-sm-4 col-xs-12">
								<div class="form-group">
									{!! Form::label('state', 'State') !!}
									{!! Form::text('state', null, ['class' => 'form-control', 'id' => 'state', 'aria-describedby' => 'state']) !!}
									<small class="form-text text-muted text-danger"></small>
								</div>
							</div>
							<div class="col-sm-4 col-xs-12">
								<div class="form-group">
									{!! Form::label('zip', 'Zip') !!}
									{!! Form::text('zip', null, ['class' => 'form-control', 'id' => 'zip', 'aria-describedby' => 'zip']) !!}
									<small class="form-text text-muted text-danger"></small>
								</div>
							</div>
						</div> --}}

						<hr>

						<div class="row">
							<div class="col-sm-6 col-xs-12 left-con">

								<h3>
									Please Upload A Business <br>
									Verification Document
								</h3>

								<strong class='mandatory-documents'><span>*</span> Required, if EIN not supplied above</strong>

								<p>This may include a business registration, DBA form, sales and use form, or a business license or permit</p>

							</div>
							<div class="col-sm-6 col-xs-12 right-con dropzone">
                                <div id="dropzoneFile">
									<div class="zone-wrap">
                                        <div class="dz-message" data-dz-message>
                                            <span>
                                                <h5>+ Drop Files Here</h5>
                                                <p>Upload a JPEG, JPG, PNG, PDF, DOC, XLS file</p>
                                                {!! Form::label('', 'Choose File', ['class' => 'btn lbl-file']) !!}
                                            </span>

                                        </div>
                                        {{-- {!! Form::file('file[]', ['class' => 'd-none', 'id' => 'dropzone-file', 'multiple' => 'multiple', 'accept' => '.pdf,.png,.gif,.jpg,.jpeg', 'required' => 'required']) !!} --}}
                                    </div>
                                </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4 right-con">
								{!! Form::button('Verify Business', ['class' => 'btn style2 business-form-submit', 'type' => 'submit', 'id' => 'verify-business-button']) !!}
							</div>
							<div class="col-md-4"></div>
						</div>

					{!! Form::close() !!}

				</div>

			</div>
		</div>
	</section>
	<!-- end content -->
@endsection

@section('footerCart')
    @include('cart.footer-mobile-cart-items')
@endsection

@push('js')
	<script>

        function showLoader() {
            $('.myOverlay').removeClass('d-none');
            $('.loadingGIF').removeClass('d-none');
        }

        function hideLoader() {
            $('.myOverlay').addClass('d-none');
            $('.loadingGIF').addClass('d-none');

            $('html, body').animate({
                scrollTop: $("#collapseTwo").position().top - 560
            }, 2000);
        }

		$(function(){
            $('#tax-id').inputmask("mask", {"mask": "99-9999999", clearIncomplete: true});
            $('#tax-id').on('change', function(){
                if ($(this).val().length > 0) {
                    $('.mandatory-documents').html('');
                } else {
                    $('.mandatory-documents').html('<span>*</span> Required {{-- if EIN not supplied above --}}');
                }

            });

            function ajaxWithoutFile(e) {
                const businessVerifyForm = $(".verify-business-form");
                const formData = businessVerifyForm.serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{  route('verify-bussiness.store')  }}',
                    dataType: 'json',
                    data:formData,
                    beforeSend: showLoader,
                    complete: function() {
                        var email = $('#email').val();
                        window.location.href="{{ url('/verify-bussiness/check-mail?email=') }}"+email;
                    }

                });

            };

            // <<<<<<<<<<<<<< DROPZONE CODE STARTS >>>>>>>>>>>>>>>>>>>>>>>
            $("div#dropzoneFile").dropzone({
                url: "{{ route('verify-bussiness.store') }}",
                paramName: "file",
                maxFilesize: 10,
                parallelUploads: 15,
                uploadMultiple: true,
                dictDuplicateFile: "Duplicate Files Cannot Be Uploaded",
                preventDuplicates: false,
                addRemoveLinks: true,  // This adds delete link on every file upload
                dictRemoveFile : "<i class='fa fa-trash' aria-hidden='true'></i>",
                autoProcessQueue: false,  // This avoids in automatic ajax file upload
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.doc,.xls,.docx",
                timeout: 180000,
                removedfile: function(file) { // currently not in use
                   var name = file.name;

                    if (this.files.length === 0) {
                        $('.dz-message').show();
                    }

                    // $.ajax({
                    //     type: "POST",
                    //     url: "{{-- route('file.remove') --}}",
                    //     data: {name: name},
                    //     sucess: function(data){

                    //         // Simply returns name of file (No Api runs for this)
                    //         console.log('success: ' + data);
                    //     },
                    //     error: function(data){
                    //         console.log('error: ', data);
                    //     }
                    // });
                    var _ref;
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                },
                init: function() {
                    mydropzone = this;

                    $('.business-form-submit').on('click', function(e){
                        e.preventDefault();
                        if (mydropzone.files.length > 0 && $('.verify-business-form').valid()) {

                            mydropzone.processQueue();

                        } else if ($('#tax-id').val().length > 0 && $('.verify-business-form').valid()) {

                            ajaxWithoutFile();

                        } else {

                            if ($('.left-con').find('small').length == 0) {
                                $('.left-con').append('<small class="form-text text-muted text-danger is-invalid"><em>Please upload your Business documents.</em></small>');
                            }

                        }

                    });

                    // This helps in sending form-data along-with files uploaded
                    this.on('sending', function(file, xhr, formData) {
                        $('.myOverlay').removeClass('d-none');
                        $('.loadingGIF').removeClass('d-none');

                        var data = $('.verify-business-form').serializeArray();
                        $.each(data, function(key, input) {
                            formData.append(input.name, input.value);
                        });
                    });

                    // On success, it should redirect to check-mail page
                    mydropzone.on("success", function(file) {
                        var email = $.trim(file.xhr.response);
                        window.location.href="{{ url('/verify-bussiness/check-mail?email=') }}"+email;
                        $('.myOverlay').addClass('d-none');
                        $('.loadingGIF').addClass('d-none');
                    });

                    mydropzone.on("error", function(file, response) {

                        if ($('body').find('.verify-error').length == 0) {

                            $('body').append('<div class="verify-error"><div class="alert alert-danger alert-dismissible text-center" role="alert" style="position: fixed; top: 5%; left: 11px; width: 30%; text-align: left; z-index: 4;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Max. file size allowed is 10 MB</div></div>');
                        }

                        $('body').on('click', '.close', function() {
                            $('.verify-error').remove();

                        });

                        $(file.previewElement).find('.dz-error-message').text('Sorry, something went wrong please try again later');
                        $('.myOverlay').addClass('d-none');
                        $('.loadingGIF').addClass('d-none');
                    });

                    mydropzone.on("addedfile", function(file) {
                        var extention = file.name.split('.').pop();

                        $('.left-con').find('small').remove();
                        $('#dropzoneFile').find('.dz-file-preview').removeClass('dz-file-preview').addClass('dz-image-preview');

                        if (extention == "pdf") {
                            $(file.previewElement).find(".dz-image img").attr({"src": "{{ asset('imgs/placeholders/pdf/pdf.png') }}", "width":"100px", "height":"100px"});

                        } else if (extention.indexOf("doc") != -1) {
                            $(file.previewElement).find(".dz-image img").attr({"src": "{{ asset('imgs/placeholders/doc/doc.png') }}", "width":"100px", "height":"100px"});

                        } else if (extention.indexOf("xls") != -1) {
                            $(file.previewElement).find(".dz-image img").attr({"src": "{{ asset('imgs/placeholders/excel/excel.png') }}", "width":"100px", "height":"100px"});
                        }
                        $('.dz-message').hide();
                        $('.dz-progress').hide();
                        file.previewElement.classList.add("dz-success");

                        // To remove duplicate Files
                        if (this.files.length) {
                            var _i, _len;
                            for (_i = 0, _len = this.files.length; _i < _len - 1; _i++) {

                                if(this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString()) {
                                    this.removeFile(file);
                                }
                            }
                        }

                    });
                },
            });

            // <<<<<<<<<<<<<< DROPZONE CODE ENDS >>>>>>>>>>>>>>>>>>>>>>>








			const $form                =  $('.verify-business-form'),
                  $addStepNumber       =  $('.no-margin > ul'),
                  $businessformSubmit  =  $('.business-form-submit'),
                  $inputFile           =  $('input[type="file"]'),
                  $inputFileDiv        =  $inputFile.parent('div').parent('div').parent('div').parent('div').find('.left-con');

            var totalDueCart    = $('.total-due-cart');

			$addStepNumber.addClass('step2');
            $businessformSubmit.on('click', validateFile);


           function validateFile(e)
           {
                e.preventDefault();
                if ($('input[type="file"]').val() == '') {
                    if ($inputFileDiv.find('small').length == 0) {
                        $inputFileDiv.append('<small class="form-text text-muted text-danger is-invalid"><em>Please upload your Business documents.</em></small>');
                    }
                } else {
                    $inputFileDiv.find('small').remove();
                }

            }



			$form.validate({
                rules: {
                    fname:          "required",
                    lname: 	        "required",
                    bussiness_name: "required",
                    file:{
                        required: function() {
                            return $('#tax-id').val().length === 0;
                        },
                        filesize : 100000
                    },
                    tax_id:{
                        required: function() {
                            return mydropzone.files.length === 0;
                        },
                    },
                    email:{
                        required: true,
                        email: true,
                        remote :{
                            url: "{{ route('update.email') }}",
                            type: "post"
                        }
                    },
                },
                messages: {
                    fname:          "Please provide your first name",
                    lname:          "Please provide your last name",
                    bussiness_name: "Please provide your Name of your Business",
                    file:{
                            required:"Please upload some document",
                            filesize:"less than 5MB size file upload"
                        },
                    tax_id:         {
                        required: "Please specify your Tax ID/EIN",
                        minlength: "Require 9 digits",
                        maxlength: "Require 9 digits",
                    },
                    email: {
                        required: "Please enter your email address",
                        email:    "Please enter a valid email address",
                        remote:   "This email is already verified. Please Sign-in to place order"
                    },
                },

                errorElement: "em",

                errorPlacement: function( error, element ){

                	$(element).addClass('is-invalid');
                    $(element).parent('div').find('.form-text').append(error);
                },
				success: function( label, element ){
                    $(element).removeClass("is-invalid");
                },
            });

		});
        $('.business-fields').on('change', function() {
            $(this).val($(this).val().trim());
        });
        $('#verify-business-button').click(()=>{
            $('#fname').valid();
            $('#lname').valid();
            $('#bussiness-name').valid();
            $('#tax-id').valid();
            $('#email').valid();
        });

	</script>
@endpush
