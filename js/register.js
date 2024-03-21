$(document).ready(function() {
  $("#registration_button").click(function() {
      var first_name = $("#first_name").val();
      var last_name = $("#last_name").val();
      var user_name = $("#User_name").val();
      var email_id = $("#email_id").val();
      var password = $("#password").val();
      var confirm_pass = $("#confirm_pass").val();

      if (first_name && last_name && user_name && email_id &&password && confirm_pass) {
          if (password === confirm_pass) {
              $.ajax({
                  url: "./php/register.php",
                  type: "POST",
                  data: {
                      first_name: first_name,
                      last_name: last_name,
                      user_name: user_name,
                      email_id: email_id,
                      password: password
                  },
                  success: function(response) {
                      if (response === "success") {
                        $("#registration_form")[0].reset();
                        window.localStorage.setItem("email_id",email_id);
                        window.location.href = "login.html";
                      } else {
                          alert("Error: " + response);
                      }
                  }
              });
          } else {
              alert("Passwords do not match!");
          }
      } else {
          alert("Please fill in all fields!");
      }
  });
});