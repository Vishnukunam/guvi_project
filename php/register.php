<?php

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "guvi";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepared statement for registering user
$stmt = $conn->prepare("INSERT INTO registration (first_name, last_name, user_name, email, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $first_name, $last_name, $user_name, $email_id, $password);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $user_name = $_POST["user_name"];
    $email_id = $_POST["email_id"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check if user already exists
    $stmt2 =$conn->prepare("SELECT * FROM registration WHERE email = ?");
    $stmt2->bind_param("s", $email_id);
    $stmt2->execute();
    $result = $stmt2->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        echo "Error: A user with this email already exists.";
    } else {
        $stmt->execute();
        echo "success";
    }

    $stmt->close();
    $stmt2->close();
}

$conn->close();

?>