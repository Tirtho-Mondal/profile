<?php 
require_once("config.php"); 

if(isset($_POST['upload_submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    // Image handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo '<div class="message">File is not an image.</div>';
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo '<div class="message">Sorry, your file is too large.</div>';
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo '<div class="message">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>';
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<div class="message">Sorry, your file was not uploaded.</div>';
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert the new skill into the database
            $insert_query = "INSERT INTO skills (name, description, date, image) VALUES ('$name', '$description', '$date', '$target_file')";
            if(mysqli_query($db, $insert_query)) {
                header("location: skill.php?action=uploaded");
                exit;
            } else {
                echo '<div class="message">Error uploading skill.</div>';
            }
        } else {
            echo '<div class="message">Sorry, there was an error uploading your file.</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Upload New Skill</title>
</head>
<body>
    <div class="container">
        <h2>Upload New Skill</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
            <label>Description</label>
            <textarea name="description" class="form-control" required></textarea>
            <label>Date</label>
            <input type="date" name="date" class="form-control" required>
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
            <button type="submit" name="upload_submit" class="btn-primary">Upload</button>
        </form>
    </div>
</body>
</html>
