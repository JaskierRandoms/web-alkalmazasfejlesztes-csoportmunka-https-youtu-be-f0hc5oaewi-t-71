<?php
require("connect.php");
require("functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>

<body>
    <div id="frame">
        <form action="" method="POST">
            <?php
            if(isset($_SESSION["Username"]))
            {
            echo"<div class='sticker'>" ;
            echo"<h1 class='welcome'> Welcome ".$_SESSION["Username"]."!</h1>";
            echo "<div class='menubuttons'>";
            echo"<input type='submit' class='button' value='Home'>";
            echo "<select name='tags'  class='button'>";
            echo Options($conn);
            echo "</select>";
            echo "<input type='submit' name='filter' value='Filter' class='button'>";
            echo "<input type='submit' name='random' value='Random' class='button' id='rainbow'>";
                if($_SESSION["Admin"]==1)
                {
                    echo"<input type='submit' value='Upload' class='button' formaction='Upload.php'>";
                    echo"<input type='submit' value='Admin Panel' class='button' formaction='AdminChange.php'>";
                }
                else
                {
                    echo"<input type='submit' value='Upload' class='button' formaction='Upload.php' disabled>";
                    echo"<input type='submit' value='Admin Panel' class='button' formaction='AdminChange.php' disabled>";
                }
            echo "</div>";
            echo "<input type='submit' name='Logout' value='Logout' class='logoutbutton' formaction='Logout.php'>";
            echo "</div>";
            }
            else
            {
                echo "<div class='sticker'>";
                echo "<div class='left'>";
                echo "<div class='menubuttons'>";
                echo"<input type='submit' class='button'>";
                echo "<select name='tags'  class='button' disabled>";
                echo Options($conn);
                echo "</select>";
                echo "<input type='submit' name='filter' value='Filter' class='button' disabled>";
                echo "<input type='submit' name='random' class='button' id='rainbow' value='Random'>";
                echo "</div>";
                echo "</div>";
                echo "<div class='right'>";
                echo "<div class='logreg'>";
                echo "<label>Username:<input type='text' name='username' class='texbox'></label><br>";
                echo "<label>Password:<input type='password' name='password' class='texbox'></label><br>";
                echo "<input type='submit' name='login' value='Login' class='logreg_button' formaction='Login.php'>";
                echo "<input type='submit' name='register' value='Register' class='logreg_button' formaction='Register.php'>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        ?>
        
        <?php
        if(isset($_POST["filter"]))
        {
            Filtered($conn,$_POST["tags"]);
        }
        else if(isset($_POST["random"]))
        {
            Random($conn);
        }
        else{
            Pitcures($conn);
        }
        ?>
        </form>
    </div>
</body>

</html>