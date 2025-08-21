"use strict";

// Class definition
var KTSignupGeneral = function () {
    // Elements
    var form;
    var submitButton;
    var validator;

    // Handle form
    var handleForm = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'terimaBiasiswa': {
                        validators: {
                            notEmpty: {
                                message: 'First Name is required'
                            }
                        }
                    },

                    'id_institusi': {
                        validators: {
                            notEmpty: {
                                message: 'First Name is required'
                            }
                        }
                    },
                    
                    'peringkat_pengajian': {
                        validators: {
                            notEmpty: {
                                message: 'First Name is required'
                            }
                        }
                    },
                    'nama_kursus': {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            }
                        }
                    },
                    
                },
                plugins: {
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',  // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
                }
            }
        );

        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();


            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    // Simulate ajax request
                    setTimeout(function () {
                        // Hide loading indication
                        submitButton.removeAttribute('data-kt-indicator');

                        // Enable button
                        submitButton.disabled = false;

                        // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "You have successfully reset your password!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                form.reset();  // reset form
                                //form.submit();

                                //form.submit(); // submit form
                                var redirectUrl = form.getAttribute('data-kt-redirect-url');
                                if (redirectUrl) {
                                    location.href = redirectUrl;
                                }
                            }
                        });
                    }, 1500);
                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });

    }


    // Handle form ajax
    var handleFormAjax = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'cuti': {
                        validators: {
                            choice: {
                                min: 1,
                                message: 'Sila pilih sama ada Ya atau Tidak'
                            }
                        }
                    },
                    'terimBiasiswa': {
                        validators: {
                            choice: {
                                min: 1,
                                message: 'Sila pilih sama ada Ya atau Tidak'
                            }
                        }
                    },
                    'nama_penaja': {
                        validators: {
                            callback: {
                                message: 'Sila pilih Biasiswa / Tajaan',
                                callback: function(input) {
                                    // only validate if user selected "ya"
                                    const terima = form.querySelector('input[name="terimBiasiswa"]:checked');
                                    if (terima && terima.value === "ya") {
                                        return input.value !== ""; // must select
                                    }
                                    return true; // skip validation if "tidak"
                                }
                            }
                        }
                    },
                    'id_institusi': {
                        validators: {
                            notEmpty: {
                                message: 'Pilih Pusat Pengajian'
                            }
                        }
                    },
                    'peringkat_pengajian': {
                        validators: {
                            notEmpty: {
                                message: 'Pilih Peringkat Pengajian'
                            }
                        }
                    },
                    'nama_kursus': {
                        validators: {
                            notEmpty: {
                                message: 'Pilih Nama Kursus'
                            },
                        }
                    },
                    
                },
                plugins: {
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',  // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
                }
            }
        );

        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();


            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;


                    // Check axios library docs: https://axios-http.com/docs/intro
                    axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form)).then(function (response) {
                        if (response) {
                            // Check if the user chose 'Ya' for cuti
                            const cutiValue = form.querySelector('input[name="cuti"]:checked')?.value;

                            // Check if the user chose 'Ya' for terimBiasiswa
                            const biasiswaValue = form.querySelector('input[name="terimBiasiswa"]:checked')?.value;

                            if (cutiValue === 'ya' || biasiswaValue === 'ya') {
                                let errorMessage = "";

                                if (cutiValue === 'ya') {
                                    errorMessage += "Anda tidak layak daftar kerana anda penerima Cuti Belajar Bergaji Penuh. ";
                                }
                                if (biasiswaValue === 'ya') {
                                    errorMessage += "Anda tidak layak daftar kerana anda penerima Biasiswa atau Tajaan Lain.";
                                }

                                Swal.fire({
                                    text: errorMessage.trim(),
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                    didClose: () => {
                                        window.location.href = '/login';
                                    }
                                });

                            } else {
                                // Both cuti and biasiswa are NOT "ya"
                                form.reset();

                                const redirectUrl = form.getAttribute('data-kt-redirect-url');
                                if (redirectUrl) {
                                    location.href = redirectUrl;
                                }
                            }
                        }

                        
                        else {
                            // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    }).catch(function (error) {
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

    }


    var isValidUrl = function(url) {
        try {
            new URL(url);
            return true;
        } catch (e) {
            return false;
        }
    }

    // Public functions
    return {
        // Initialization
        init: function () {
            // Elements
            form = document.querySelector('#kt_semak_form');
            submitButton = document.querySelector('#kt_semak_submit');

            if (isValidUrl(submitButton.closest('form').getAttribute('action'))) {
                handleFormAjax();
            } else {
                handleForm();
            }
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTSignupGeneral.init();
});
