// Bootstrap 5 form validation
(function () {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
})();

// Password Confirmation Validation
// const password = document.getElementById("password");
// const confirmPassword = document.getElementById("confirmPassword");
// if (password && confirmPassword) {
//     confirmPassword.addEventListener("input", function () {
//         if (confirmPassword.value !== password.value) {
//             confirmPassword.setCustomValidity("Passwords do not match");
//         } else {
//             confirmPassword.setCustomValidity("");
//         }
//     });
// }

// Enrollment Form Submission via AJAX in jQuery
$('#enrollmentForm').on('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    const formData = new FormData(this);

    // Send data using AJAX in jQuery
    $.ajax({
        url: 'submit_form.php', // Ensure this is the correct path to your server-side script
        type: 'POST',
        data: formData,
        contentType: false, // Necessary for FormData
        processData: false, // Necessary for FormData
        dataType: 'json', // Expecting JSON response

        beforeSend: function() {
            $('#loadingSpinner').show();
            $('.error-message').hide(); // Hide previous error messages
        },

        success: function(response) {
            if (response.success) {
                alert("Enrollment successful!");
                $('#enrollmentForm')[0].reset(); // Clear the form
                $('#enrollmentForm').removeClass('was-validated'); // Remove validation classes
                $('.error-message').hide(); // Hide all error messages
            } else if (response.errors) {
                // Loop through errors and display each below the relevant field
                $('#mobile-error').text(console.log(response.errors));
                $.each(response.errors, function(field, message) {
                    
                    $('#' + field + '-error').text(message).show();
                });
            } else {
                alert(response.message || "Unknown error occurred.");
            }
        },

        complete: function() {
            $('#loadingSpinner').hide();
        },

        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            let errorMessage = "There was a problem with your submission: ";
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage += xhr.responseJSON.message;
            } else {
                errorMessage += error;
            }
            alert(errorMessage);
        }
    });
});





