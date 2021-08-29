<?php
require_once "config.php";

session_start();

$number = 0;
$number_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty(trim($_POST["number"]))) {
		$number_err = "Please enter a 4-digit number.";
	} else {
        $username = $_SESSION['username'];
		$number = $_POST['number'];
		$sql = "SELECT * FROM user WHERE number = '$number'";
		$res = mysqli_query($link, $sql);
		if($res && mysqli_num_rows($res)>0) {
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $doctor = $row["username"];
            }
            $sql = "UPDATE user SET connection = '$doctor' WHERE username = '$username'";
            $link->query($sql);
            $sql = "UPDATE user SET connection = '$username' WHERE username = '$doctor'";
            $link->query($sql);
            header("Location: viewdoctor.php");
		} else {
            $number_err = "Number does not exist!";
		}
	}
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Doctor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="nav">
        <a class="title">OnTrack</a>
        <a href="account_patient.php">Account</a>
        <a href="goals.php">Goals</a>
        <a href="log.php">Diet Logs</a>
        <a href="template.php">Diet Template</a>  
        <a href="#" class="active">Add Doctor</a>    
    </div>
    <div class="wrapper">
        <h2>Add Doctor</h2>
        <h3>Connect with your dietitian.</h3>
        <div class="box">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Dietician Number:</label>
                <input type="text" name="number">
                <label class="error"><?php echo "$number_err";?></label><br>
            </div>    
            
        </form>
        </div>
    </div>    
</body>
</html>