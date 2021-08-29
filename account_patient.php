<?php
require_once "config.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="nav">
        <a class="title">OnTrack</a>
        <a href="account_patient.php" class="active">Account</a>
        <a href="goals.php">Goals</a>
        <a href="log.php">Diet Logs</a>
        <a href="template.php">Diet Template</a>  
        <?php 
        $username=$_SESSION['username'];
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $res = mysqli_query($link, $sql);
        while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $doctor = $row["connection"];
        }
        if($doctor!='') echo "<a href='viewdoctor.php'>Doctor</a>";
        else echo "<a href='add.php'>Add Doctor</a>";
        ?>   
    </div>
    <div class="wrapper">
    	<h2>Account Information</h2>
        <h3>Your account information.</h3>
    	<div class="box">
    		<label>Username: <?php $username=$_SESSION['username']; echo "$username";?></label><br>
    		<label>Account Type: Patient</label><br>
    	</div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <input type="submit" class="button" value="Log Out" width=100px>
        </div>
        </form>
    </div>
</body>
