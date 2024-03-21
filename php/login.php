<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guvi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind SQL statement
$stmt = $conn->prepare("SELECT * FROM registration WHERE email = ?");
$stmt->bind_param("s", $email);

// Set parameters and execute
$email = $_POST['email'];
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows == 1) {
    // Fetch the user data
    $user = $result->fetch_assoc();

    // Verify the password
    if (password_verify($_POST['password'], $user['password'])) {
        echo json_encode(array('success' => true, 'message' => 'Login successful!'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Invalid email or password!'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid email or password!'));
}

$stmt->close();
$conn->close();
?>