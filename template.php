<?php
require_once "config.php";

session_start();

$number = 0;
$number_err = "";
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
        <a href="account_patient.php">Account</a>
        <a href="goals.php">Goals</a>
        <a href="log.php">Diet Logs</a>
        <a href="#" class="active">Diet Template</a>  
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
                    $data = $row["breakfast"];
                }
                $items = explode("entry: ",$data, 1000);
                for($i=1; $i<sizeof($items); $i++) {
                    echo "<td>$items[$i]</td>";
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
                    $data = $row["lunch"];
                }
                $items = explode("entry: ",$data, 1000);
                for($i=1; $i<sizeof($items); $i++) {
                    echo "<td>$items[$i]</td>";
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
                    $data = $row["snack"];
                }
                $items = explode("entry: ",$data, 1000);
                for($i=1; $i<sizeof($items); $i++) {
                    echo "<td>$items[$i]</td>";
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
                    $data = $row["dinner"];
                }
                $items = explode("entry: ",$data, 1000);
                for($i=1; $i<sizeof($items); $i++) {
                    echo "<td>$items[$i]</td>";
                }
                ?>
            </tr>
        </table>
    </div>   
</body>
</html>