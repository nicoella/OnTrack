<?php
require_once "config.php";

session_start();

$username = $password = "";
$check = 1;
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty(trim($_POST["username"]))) {
		$username_err = "Please enter a username.";
	} else {
		$username = $_POST['username'];
		$sql = "SELECT * FROM user WHERE username = '$username'";
		$res = mysqli_query($link, $sql);
		if($res && mysqli_num_rows($res)>0) {
			$username_err = "Username already exists!";
		} else {
			$_SESSION['username'] = $username;
		}

	}
	if(empty(trim($_POST["password"]))) {
		$password_err = "Please enter a password.";
	} else {
		$password = $_POST['password'];
	}
	if(!empty($_POST["type"])) {
		$check = $_POST["type"];
	}

	if($username_err == "" && $password_err == "") {
        $number = rand(1000,9999);
        if($check==1) {
            while(true) {
                $sql = "SELECT * FROM user WHERE number = '$number'";
                $res = mysqli_query($link, $sql);
                if(!$res || mysqli_num_rows($res)==0) {
                    break;
                }
            }
        } else {
            $number = 0;
        }
		$sql = "INSERT INTO user (username, password, type, number, connection, goal, deadline, notes, breakfast, lunch, snack, dinner, comments, date, title, ingredients, calories, macronutrients) 
		VALUES ('$username', '$password', '$check', '$number', '', '', '', '', '', '', '', '', '', '', '', '', '', '')";
		$link->query($sql);
        if($check==1) header("Location: account_doctor.php");
        else header("Location: account_patient.php");
	}
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
      <p id="logo" style="margin-right: auto; margin-top: 20px">OnTrack</p>
      <nav>
        <ul class="nav_links">
          <li><a href="index.php#about">About</a></li>
          <li><a href="index.php#whytrack">Why track</a></li>
          <li><a href="index.php#tips">Tips</a></li>
        </ul>
      </nav>
      <a href="login.php"><button id="login_btn">Log in</button></a>
    </header>
    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Sign Up</h2>
        <div class="box">
            <div class="form-group">
                <br>
                <label>Username:</label><br>
                    <input type="text" name="username" style="text-align: left;"><br>
                    <label class="error"><?php echo "$username_err";?></label><br>
            </div>    
            <div class="form-group">
                <label>Password:</label><br>
                    <input type="password" name="password"  style="text-align: left; "><br>
                    <label class="error"><?php echo "$password_err";?></label><br>
            </div>
            <div class="form-group">
            	<label>Account Type</label><br>
            	<input type="radio" id="type1" name="type" value=1 <?php if($check == 1){echo"checked='checked'";}?> style="width: 20px ! important;">
            	<label for="type1" style="margin-right: 50px ! important;">Dietitian</label>
            	<input type="radio" id="type2" name="type" value=2 <?php if($check == 2){echo"checked='checked'";}?> style="width: 20px ! important;">
            	<label for="type2" style="margin-right: 50px ! important;">Patient</label>
            </div><br><br>
            <p style="color:#425b1c">Have an account? Log in <a href="login.php" style="color:#88a25e">here</a>.</p>
        </div>
        <div class="form-group">
            <input type="submit" class="button" value="Sign Up">
        </div>
    </form>
    </div>    
</body>
</html>