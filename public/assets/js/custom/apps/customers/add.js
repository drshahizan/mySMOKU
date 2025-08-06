"use strict";

// Class definition
var KTModalCustomersAdd = function () {
    var submitButton;
    var cancelButton;
	var closeButton;
    var validator;
    var form;
    var modal;

    // Init form inputs
    var handleForm = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		validator = FormValidation.formValidation(
			form,
			{
				fields: {
                    
                    'nama': {
						validators: {
							notEmpty: {
								message: 'Nama diperlukan'
							}
						}
					},
                    'email': {
						validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: 'Alamat Emel tidak sah',
                            },
                            notEmpty: {
                                message: 'Alamat Emel diperlukan'
                            }
                        }
					},
					'no_kp': {
						validators: {
							notEmpty: {
								message: 'No. Kad Pengenalan diperlukan'
							}
						}
					},
					'tahap': {
						validators: {
							notEmpty: {
								message: 'Peranan diperlukan'
							}
						}
					},
                    'edit_institusi_ipt': {
                        validators: {
                            callback: {
                                message: 'Nama Pusat Pengajian diperlukan',
                                callback: function(input) {
                                    const tahap = document.getElementById('pilihtahap').value;
                                    // Required only if tahap == 2
                                    if (tahap === '2') {
                                        return input.value !== '';
                                    }
                                    return true; // Not required otherwise
                                }
                            }
                        }
                    },
                    'edit_institusi_ppk': {
                        validators: {
                            callback: {
                                message: 'Nama Pusat Pengajian diperlukan',
                                callback: function(input) {
                                    const tahap = document.getElementById('pilihtahap').value;
                                    // Required only if tahap == 6
                                    if (tahap === '6') {
                                        return input.value !== '';
                                    }
                                    return true; // Not required otherwise
                                }
                            }
                        }
                    },

					// 'password': {
					// 	validators: {
					// 		notEmpty: {
					// 			message: 'Kata laluan diperlukan'
					// 		},
                    //         callback: {
                    //             message: 'Masukkan kata laluan yang sah',
                    //             callback: function (input) {
                    //                 if (input.value.length >= 12) {
                    //                     return validatePassword();
                    //                 } else {
                    //                     // Password length is less than 12 characters, so it's not valid
                    //                     return false;
                    //                 }
                    //             }
                    //         }
					// 	}
					// },
					
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		);

		// Handle password input
        // form.querySelector('input[name="password"]').addEventListener('input', function () {
        //     if (this.value.length >= 12) {
        //         validator.updateFieldStatus('password', 'NotValidated');
        //     }
        // });

		// Action buttons
		submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            // validator.revalidateField('password');

            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;


                    // Check axios library docs: https://axios-http.com/docs/intro
                    axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form)).then(function (response) {
                        if (response.data.message) {
                            form.reset();
                
                            const redirectUrl = form.getAttribute('data-kt-redirect');
                
                            Swal.fire({
                                text: response.data.message,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                                didClose: () => {
                                    // Redirect the user after the Swal modal is closed
                                    if (redirectUrl) {
                                        window.location.href = redirectUrl;
                                    }
                                }
                            });
                        } else {
                            // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            Swal.fire({
                                text: "Sila lengkap maklumat pendaftaran.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    }).catch(function (error) {
                        if (error.response) {
                            // The request was made and the server responded with a status code
                            // that falls out of the range of 2xx
                            console.error("Response error:", error.response.status, error.response.data);
                        } else if (error.request) {
                            // The request was made but no response was received
                            console.error("Request error:", error.request);
                        } else {
                            // Something happened in setting up the request that triggered an Error
                            console.error("Error:", error.message);
                        }
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }).then(() => {
                        // Hide loading indication
                        submitButton.removeAttribute('data-kt-indicator');

                        // Enable button
                        submitButton.disabled = false;
                    });

                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Sila isi maklumat yang diperlukan",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });

        cancelButton.addEventListener('click', function (e) {
            console.log("Cancel button:", cancelButton);
            e.preventDefault();

            Swal.fire({
                text: "Pasti untuk batal?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form	
                    modal.hide(); // Hide modal
                    window.location.reload();				
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Belum dibatalkan.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

        // Password input validation
    var validatePassword = function () {
        return (passwordMeter.getScore() > 50);
    }

		closeButton.addEventListener('click', function(e){
            console.log("Close button:", closeButton);
			e.preventDefault();

            Swal.fire({
                text: "Pasti untuk batal?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form	
                    modal.hide(); // Hide modal	
                    window.location.reload();			
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Sambung untuk pendaftaran pengguna",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
		})
    }

    return {
        // Public functions
        init: function () {
            // Elements
            modal = new bootstrap.Modal(document.querySelector('#kt_modal_add_customer'));

            form = document.querySelector('#kt_modal_add_customer_form');
            submitButton = form.querySelector('#kt_modal_add_customer_submit');
            cancelButton = form.querySelector('#kt_modal_add_customer_cancel');
			closeButton = form.querySelector('#kt_modal_add_customer_close');

            handleForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
	KTModalCustomersAdd.init();
});