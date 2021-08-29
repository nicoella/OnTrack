<?php
require_once "config.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor Information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="nav">
        <a class="title">OnTrack</a>
        <a href="account_patient.php">Account</a>
        <a href="goals.php">Goals</a>
        <a href="log.php">Diet Logs</a>
        <a href="template.php">Diet Template</a>  
        <a href="#" class="active">Doctor</a>     
    </div>
    <div class="wrapper">
    	<h2>Doctor Information</h2>
        <h3>View your currently registered doctor.</h3>
    	<div class="box">
    		<?php 
            $username=$_SESSION['username'];
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $res = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $doctor = $row["connection"];
            }
            echo "<label>Dietician Username: $doctor</label><br>";
            $sql = "SELECT * FROM user WHERE username = '$doctor'";
            $res = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $number = $row["number"];
            }
            echo "<label>Dietician Number: $number</label>";
            ?>
    	</div>
    </div>
</body>
