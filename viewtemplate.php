<?php
require_once "config.php";
if(!isset($_SESSION))
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_SESSION['press']==0) $_SESSION['press'] = 1;
    else {
        $_SESSION['press'] = 0;
        $breakfast = "entry: ".$_POST['breakfast1']."entry: ".$_POST['breakfast2']."entry: ".$_POST['breakfast3']."entry: ".$_POST['breakfast4']."entry: ".$_POST['breakfast5'] ."entry: ".$_POST['breakfast6']."entry: ".$_POST['breakfast7'];
        $lunch = "entry: ".$_POST['lunch1']."entry: ".$_POST['lunch2']."entry: ".$_POST['lunch3']."entry: ".$_POST['lunch4']."entry: ".$_POST['lunch5'] ."entry: ".$_POST['lunch6']."entry: ".$_POST['lunch7'];
        $snack = "entry: ".$_POST['snack1']."entry: ".$_POST['snack2']."entry: ".$_POST['snack3']."entry: ".$_POST['snack4']."entry: ".$_POST['snack5'] ."entry: ".$_POST['snack6']."entry: ".$_POST['snack7'];
        $dinner = "entry: ".$_POST['dinner1']."entry: ".$_POST['dinner2']."entry: ".$_POST['dinner3']."entry: ".$_POST['dinner4']."entry: ".$_POST['dinner5'] ."entry: ".$_POST['dinner6']."entry: ".$_POST['dinner7'];
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $res = mysqli_query($link, $sql);
        while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $username = $row["connection"];
        }
        $sql = "UPDATE user SET breakfast = '$breakfast', lunch = '$lunch', snack = '$snack', dinner = '$dinner' WHERE username = '$username'";
        $link->query($sql);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Diet Template</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="nav">
        <a class="title">OnTrack</a>
        <a href="account_doctor.php">Account</a>
        <a href="viewlog.php">Diet Logs</a>
        <a href="#" class="active">Diet Template</a>  
        <a href="viewpatient.php">Patient</a>    
    </div>
    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    	<h2>Diet Template</h2>
    	<h3>Follow the personalized recommendations made by your dietitian.</h3>

        <table>
            <tr>
                <th> </th>
                <th>MON</th>
                <th>TUE</th>
                <th>WED</th>
                <th>THU</th>
                <th>FRI</th>
                <th>SAT</th>
                <th>SUN</th>
            </tr>
            <tr>
                <td style="font-family: font1; color: #637d3b; background-color:#c4d6ad">BREAKFAST</td>
                <?php
                $username=$_SESSION['username'];
                $sql = "SELECT * FROM user WHERE username = '$username'";
                $res = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                    $username = $row["connection"];
                }
                $sql = "SELECT * FROM user WHERE username = '$username'";
                $res = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                    $data = $row["breakfast"];
                }
                $items = explode("entry: ",$data, 1000);
                for($i=1; $i<sizeof($items); $i++) {
                    if($_SESSION['press']==1) echo "<td><input type='text' name='breakfast$i' style='display: inline; width: 100%; height: 100%; box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; border: none; color: black;' value='$items[$i]'></td>";
                    else echo "<td>$items[$i]</td>";
                }
                ?>
            </tr>
            <tr>
                <td style="font-family: font1; color: #637d3b; background-color:#c4d6ad">LUNCH</td>
                <?php
                $username=$_SESSION['username'];
                $sql = "SELECT * FROM user WHERE username = '$username'";
                $res = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                    $username = $row["connection"];
                }
                $sql = "SELECT * FROM user WHERE username = '$username'";
                $res = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                    $data = $row["lunch"];
                }
                $items = explode("entry: ",$data, 1000);
                for($i=1; $i<sizeof($items); $i++) {
                    if($_SESSION['press']==1) echo "<td><input type='text' name='lunch$i' style='display: inline; width: 100%; height: 100%; box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; border: none; color: black;' value='$items[$i]'></td>";
                    else echo "<td>$items[$i]</td>";
                }
                ?>
            </tr>
            <tr>
                <td style="font-family: font1; color: #637d3b; background-color:#c4d6ad">SNACK</td>
                <?php
                $username=$_SESSION['username'];
                $sql = "SELECT * FROM user WHERE username = '$username'";
                $res = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                    $username = $row["connection"];
                }
                $sql = "SELECT * FROM user WHERE username = '$username'";
                $res = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                    $data = $row["snack"];
                }
                $items = explode("entry: ",$data, 1000);
                for($i=1; $i<sizeof($items); $i++) {
                    if($_SESSION['press']==1) echo "<td><input type='text' name='snack$i' style='display: inline; width: 100%; height: 100%; box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; border: none; color: black;' value='$items[$i]'></td>";
                    else echo "<td>$items[$i]</td>";
                }
                ?>
            </tr>
            <tr>
                <td style="font-family: font1; color: #637d3b; background-color:#c4d6ad">DINNER</td>
                <?php
                $username=$_SESSION['username'];
                $sql = "SELECT * FROM user WHERE username = '$username'";
                $res = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                    $username = $row["connection"];
                }
                $sql = "SELECT * FROM user WHERE username = '$username'";
                $res = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                    $data = $row["dinner"];
                }
                $items = explode("entry: ",$data, 1000);
                for($i=1; $i<sizeof($items); $i++) {
                    if($_SESSION['press']==1) echo "<td><input type='text' name='dinner$i' style='display: inline; width: 100%; height: 100%; box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; border: none; color: black;' value='$items[$i]'></td>";
                    else echo "<td>$items[$i]</td>";
                }
                ?>
            </tr>
        </table>
        <div class="form-group">
            <?php 
            session_start();

            if($_SESSION['press'] == 0) {
                echo "<input type=\"submit\" class=\"button\" value=\"edit\" style=\"width: 80px\">";
            } else {
                echo "<input type=\"submit\" class=\"button\" value=\"save\" style=\"width: 80px\">";
            }
            ?>
        </div>
        </form>
    </div>   
</body>
</html>
