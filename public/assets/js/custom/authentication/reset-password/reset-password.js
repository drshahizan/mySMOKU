"use strict";

// Class Definition
var KTAuthResetPassword = function () {
    // Elements
    var form;
    var submitButton;
    var validator;

    var handleForm = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'no_kp': {
                        validators: {
                            notEmpty: {
                                message: 'No Kad Pengenalan diperlukan'
                            },
							digits: {
								message: 'No Kad Pengenalan mesti mengandungi digit sahaja'
							}
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',  // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
                }
            }
        );

    }

    var handleSubmitDemo = function (e) {
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            // Validate form
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
                            text: "Kami telah menghantar pautan set semula kata laluan ke emel anda.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                form.querySelector('[name="email"]').value = "";
                                //form.submit();

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
                        text: "Maaf, nampaknya terdapat beberapa ralat yang dikesan. Sila cuba lagi.",
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

    var handleSubmitAjax = function (e) {
        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Validate form
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    // Check axios library docs: https://axios-http.com/docs/intro
                    // const form = document.querySelector('#yourFormId'); // Replace with the actual form ID

axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form))
    .then(function (response) {
        console.log(response);
        // Successful response
        if (response.data.success) {

            var no_kp = form.querySelector('[name="no_kp"]').value;
            $.ajax({
                url: 'getEmail/' + no_kp,
                type: 'GET', // Set the request type to GET
                data: { no_kp: no_kp },
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    if (response.success) {
                        var email = response.email;
                        var parts = email.split('@');
                        var maskedUsername = parts[0].slice(0, -4) + '****';
                        var maskedEmail = maskedUsername + '@' + parts[1];
        
                        const redirectUrl = form.getAttribute('data-kt-redirect-url');
        
                        if (redirectUrl) {
                            Swal.fire({
                                text: "Kami telah menghantar pautan set semula kata laluan ke emel " + maskedEmail,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                },
                                didClose: () => {
                                    window.location.href = redirectUrl;
                                }
                            });
                        }
                    } else {
                        // Handle the case where no user was found with the provided 'no_kp'
                        Swal.fire({
                            text: "User not found",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX errors
                    console.error(error);
                    Swal.fire({
                        text: "An error occurred while retrieving the email address",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        } else {
            // Server returned a success:false response
            Swal.fire({
                text: response.data.message || "An error occurred.", // Use the error message from the server response, or a default message
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn btn-danger"
                }
            });
        }
    })
    .catch(function (error) {
        // Error occurred during the request
        console.error('Error submitting reset request:', error);

        Swal.fire({
            text: "Maaf, nampaknya terdapat beberapa ralat yang dikesan. Sila cuba lagi.",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
    })
    .then(() => {
        // This block runs regardless of success or error
        // Hide loading indication
        submitButton.removeAttribute('data-kt-indicator');

        // Enable button
        submitButton.disabled = false;
    });

                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Masukkan alamat emel.",
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

    // Public Functions
    return {
        // public functions
        init: function () {
            form = document.querySelector('#kt_password_reset_form');
            submitButton = document.querySelector('#kt_password_reset_submit');

            handleForm();

            if (isValidUrl(form.getAttribute('action'))) {
                handleSubmitAjax(); // use for ajax submit
            } else {
                handleSubmitDemo(); // used for demo purposes only
            }
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAuthResetPassword.init();
});
