<?php
require_once "config.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['button1'])) $_SESSION['press'] = 1;
    else if(isset($_POST['button2'])) {
        $_SESSION['press'] = 0;
        $comment = $_POST['comment'];
        if(trim($comment)!='') {
            $username = $_SESSION['username'];
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $res = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $username = $row["connection"];
            }
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $res = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $curcomment = $row["comments"];
            }
            $newcomment = "$curcomment entry: $comment";
            $sql = "UPDATE user SET comments = '$newcomment' WHERE username = '$username'";
            $link->query($sql);
        }
    } else if(isset($_POST['button3'])) {
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $res = mysqli_query($link, $sql);
        while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $username = $row["connection"];
        }
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $res = mysqli_query($link, $sql);
        while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $curcomment = $row["comments"];
        }
        $commentexp = explode("entry: ",$curcomment,1000);
        for($i=2; $i<sizeof($commentexp); $i++) {
            $newcomment = "$newcomment entry: $commentexp[$i]";
        }
        $sql = "UPDATE user SET comments = '$newcomment' WHERE username = '$username'";
        $link->query($sql);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <script src="script.js"></script>
    <title>Diet Logs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="nav">
        <a class="title">OnTrack</a>
        <a href="account_doctor.php">Account</a>
        <a href="#" class="active">Diet Logs</a>
        <a href="viewtemplate.php">Diet Template</a>  
        <a href="viewpatient.php">Patient</a>
    </div>
    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Diet Logs</h2>
        <h3>Track patient nutritional intake and give helpful feedback.</h3>
        <table>
          <tr>
            <th>DATE</th>
            <th>TITLE</th>
            <th>INGREDIENTS</th>
            <th>CALORIES</th>
            <th>MACRONUTRIENTS</th>
          </tr>
            <?php
            $username = $_SESSION['username'];
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $res = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $username = $row["connection"];
            }
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $res = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $date = $row["date"];
                $title = $row["title"];
                $ingredients = $row["ingredients"];
                $calories = $row["calories"];
                $macronutrients = $row["macronutrients"];
            }
            $dateexp = explode("entry: ",$date,1000);
            $titleexp = explode("entry: ",$title,1000);
            $ingredientsexp = explode("entry: ",$ingredients,1000);
            $caloriesexp = explode("entry: ",$calories,1000);
            $macronutrientsexp = explode("entry: ",$macronutrients,1000);
            for($i=1; $i<sizeof($dateexp); $i++) {
                if(trim($dateexp[$i])!='') {
                    echo "<tr>";
                    echo "<td> $dateexp[$i] </td>";
                    echo "<td> $titleexp[$i]</td>";
                    echo "<td> $ingredientsexp[$i] </td>";
                    echo "<td> $caloriesexp[$i] </td>";
                    echo "<td> $macronutrientsexp[$i] </td>";
                    echo "</tr>";
                }
            } 
            ?>
        </table>
        
        <h2 style="margin-bottom: 0;">Comments and Feedback</h2>
        <div>
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
                $data = $row["comments"];
                }
            $items = explode("entry: ",$data, 1000);
            for($i=1; $i<sizeof($items); $i++) {
                echo "<p class='comment'>$items[$i]</p>";
            }
            if($_SESSION['press'] == 1) {
                echo "<p class='comment' style='padding: 0;'><input type='text' name='comment' style='border: 0; color: black; text-align: center;'></p>";
            }
            ?>
        </div>
        <div class="form-group">
            <?php 
            session_start();

            if($_SESSION['press'] == 0) {
                echo "<input type=\"submit\" class=\"button\" value=\"add\" style=\"width: 80px; margin:0 auto; position: absolute;  left: -140px; right: 0; top: 0; bottom: 0; display: inline-block\" name='button1'>";
            } else {
                echo "<input type=\"submit\" class=\"button\" value=\"save\" style=\"width: 80px; margin:0 auto; position: absolute; left: -140px; right: 0; top: 0; bottom: 0; display: inline-block\" name='button2'>";
            }
            
            ?>
            <input type="submit" class="button" value="clear top" style="width: 100px; margin: 0 auto; position: absolute;  left: 140px; right: 0; top: 0; bottom: 0;  display: inline-block; padding-top: 5px" name="button3">
        </div>
        </form>
    </div>   

</body>
</html>