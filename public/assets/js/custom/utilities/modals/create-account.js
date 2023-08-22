"use strict";

// Class definition
var KTCreateAccount = function () {
	// Elements
	var modal;	
	var modalEl;

	var stepper;
	var form;
	var formSubmitButton;
	var formContinueButton;

	// Variables
	var stepperObj;
	var validations = [];

	// Private Functions
	var initStepper = function () {
		// Initialize Stepper
		stepperObj = new KTStepper(stepper);

		// Stepper change event
		stepperObj.on('kt.stepper.changed', function (stepper) {
			if (stepperObj.getCurrentStepIndex() === 6) {
				formSubmitButton.classList.remove('d-none');
				formSubmitButton.classList.add('d-inline-block');
				formContinueButton.classList.add('d-none');
			} else if (stepperObj.getCurrentStepIndex() === 7) {
				formSubmitButton.classList.add('d-none');
				formContinueButton.classList.add('d-none');
			} else {
				formSubmitButton.classList.remove('d-inline-block');
				formSubmitButton.classList.remove('d-none');
				formContinueButton.classList.remove('d-none');
			}
		});

		// Validation before going to next page
		stepperObj.on('kt.stepper.next', function (stepper) {
			console.log('stepper.next');

			// Validate form before change stepper step
			var validator = validations[stepper.getCurrentStepIndex() - 1]; // get validator for currnt step

			if (validator) {
				validator.validate().then(function (status) {
					console.log('validated!');

					if (status == 'Valid') {
						stepper.goNext();

						KTUtil.scrollTop();
					} else {
						Swal.fire({
							text: "Sila lengkapkan maklumat yang diperlukan.",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok",
							customClass: {
								confirmButton: "btn btn-light"
							}
						}).then(function () {
							KTUtil.scrollTop();
						});
					}
				});
			} else {
				stepper.goNext();

				KTUtil.scrollTop();
			}
		});

		// Prev event
		stepperObj.on('kt.stepper.previous', function (stepper) {
			console.log('stepper.previous');

			stepper.goPrevious();
			KTUtil.scrollTop();
		});
	}

	var handleForm = function() {
		formSubmitButton.addEventListener('click', function (e) {
			// Validate form before change stepper step
			var validator = validations[6]; // get validator for last form

			validator.validate().then(function (status) {
				console.log('validated!');

				if (status == 'Valid') {
					// Prevent default button action
					e.preventDefault();

					// Disable button to avoid multiple click 
					formSubmitButton.disabled = true;

					// Show loading indication
					formSubmitButton.setAttribute('data-kt-indicator', 'on');

					// Simulate form submission
					setTimeout(function() {
						// Hide loading indication
						formSubmitButton.removeAttribute('data-kt-indicator');

						// Enable button
						formSubmitButton.disabled = false;

						stepperObj.goNext();
					}, 2000);
				} else {
					Swal.fire({
						text: "Sorry, looks like there are some errors detected, please try again.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn btn-light"
						}
					}).then(function () {
						KTUtil.scrollTop();
					});
				}
			});
		});

	}

	var initValidation = function () {
		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		// Step 1
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					'no_akaunbank': {
						validators: {
							notEmpty: {
								message: 'No. Akaun Bank diperlukan'
							},
							digits: {
								message: 'No. Akaun Bank mesti mengandungi digit sahaja'
							},
							stringLength: {
								min: 14,
								max: 14,
								message: 'No. Akaun Bank mesti mengandungi 14 digit sahaja'
							}
						}
					}
					
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		));

		// Step 2
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					'alamatW1': {
						validators: {
							notEmpty: {
								message: 'Alamat rumah diperlukan'
							}
						}
					},
					'alamatW_poskod': {
						validators: {
							notEmpty: {
								message: 'Poskod diperlukan'
							}
						}
					},
					'alamatW_bandar': {
						validators: {
							notEmpty: {
								message: 'Bandar diperlukan'
							}
						}
					},
					'alamatW_negeri': {
						validators: {
							notEmpty: {
								message: 'Negeri diperlukan'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		));

		// Step 3
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					'no_pendaftaranpelajar': {
						validators: {
							notEmpty: {
								message: 'No. Pendaftaran Pelajar diperlukan'
							}
						}
					},
					'sesi': {
						validators: {
							notEmpty: {
								message: 'Sesi Pengajian diperlukan'
							}
						}
					},
					'tkh_mula': {
						validators: {
							notEmpty: {
								message: 'Tarikh Mula diperlukan'
							}
						}
					},
					'tkh_tamat': {
						validators: {
							notEmpty: {
								message: 'Tarikh Mula diperlukan'
							}
						}
					},
					'sem_semasa': {
						validators: {
							notEmpty: {
								message: 'Semester Semasa diperlukan'
							}
						}
					},
					'tempoh_pengajian': {
						validators: {
							notEmpty: {
								message: 'Tempoh Pengajian diperlukan'
							}
						}
					},
					'bil_bulanpersem': {
						validators: {
							notEmpty: {
								message: 'Bil Bulan Persemester diperlukan'
							}
						}
					},
					'mod': {
						validators: {
							notEmpty: {
								message: 'Mod Pengajian diperlukan'
							}
						}
					},
					'sumber_biaya': {
						validators: {
							notEmpty: {
								message: 'Sumber Biaya diperlukan'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		));

		// Step 4
		validations.push(FormValidation.formValidation(
			form,
			{
				/*fields: {
					'amaun': {
						validators: {
							notEmpty: {
								message: 'Amaun diperlukan'
							}
						}
					}
				},*/

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		));
		// Step 5
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					'akaunBank': {
						validators: {
							notEmpty: {
								message: 'Salinan Bank diperlukan'
							},
							file: {
								extension: 'jpeg,jpg,png,pdf',
								type: 'image/jpeg,image/png,application/pdf',
								maxSize: 2097152, // 2048 * 1024
								message: 'Fail yang dipilih tidak sah',
							},
						}
					},
				
					'suratTawaran': {
						validators: {
							notEmpty: {
								message: 'Salinan Surat Tawaran diperlukan'
							},
							file: {
								extension: 'jpeg,jpg,png,pdf',
								type: 'image/jpeg,image/png,application/pdf',
								maxSize: 2097152, // 2048 * 1024
								message: 'Fail yang dipilih tidak sah',
							},
						}
					},
				
					'invoisResit': {
						validators: {
							notEmpty: {
								message: 'Salinan Resit/Invois diperlukan'
							},
							file: {
								extension: 'jpeg,jpg,png,pdf',
								type: 'image/jpeg,image/png,application/pdf',
								maxSize: 2097152, // 2048 * 1024
								message: 'Fail yang dipilih tidak sah',
							},
						}
					}
				},


				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		));

		// Step 6
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					'perakuan': {
						validators: {
							notEmpty: {
								message: 'Perakuan diperlukan'
							}
						}
					}
				},

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		));
	}

	return {
		// Public Functions
		init: function () {
			// Elements
			modalEl = document.querySelector('#kt_modal_create_account');

			if ( modalEl ) {
				modal = new bootstrap.Modal(modalEl);	
			}					

			stepper = document.querySelector('#kt_create_account_stepper');

			if ( !stepper ) {
				return;
			}

			form = stepper.querySelector('#kt_create_account_form');
			formSubmitButton = stepper.querySelector('[data-kt-stepper-action="submit"]');
			formContinueButton = stepper.querySelector('[data-kt-stepper-action="next"]');

			initStepper();
			initValidation();
			handleForm();
		}
	};
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTCreateAccount.init();
});