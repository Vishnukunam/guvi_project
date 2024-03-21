const email = window.localStorage.getItem("email");
document.getElementById("email").value=email;
$(document).ready(function() {
    $('#logout').click(function(){
        window.location.href = "./login.html"
    });

    $('#insertBtn').click(function() {
        var name = $('#name').val();
        var dob = $('#dob').val();
        var age = $('#age').val();
        var email = $('#email').val();
        var contact = $('#contact').val();
        var place = $('#place').val();
        
        $.ajax({
            type: 'POST',
            url: 'php/profile.php',
            data: {
                insert: true,
                name: name,
                dob: dob,
                age: age,
                email: email,
                contact: contact,
                place: place
            },
            success: function(response) {
                $('#responseMessage').html(response);
                $("#name").val("");
                $("#dob").val("");
                $("#age").val("");
                $("#email").val("");
                $("#contact").val("");
                $("#place").val("");
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $('#updateBtn').click(function() {
        var name = $('#name').val();
        var dob = $('#dob').val();
        var age = $('#age').val();
        var email = $('#email').val();
        var contact = $('#contact').val();
        var place = $('#place').val();
        
        $.ajax({
            type: 'POST',
            url: 'php/profile.php',
            data: {
                update: true,
                name: name,
                dob: dob,
                age: age,
                email: email,
                contact: contact,
                place: place
            },
            success: function(response) {
                $('#responseMessage').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
