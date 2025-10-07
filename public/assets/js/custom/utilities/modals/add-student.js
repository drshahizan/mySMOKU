document.addEventListener("DOMContentLoaded", function () {
    var element = document.querySelector("#kt_create_account_stepper");
    var form = document.getElementById("kt_create_account_form");
    var formSubmitButton = document.querySelector('[data-kt-stepper-action="submit"]');
    var formContinueButton = document.querySelector('[data-kt-stepper-action="next"]');

    // Validation function
    var initValidation = function () {
        // ... your validation rules for different steps
        var validations = [];

        // Step 1
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
		validations.push(FormValidation.formValidation(
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
							notEmpty: {
								message: 'No. Kad Pengenalan diperlukan'
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
		));

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

        return validations;
    };

    var handleStepperEvents = function () {
        var stepper = new KTStepper(element);

        // Click event
		stepper.on("kt.stepper.click", async function (stepper) {
			// Get the current step index
			var currentStepIndex = stepper.getCurrentStepIndex();
			// console.log("Current Step: " + currentStepIndex);
		
			// Validate form only when moving to the next step
			var validationStatus = {};  // Object to store validation status for each step
			var firstInvalidStep = null;  // Variable to store the first invalid step
		
			// If the clicked step is valid or it is a step before the first invalid step, proceed
			var clickedStepIndex = stepper.getClickedStepIndex();
			console.log("Clicked Step: " + clickedStepIndex);
			console.log("firstInvalid Step: " + firstInvalidStep);

			stepper.goTo(clickedStepIndex);
			
		});
		
        // Next event
        stepper.on("kt.stepper.next", function (stepper) {
            // Validate form before change stepper step
            var currentStepIndex = stepper.getCurrentStepIndex();
            var validator = validations[currentStepIndex - 1];
        
			// NOT CHECKING VALIDATION
            // if (validator) {
            //     validator.validate().then(function (status) {
            //         if (status === "Valid") {
            //             stepper.goNext();
            //         } else {
			// 			Swal.fire({
			// 				text: "Sila lengkapkan maklumat yang diperlukan.",
			// 				icon: "error",
			// 				buttonsStyling: false,
			// 				confirmButtonText: "Ok",
			// 				customClass: {
			// 					confirmButton: "btn btn-light"
			// 				}
			// 			}).then(function () {
			// 				KTUtil.scrollTop();
			// 			});
			// 		}
            //     });
            // } else {
            //     stepper.goNext();
            // }

			// NOT CHECKING VALIDATION
			stepper.goNext();
        });
        
        // Prev event
        stepper.on('kt.stepper.previous', function (stepper) {
            // Validate form before changing stepper step
            var currentStepIndex = stepper.getCurrentStepIndex();
            var validator = validations[currentStepIndex - 1];

            if (validator) {
                validator.validate().then(function (status) {
                    stepper.goPrevious();
                    KTUtil.scrollTop();
                    
                });
            } else {
                stepper.goPrevious();
                KTUtil.scrollTop();
            }
        });

        // Stepper change event
        stepper.on('kt.stepper.changed', function (stepper) {
            // Validate form before changing stepper step
            var currentStepIndex = stepper.getCurrentStepIndex();
            var validator = validations[currentStepIndex - 1];

            if (validator) {
                validator.validate().then(function (status) {
                    handleStepChange(stepper, status);
                });
            } else {
                handleStepChange(stepper, 'Valid');
            }
        });
    };

    // Move this line after the initValidation function definition
    var validations = initValidation();

    // Handle step change function
    var handleStepChange = function (stepper, validationStatus) {
        var formSubmitButton = document.querySelector('[data-kt-stepper-action="submit"]');
        var formContinueButton = document.querySelector('[data-kt-stepper-action="next"]');
    
		console.log("Current Step: " + stepper.getCurrentStepIndex());
            if (stepper.getCurrentStepIndex() === 5) {
                formContinueButton.classList.add('d-none'); // hide the continue button
            } 
			else {
                formSubmitButton.classList.remove('d-inline-block');
                formSubmitButton.classList.remove('d-none');
                formContinueButton.classList.remove('d-none');
            }
    };
    
    // Initialize Stepper and handle events
    handleStepperEvents();
});
