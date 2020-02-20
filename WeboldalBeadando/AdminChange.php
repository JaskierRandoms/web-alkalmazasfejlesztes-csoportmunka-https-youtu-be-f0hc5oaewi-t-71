<?php
require("connect.php");
require("functions.php");
$output="";
$name = $_SESSION["Username"];
$sql = "SELECT * FROM users WHERE user NOT LIKE '$name'";
$result = $conn -> query($sql);
    if($result -> num_rows > 0)
    {
        $i=0;
        while($row = $result->fetch_assoc())
        {
            $output.="<tr";
            $output.=($i%2==0)?" class='paros'":"";
            $output.=">";
            $output.="<td>".$row["user"]."</td>";
            $output.="<td>".$row["admin"]."</td>";
            $output.="<td>";
                $output.="<form action='' method='POST'>";
                $output.="<input type='hidden' name='id' value='";
                $output.=$row['id']."'/>";
                $output.="<input type='submit' value='Add Admin' name='AddAdmin' class='button'>";
                $output.="</form>";
            $output.="</td>";
            $output.="<td>";
                $output.="<form action='' method='POST'>";
                $output.="<input type='hidden' name='id' value='";
                $output.=$row['id']."'/>";
                $output.="<input type='submit' value='Delete Admin' name='DeleteAdmin' class='button'>";
                $output.="</form>";
            $output.="</td>";
            $output.="<td>";
                $output.="<form action='' method='POST'>";
                $output.="<input type='hidden' name='id' value='";
                $output.=$row['id']."'/>";
                $output.="<input type='submit' value='Delete User' name='DeleteUser' class='button'";
                $output.="</form>";
            $output.="</td>";
            $output.="</tr>";
            $i++;
        }
    }
    if(isset($_POST["AddAdmin"]))
    {
        AddAdmin($conn,$_POST["id"]);
    }
    else if(isset($_POST["DeleteAdmin"]))
    {
        RemoveAdmin($conn,$_POST["id"]);
    }
    else if(isset($_POST["DeleteUser"]))
    {
        DeleteUser($conn,$_POST["id"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="adminbox">
        <table>
        <tr>
        <th>Username</th><th>Admin Status</th><th colspan="3">Options</th>
        </tr>
        <?php
        echo $output;
        ?>
        </table><br>
        <input type='submit' value='Back' class='button' formaction="index.php">
    </div>
</body>
</html>