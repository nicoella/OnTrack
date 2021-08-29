<?php
require_once "config.php";

session_start();

$number = 0;
$number_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['button1'])) $_SESSION['press'] = 1;
    else if(isset($_POST['button2'])) {
        $_SESSION['press'] = 0;
        $goal = $_POST['goal'];
        $deadline = $_POST['deadline'];
        $notes = $_POST['notes'];
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $res = mysqli_query($link, $sql);
        while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $curgoal = $row["goal"];
            $curdeadline = $row["deadline"];
            $curnotes = $row["notes"];
        }
        $newgoal = "$curgoal entry: $goal";
        $newdeadline = "$curdeadline entry: $deadline";
        $newnotes = "$curnotes entry: $notes";
        
        $sql = "UPDATE user SET goal = '$newgoal', deadline = '$newdeadline', notes = '$newnotes' WHERE username = '$username'";
            $link->query($sql);
    } else if(isset($_POST['button3'])) {
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $res = mysqli_query($link, $sql);
        while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $curgoal = $row["goal"];
            $curdeadline = $row["deadline"];
            $curnotes = $row["notes"];
        }
        $goalexp = explode("entry: ",$curgoal,1000);
        $deadlineexp = explode("entry: ",$curdeadline,1000);
        $notesexp = explode("entry: ",$curnotes,1000);
        for($i=2; $i<sizeof($goalexp); $i++) {
            $newgoal = "$newgoal entry: $goalexp[$i]";
            $newdeadline = "$newdeadline entry: $deadlineexp[$i]";
            $newnotes = "$newnotes entry: $notesexp[$i]";
        }
        $sql = "UPDATE user SET goal = '$newgoal', deadline = '$newdeadline', notes = '$newnotes' WHERE username = '$username'";
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
        <a href="#" class="active">Goals</a>
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Goals</h2>
        <h3>Set goals to keep yourself on track.</h3>
        <table>
            <tr>
                <th>GOALS</th>
                <th>DEADLINE</th>
                <th>NOTES</th>
            </tr>
            <?php
            $username = $_SESSION['username'];
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $res = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $goal = $row["goal"];
                $deadline = $row["deadline"];
                $notes = $row["notes"];
            }
            $goalexp = explode("entry: ",$goal,1000);
            $deadlineexp = explode("entry: ",$deadline,1000);
            $notesexp = explode("entry: ",$notes,1000);
            for($i=1; $i<sizeof($goalexp); $i++) {
                if(trim($goalexp[$i])!='') {
                    echo "<tr>";
                    echo "<td> $goalexp[$i] </td>";
                    echo "<td> $deadlineexp[$i]</td>";
                    echo "<td> $notesexp[$i] </td>";
                    echo "</tr>";
                }
            } 
            if($_SESSION['press'] == 1) {
                echo "<tr>";
                echo "<td><input type='text' name='goal' style='display: inline; width: 100%; height: 100%; box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; border: none;'></td>";
                echo "<td><input type='text' name='deadline' style='display: inline; width: 100%; height: 100%; box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; border: none;'></td>";
                echo "<td><input type='text' name='notes' style='display: inline; width: 100%; height: 100%; box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; border: white; background-color: none;'></td>";
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
                echo "<input type=\"submit\" class=\"button\" value=\"add\" style=\"width: 80px; margin:0 auto; position: absolute;  left: -140px; right: 0; top: 0; bottom: 0; display: inline-block;\" name='button1'>";
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