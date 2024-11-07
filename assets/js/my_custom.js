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
                // alert("Enrollment successful!");

                // successfull alert msg
                function showSuccessMessage(message) {
                    const successDiv = document.querySelector('.succuss_msg');
                    successDiv.textContent = message;
                    successDiv.style.display = 'block';
                    successDiv.style.color = 'green';
                    successDiv.style.fontWeight = 'bold';
                    setTimeout(() => {
                        successDiv.style.display = 'none';
                    }, 3000); 
                }
                document.addEventListener('DOMContentLoaded', () => {
                    document.querySelector('.succuss_msg').style.display = 'none';
                });
                showSuccessMessage('Form submitted successfully!');
                // successfull alert msg end

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

// databastable **************

    $(document).ready(function() {
    $('#studentTable').DataTable({
        dom: 'Bfrtip', // Adds the buttons container
        buttons: [
            'colvis' // Adds a column visibility button
        ],
        responsive: true,
        scrollX: true,
        paging: true,        // Enable pagination
        searching: true,     // Enable search functionality
        ordering: true,      // Enable sorting
        pageLength: 10,      // Set the number of entries per page
        lengthMenu: [5, 10, 25, 50] // Define custom page length options
    });
});

// delete enroll list item 
$(document).ready(function() {
    $(document).on('click', '.sdl_btnn', function(e) {
        e.preventDefault(); // Prevent default link behavior

        var studentID = $(this).data("id"); // Get the student's ID
        var rowElement = $(this).closest('tr'); // The row to be deleted

        if (confirm("Are you sure you want to delete this student?")) {
            $.ajax({
                type: "POST",
                url: "../admin/delete_student.php", // Update with the correct path
                data: { deleteid: studentID },

                // Show spinner before sending the request
                beforeSend: function() {
                    $('#loadingSpinner').show();
                },

                success: function(response) {
                    if (response === 'success') {
                        rowElement.fadeOut(); // Fade out the row if successful
                    } else {
                        rowElement.fadeOut();;
                    }
                },
                // Hide spinner once the request completes
                complete: function() {
                    $('#loadingSpinner').hide();
                },

                error: function() {
                    alert("An error occurred while processing the request.");
                }
            });
        }
    });
});

// courses managemnet
document.getElementById('addCourseForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var courseName = document.getElementById('courseName').value;

    var formData = new FormData();
    formData.append('courseName', courseName);

    fetch('../course_management/manage_courses.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // alert(data);
        location.reload(); // Reload the page to show the updated course list
    })
    .catch(error => console.error('Error:', error));
});

// Handle course soft deletion (mark as deleted) using AJAX
document.querySelectorAll('.deleteCourseBtn').forEach(function(button) {
    button.addEventListener('click', function() {
        var courseId = this.getAttribute('data-id');

        var formData = new FormData();
        formData.append('courseId', courseId);

        fetch('../course_management/manage_courses.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // alert(data);
            location.reload(); // Reload the page to remove the deleted course from the list
        })
        .catch(error => console.error('Error:', error));
    });
});
    



