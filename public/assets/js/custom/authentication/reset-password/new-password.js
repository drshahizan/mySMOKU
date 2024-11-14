"use strict";

// Class Definition
var KTAuthNewPassword = function() {
    // Elements
    var form;
    var submitButton;
    var validator;
    var passwordMeter;

    var handleForm = function(e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'Kata laluan diperlukan.'
                            },
                            callback: {
                                message: 'Kata laluan perlu mengandungi huruf besar, huruf kecil, nombor, dan simbol, serta sekurang-kurangnya 12 aksara',
                                callback: function (input) {
                                    const password = input.value;
                                    const meterBars = document.querySelectorAll('[data-kt-password-meter-control="highlight"] .flex-grow-1');
                            
                                    // Reset all meter bar classes
                                    meterBars.forEach(bar => bar.classList.remove('bg-secondary', 'bg-warning', 'bg-success', 'bg-danger'));
                            
                                    // Check password conditions
                                    let strength = 0;
                            
                                    if (password.length >= 12) strength++; // Length check
                                    if (/[a-z]/.test(password)) strength++; // Lowercase letter check
                                    if (/[A-Z]/.test(password)) strength++; // Uppercase letter check
                                    if (/\d/.test(password)) strength++;    // Number check
                                    // if (/[@$!%*?&]/.test(password)) strength++; // Symbol check
                                    if (/[!@#$%^&*()_+-]/.test(password)) strength++; // Symbol check
                            
                                    // Update meter bar colors based on strength
                                    if (strength === 1 && password.length < 12) {
                                        meterBars.forEach(bar => bar.classList.add('bg-danger')); // Weak (red)
                                    } else if (strength === 2 && password.length < 12) {
                                        meterBars.forEach(bar => bar.classList.add('bg-warning')); // Moderate (yellow)
                                    } else if (strength === 3 && password.length < 12) {
                                        meterBars.forEach(bar => bar.classList.add('bg-info')); // Stronger (blue)
                                    } else if (strength === 5 && password.length >= 12) {
                                        meterBars.forEach(bar => bar.classList.add('bg-success')); // Strongest (green)
                                    }
                            
                                    // Return validation result based on full criteria
                                    if (strength < 5 || password.length < 12) {
                                        return {
                                            valid: false,
                                            message: 'Kata laluan perlu mengandungi huruf besar, huruf kecil, nombor, dan simbol, serta sekurang-kurangnya 12 aksara'
                                        };
                                    }
                                    return { valid: true };
                                }
                            }
                            
                            
                        }
                    },
                    'password_confirmation': {
                        validators: {
                            notEmpty: {
                                message: 'Pengesahan kata laluan diperlukan.'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'Kata laluan dan pengesahannya tidak sama.'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger({
                        event: {
                            password: false
                        }
                    }),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',  // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
                }
            }
        );

        form.querySelector('input[name="password"]').addEventListener('input', function() {
            if (this.value.length > 12) {
                validator.updateFieldStatus('password', 'NotValidated');
            }
        });
    }


    var handleSubmitDemo = function (e) {
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            validator.revalidateField('password');

            validator.validate().then(function(status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    // Simulate ajax request
                    setTimeout(function() {
                        // Hide loading indication
                        submitButton.removeAttribute('data-kt-indicator');

                        // Enable button
                        submitButton.disabled = false;

                        // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Anda telah berjaya menetapkan semula kata laluan anda",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                form.querySelector('[name="password"]').value= "";
                                form.querySelector('[name="password_confirmation"]').value= "";
                                passwordMeter.reset();  // reset password meter
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

            validator.revalidateField('password');

            // Validate form
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    // Check axios library docs: https://axios-http.com/docs/intro
                    axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form)).then(function (response) {
                        if (response) {
                            form.reset();

                            const redirectUrl = form.getAttribute('data-kt-redirect-url');

                            if (redirectUrl) {
                                location.href = redirectUrl;
                            }
                        } else {
                            // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            Swal.fire({
                                text: "Maaf, emel ini tidak betul. Sila cuba lagi.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    }).catch(function (error) {
                        Swal.fire({
                            text: "Maaf, terdapat beberapa ralat yang dikesan. Sila cuba lagi.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
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
                        text: "Sila masukkan maklumat yang diperlukan.",
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

    var validatePassword = function() {
        return  (passwordMeter.getScore() > 100);
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
        init: function() {
            form = document.querySelector('#kt_new_password_form');
            submitButton = document.querySelector('#kt_new_password_submit');
            passwordMeter = KTPasswordMeter.getInstance(form.querySelector('[data-kt-password-meter="true"]'));

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
KTUtil.onDOMContentLoaded(function() {
    KTAuthNewPassword.init();
});
