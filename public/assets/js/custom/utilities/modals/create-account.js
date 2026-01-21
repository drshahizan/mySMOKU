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
			if (stepperObj.getCurrentStepIndex() === 6) { //6
				formSubmitButton.classList.remove('d-none');
				formSubmitButton.classList.add('d-inline-block');
				formContinueButton.classList.add('d-none');
			} else if (stepperObj.getCurrentStepIndex() === 7) { //7
				formSubmitButton.classList.add('d-none');
				formContinueButton.classList.add('d-none');
			} else if (stepperObj.getCurrentStepIndex() === 4) {
				var sumber = form.querySelector('[name="sumber_biaya"]').value; // Assuming 'sumber_biaya' is a form field
		
				if (sumber === '1') {
					formContinueButton.classList.add('d-none'); // hide the continue button
				
				}
			
				
			} else {
				formSubmitButton.classList.remove('d-inline-block');
				formSubmitButton.classList.remove('d-none');
				formContinueButton.classList.remove('d-none');
			}
		});

		// Validation before going to next page
		stepperObj.on('kt.stepper.next', function (stepper) {

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
			console.log('a1');
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
		console.log('step 1');
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					'alamat_tetap_negeri': {
						validators: {
							notEmpty: {
								message: 'Negeri diperlukan'
							}
						}
					},
					'alamat_tetap_bandar': {
						validators: {
							notEmpty: {
								message: 'Bandar diperlukan'
							}
						}
					},
					'alamat_tetap_poskod': {
						validators: {
							notEmpty: {
								message: 'Poskod diperlukan'
							},
							digits: {
								message: 'Poskod mesti mengandungi digit sahaja'
							},
							stringLength: {
								min: 5,
								max: 5,
								message: 'Poskod mesti mengandungi 5 digit sahaja'
							}
						}
					},
					'alamat_surat_menyurat': {
						validators: {
							notEmpty: {
								message: 'Alamat surat menyurat diperlukan'
							}
						}
					},
					'alamat_surat_poskod': {
						validators: {
							notEmpty: {
								message: 'Poskod diperlukan'
							},
							digits: {
								message: 'Poskod mesti mengandungi digit sahaja'
							},
							stringLength: {
								min: 5,
								max: 5,
								message: 'Poskod mesti mengandungi 5 digit sahaja'
							}
						}
					},
					// 'parlimen': {
					// 	validators: {
					// 		notEmpty: {
					// 			message: 'Parlimen diperlukan'
					// 		}
					// 	}
					// },
					
					'alamat_surat_bandar': {
						validators: {
							notEmpty: {
								message: 'Bandar diperlukan'
							}
						}
					},
					'alamat_surat_negeri': {
						validators: {
							notEmpty: {
								message: 'Negeri diperlukan'
							}
						}
					},
					'negeri_lahir': {
						validators: {
							notEmpty: {
								message: 'Negeri Lahir diperlukan'
							}
						}
					},
					'keturunan': {
						validators: {
							notEmpty: {
								message: 'Keturunan diperlukan'
							}
						}
					},
					'tel_bimbit': {
						validators: {
							notEmpty: {
								message: 'No. Telefon Bimbit diperlukan'
							},
							digits: {
								message: 'No. Telefon Bimbit mesti mengandungi digit sahaja'
							},
						}
					},
					'tel_rumah': {
						validators: {
							digits: {
								message: 'No. Telefon Rumah mesti mengandungi digit sahaja'
							},
						}
					},
					'agama': {
						validators: {
							notEmpty: {
								message: 'Agama diperlukan'
							}
						}
					},
					'emel': {
						validators: {
							regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: 'Bukan alamat e-mel yang sah',
                            },
							notEmpty: {
								message: 'Alamat e-mel diperlukan'
							}
						}
					},
					'no_akaun_bank': {
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
		var step2Validator = FormValidation.formValidation(
			form,
			{
				fields: {
					'nama_waris': {
						validators: {
							notEmpty: {
								message: 'Nama Waris diperlukan'
							}
						}
					},
					'no_kp_waris': {
						validators: {
							callback: {
								message: 'No. Kad Pengenalan diperlukan',
								callback: function (input) {
									var pasportValue = form.querySelector('[name="no_pasport_waris"]').value;
									return input.value.trim() !== '' || pasportValue.trim() !== '';
								}
							}
						}
					},
					'hubungan_waris': {
						validators: {
							notEmpty: {
								message: 'Hubungan Waris diperlukan'
							}
						}
					},
					'tel_bimbit_waris': {
						validators: {
							notEmpty: {
								message: 'No. Tel Bimbit diperlukan'
							},
							digits: {
								message: 'No. Telefon Bimbit mesti mengandungi digit sahaja'
							},
						}
					},
					'alamat_waris': {
						validators: {
							notEmpty: {
								message: 'Alamat Tetap diperlukan'
							}
						}
					},
					'alamat_poskod_waris': {
						validators: {
							notEmpty: {
								message: 'Poskod diperlukan'
							},
							digits: {
								message: 'Poskod mesti mengandungi digit sahaja'
							},
							stringLength: {
								min: 5,
								max: 5,
								message: 'Poskod mesti mengandungi 5 digit sahaja'
							}
						}
					},
					'alamat_bandar_waris': {
						validators: {
							notEmpty: {
								message: 'Bandar diperlukan'
							}
						}
					},
					'alamat_negeri_waris': {
						validators: {
							notEmpty: {
								message: 'Negeri diperlukan'
							}
						}
					},
					'pekerjaan_waris': {
						validators: {
							notEmpty: {
								message: 'Pekerjaan Waris diperlukan'
							}
						}
					},
					'pendapatan_waris': {
						validators: {
							notEmpty: {
								message: 'Pendapatan Bulanan Waris diperlukan'
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
		);
		validations.push(step2Validator);
		var noPasportWaris = form.querySelector('[name="no_pasport_waris"]');
		if (noPasportWaris) {
			noPasportWaris.addEventListener('input', function () {
				step2Validator.revalidateField('no_kp_waris');
			});
		}

		// Step 3
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					'peringkat_pengajian': {
						validators: {
							notEmpty: {
								message: 'Peringkat Pengajian diperlukan'
							}
						}
					},
					'nama_kursus': {
						validators: {
							notEmpty: {
								message: 'Nama Kursus diperlukan'
							}
						}
					},
					'no_pendaftaran_pelajar': {
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
					'tarikh_mula': {
						validators: {
							notEmpty: {
								message: 'Tarikh Mula diperlukan'
							}
						}
					},
					'tarikh_tamat': {
						validators: {
							notEmpty: {
								message: 'Tarikh Tamat diperlukan'
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
					'bil_bulan_per_sem': {
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
				fields: {
					// 'amaun_yuran': {
					// 	validators: {
					// 		notEmpty: {
					// 			message: 'Amaun Yuran diperlukan'
					// 		}
					// 	}
					// },
					// 'amaun_wang_saku': {
					// 	validators: {
					// 		notEmpty: {
					// 			message: 'Amaun Wang Saku diperlukan'
					// 		}
					// 	}
					// }
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
								maxSize: 2 * 1024 * 1024, // Convert maxSize to bytes
								message: 'Fail tidak sah. Sila semak format dan saiz fail.',
							}
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
								maxSize: 2 * 1024 * 1024, // Convert maxSize to bytes
								message: 'Fail tidak sah. Sila semak format dan saiz fail.',
							}
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
								maxSize: 2 * 1024 * 1024, // Convert maxSize to bytes
								message: 'Fail tidak sah. Sila semak format dan saiz fail.',
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

		// Step 6
		validations.push(FormValidation.formValidation(
			form,
			{
				fields: {
					'perakuan': {
						validators: {
							notEmpty: {
								message: 'Anda mesti bersetuju dengan terma dan syarat'
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
