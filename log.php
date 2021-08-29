<?php
require_once "config.php";

session_start();

$number = 0;
$number_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['button1'])) $_SESSION['press'] = 1;
    else if(isset($_POST['button2'])) {
        $_SESSION['press'] = 0;
        $date = $_POST['date'];
        $title = $_POST['title'];
        $ingredients = $_POST['ingredients'];
        $calories = $_POST['calories'];
        $macronutrients = $_POST['macronutrients'];

        $username = $_SESSION['username'];
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $res = mysqli_query($link, $sql);
        while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $curdate = $row["date"];
            $curtitle = $row["title"];
            $curingredients = $row["ingredients"];
            $curcalories = $row["calories"];
            $curmacronutrients = $row["macronutrients"];
        }
        $newdate = "$curdate entry: $date";
        $newtitle = "$curtitle entry: $title";
        $newingredients = "$curingredients entry: $ingredients";
        $newcalories = "$curcalories entry: $calories";
        $newmacronutrients = "$curmacronutrients entry: $macronutrients";
        $sql = "UPDATE user SET date = '$newdate', title = '$newtitle', ingredients = '$newingredients', calories = '$newcalories', macronutrients = '$newmacronutrients' WHERE username = '$username'";
        $link->query($sql);
    } else if(isset($_POST['button3'])) {
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $res = mysqli_query($link, $sql);
        while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $curdate = $row["date"];
            $curtitle = $row["title"];
            $curingredients = $row["ingredients"];
            $curcalories = $row["calories"];
            $curmacronutrients = $row["macronutrients"];
        }
        $dateexp = explode("entry: ",$curdate,1000);
        $titleexp = explode("entry: ",$curtitle,1000);
        $ingredientsexp = explode("entry: ",$curingredients,1000);
        $caloriesexp = explode("entry: ",$curcalories,1000);
        $macronutrientsexp = explode("entry: ",$curmacronutrients,1000);
        for($i=2; $i<sizeof($dateexp); $i++) {
            $newdate = "$newdate entry: $dateexp[$i]";
            $newtitle = "$newtitle entry: $titleexp[$i]";
            $newingredients = "$newingredients entry: $ingredientsexp[$i]";
            $newcalories = "$newcalories entry: $caloriesexp[$i]";
            $newmacronutrients = "$newmacronutrients entry: $macronutrientsexp[$i]";
        }
        $sql = "UPDATE user SET date = '$newdate', title = '$newtitle', ingredients = '$newingredients', calories = '$newcalories', macronutrients = '$newmacronutrients' WHERE username = '$username'";
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
        <a href="account_patient.php">Account</a>
        <a href="goals.php">Goals</a>
        <a href="#" class="active">Diet Logs</a>
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Diet Logs</h2>
        <h3>Track your nutritional intake and receive helpful feedback.</h3>
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
            if($_SESSION['press'] == 1) {
                echo "<tr>";
                echo "<td><input type='text' name='date' style='display: inline; width: 100%; height: 100%; box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; border: none;'></td>";
                echo "<td><input type='text' name='title' style='display: inline; width: 100%; height: 100%; box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; border: none;'></td>";
                echo "<td><input type='text' name='ingredients' style='display: inline; width: 100%; height: 100%; box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; border: white; background-color: none;'></td>";
                echo "<td><input type='text' name='calories' style='display: inline; width: 100%; height: 100%; box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; border: white; background-color: none;'></td>";
                echo "<td><input type='text' name='macronutrients' style='display: inline; width: 100%; height: 100%; box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; border: white; background-color: none;'></td>";
                echo "</tr>";
            }
            ?>
        </table>

        <br>
        <br>
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
        <br><br><br><br>
        <h2 style="margin-bottom: 0;">Comments and Feedback</h2>
        <div class = "cbox">
            <?php
            $username=$_SESSION['username'];
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $res = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $data = $row["comments"];
                }
            $items = explode("entry: ",$data, 1000);
            for($i=1; $i<sizeof($items); $i++) {
                echo "<p class='comment'>$items[$i]</p>";
            }
            ?>
        </div>

    </div>   

</body>
</html>