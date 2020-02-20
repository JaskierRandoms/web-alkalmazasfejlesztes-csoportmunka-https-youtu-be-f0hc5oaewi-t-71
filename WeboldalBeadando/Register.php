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
    if(!Exists($username,$password,$conn) && Test($username))
    {
        $password=password_hash($password,PASSWORD_DEFAULT);
        $sql="INSERT INTO users (user, password, admin) VALUES ('$username', '$password', '0')";
        if ($conn->query($sql) === TRUE) {
        echo "You have registered successfully!";
        echo "<form action='index.php'>";
        echo "<input type='submit' value='Back' class='button'>";
        echo "</form>";

        } 
        else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else
    {
        echo "Your tried to register unsuccessfully! ";
        echo "<form action='index.php'>";
        echo "<input type='submit' value='Back' class='button'>";
        echo "</form>";
    }
    $conn->close();
?>