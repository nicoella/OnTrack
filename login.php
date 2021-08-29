<?php
require_once "config.php";

session_start();

$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty(trim($_POST["username"]))) {
		$username_err = "Please enter your username.";
	} else {
		$username = $_POST['username'];
		$sql = "SELECT * FROM user WHERE username = '$username'";
		$resuser = mysqli_query($link, $sql);
		if($resuser && mysqli_num_rows($resuser)>0) {
			$_SESSION['username'] = $username;
		} else {
			$username_err = "Username does not exist!";
		}
	}
	if($username_err == "") {
		if(empty(trim($_POST["password"]))) {
			$password_err = "Please enter your password.";
		} else {
			$password = $_POST['password'];
		}
	}


	if($username_err == "" && $password_err == "") {
		while($row = mysqli_fetch_array($resuser, MYSQLI_ASSOC)) {
			$correct_pass = $row["password"];
			$type = $row["type"];
		}
		if($password == $correct_pass) { 
			if($type==1) header("Location: account_doctor.php");
			else header("Location: account_patient.php");
		} else {
			$password_err = "Incorrect password!";
		}
	}
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log In</title>
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
        <h2>Log In</h2>
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
	            <br>
	            <p style="color:#425b1c">Don't have an account? Sign up <a href="signup.php" style="color:#88a25e">here</a>.</p>
	        
	    </div>
	    <div class="form-group">
		    <input type="submit" class="button" value="Log In" width=100px>
		</div>
		</form>
    </div> 
       
</body>
</html>