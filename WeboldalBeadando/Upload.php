<?php
require("connect.php");
require("functions.php");

if (isset($_POST['but_upload'])) {
    $tag = $_POST["tags"];
    $name = $_FILES['file']['name'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    // Check extension
    if (in_array($imageFileType, $extensions_arr)) {

        // Convert to base64 
        $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
        $image = 'data:image/' . $imageFileType . ';base64,' . $image_base64;
        // Insert record
        $query = "insert into images(image,tag) values('" . $image . "','".$tag."')";
        mysqli_query($conn, $query);

        // Upload file
       // move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name);
    }
}
?>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="upbox">
        <form method="POST" action="Upload.php" enctype='multipart/form-data'>
            <select name="tags" class='button'>
            <?php
                echo Options($conn);
            ?>
            </select>
            <input type="text" name="newtype">
            <input type="submit" value="Add new type" name="newtypea" class='button'><br><br>
            <input type='file' name='file' /><br><br>
            <input type='submit' value='Upload' class='button' id="rainbow" name='but_upload'>
            <input type='submit' value='Back' class='button' formaction="index.php">
            <?php
                if(isset($_POST["newtypea"]))
                {
                    NewType($_POST["newtype"],$conn);
                }
            ?>
        </form>
    </div>
</body>