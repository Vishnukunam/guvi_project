<?php
require_once "../assert/vendor/autoload.php";
$databaseConnection = new MongoDB\Client;
$myDatabase = $databaseConnection->guvi;
$userCollection = $myDatabase->profile;

if(isset($_POST['insert'])){
    $name = $_POST["name"];
    $age = $_POST["age"];
    $dob = $_POST["dob"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $place = $_POST["place"];
    $data = array(
        "Name"=> $name,
        "Age"=> $age,
        "Dob"=>$dob,
        "Email"=>$email,
        "Contat"=>$contact,
        "Place"=>$place
    );

    $insert = $userCollection->insertOne($data);

    if($insert){
        echo "<div class='alert alert-success'>Successfully registered</div>";
    }
    else{
        echo "<div class='alert alert-danger'>Try again</div>";
    }
}

if(isset($_POST['update'])){
    $name = $_POST["name"];
    $age = $_POST["age"];
    $dob = $_POST["dob"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $place = $_POST["place"];

    $data = array('$set'=>array(
        "Name"=>$name,
        "Age"=> $age,
        "Dob"=>$dob,
        "Email"=>$email,
        "Contat"=>$contact,
        "Place"=>$place
    ));
    $update = $userCollection->updateOne(array('Email' => $email), $data);

    if($update){
        echo "<div class='alert alert-success'>Update successful</div>";
    }
    else{
        echo "<div class='alert alert-danger'>Not updated</div>";
    }
}
?>
