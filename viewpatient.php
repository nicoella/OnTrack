<?php
require_once "config.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient Information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="nav">
        <a class="title">OnTrack</a>
        <a href="account_doctor.php">Account</a>
        <a href="viewlog.php">Diet Logs</a>
        <a href="viewtemplate.php">Diet Template</a>  
        <a href="#" class="active">Patient</a>    
    </div>
    <div class="wrapper">
    	<h2>Patient Information</h2>
        <h3>View your currently registered patient.</h3>
    	<div class="box">
            <?php 
            $username=$_SESSION['username'];
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $res = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $patient = $row["connection"];
            }
            if($patient!='') echo "<label>Patient Username: $patient</label>";
            else echo "<label>You currently have no registered patient.</label>";
            
            ?>
        </div>
    </div>
</body>
