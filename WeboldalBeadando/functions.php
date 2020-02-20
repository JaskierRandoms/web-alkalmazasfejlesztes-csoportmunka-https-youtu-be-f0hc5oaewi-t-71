<?php
 function Test($name)
 {
     $pattern = "/^[a-zA-Z0-9\.]{4,40}$/";
     
     return preg_match($pattern,$name);
 }
 function Exists($name,$password,$conn)
 {
     $sql = "SELECT * FROM users";
     $result = $conn->query($sql);
     if($result-> num_rows > 0)
     {
          while($row = $result->fetch_assoc())
         {
             if($name == $row["user"] && password_verify ( $password , $row["password"] ))
             {
                 $_SESSION["Username"]=$name;
                 $_SESSION["Admin"]=$row["admin"];
                 return true;
             }
         }
     }
     return false;
 }
 function AdminValid($user,$conn)
 {
     $sql="SELECT user FROM users WHERE user LIKE $user";
 }
 function Options($conn)
 {
     $output="";
     $sql = "SELECT TagId,tag FROM tags";
     $result = $conn -> query($sql);
     if($result -> num_rows > 0)
     {
        while($row = $result->fetch_assoc())
        {
            $output .= "<option value='";
            $output .= $row['TagId'];
            $output .= "'>";
            $output .= $row["tag"];
            $output .= "</option>";
        }
     }
     return $output;
 }
 function NewType ($name,$conn)
 {
    $sql="INSERT INTO tags (tag) VALUES ('$name')";
     if ($conn->query($sql) === TRUE) {
         header("Location:Upload.php");
        } 
        else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
 }
 function Pitcures($conn)
 {
    $sql = "SELECT * FROM images";
    $result = $conn -> query($sql);
    if($result -> num_rows > 0)
    {
        while($row = $result -> fetch_assoc())
        {
            $image_src = $row['image'];
            echo "<div class='pitcurebox'><img src='$image_src' alt='Nincs Kep'></div>";
        }
    }
 }
 function Random($conn)
 {
    $sql= "SELECT * FROM images ORDER BY RAND() LIMIT 1";
    $result = $conn -> query($sql);
    if($result -> num_rows > 0)
    {
        while($row = $result -> fetch_assoc())
        {
            $image_src = $row['image'];
            echo "<div class='pitcurebox'><img src='$image_src' alt='Nincs Kep'></div>";
        }
    }
 }
 function Filtered($conn,$filter)
 {
    $sql= "SELECT * FROM images WHERE tag = '$filter'";
    $result = $conn -> query($sql);
    if($result -> num_rows > 0)
    {
        while($row = $result -> fetch_assoc())
        {
            $image_src = $row['image'];
            echo "<div class='pitcurebox'><img src='$image_src' alt='Nincs Kep'></div>";
        }
    }
 }
 function AddAdmin($conn,$id)
 {
    $sql = "UPDATE users SET admin = '1' WHERE id = '$id';";
    if ($conn->query($sql) === TRUE) {
        header("Location:AdminChange.php");
       } 
       else
       {
           echo "Error: " . $sql . "<br>" . $conn->error;
       }
 }
 function RemoveAdmin($conn,$id)
 {
    $sql = "UPDATE users SET admin = '0'  WHERE id = '$id';";
    if ($conn->query($sql) === TRUE) {
        header("Location:AdminChange.php");
       } 
       else
       {
           echo "Error: " . $sql . "<br>" . $conn->error;
       }
 }
 function DeleteUser($conn,$id)
 {
    $sql = "DELETE FROM users WHERE id='$id';";
    if ($conn->query($sql) === TRUE) {
        header("Location:AdminChange.php");
       } 
       else
       {
           echo "Error: " . $sql . "<br>" . $conn->error;
       }
 }

?>