const email = window.localStorage.getItem("email_id");
document.getElementById("email").value=email;

$(document).ready(function() {
    $('#loginForm').submit(function(event) { 
        event.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();
        $.ajax({
            type: 'POST',
            url: 'php/login.php',
            data: { email: email, password: password },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#message').html(response.message);
                    window.localStorage.setItem("email",email);
                    window.location.href = "profile.html";
                } else {
                    $('#message').html(response.message);
                }
            },
            error: function(xhr, status, error) {
                $('#message').html('An error occurred: ' + status + ' ' + error);
            }
        });
    });
});