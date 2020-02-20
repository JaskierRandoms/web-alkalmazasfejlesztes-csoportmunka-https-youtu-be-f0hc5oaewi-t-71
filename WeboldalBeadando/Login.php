<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
</html>
<?php
require("connect.php");
require("functions.php");
    $username = $_POST["username"];
    $password = $_POST["password"];
    if(Exists($username,$password,$conn))
    {
        header("Location:index.php");

    }
    else
    {
        echo "Wrong username or password! Try again!";
        echo "<form action='index.php'>";
        echo "<input type='submit' value='Back' class='button'>";
        echo "</form>";
    }
    $conn->close();
?>