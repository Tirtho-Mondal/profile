<?php 
require_once("config.php"); 

// Handle form submission for insertion
if(isset($_POST['insert_submit'])) {
    $platform = $_POST['platform'];
    $alt = $_POST['alt'];
    $link = $_POST['link'];

    // Prepare image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if file is uploaded
    if (!empty($_FILES["image"]["tmp_name"]) && file_exists($_FILES["image"]["tmp_name"])) {
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

        // If everything is ok, try to upload file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Insert new item with image using prepared statement
                $insert_query = "INSERT INTO social_media_profiles (platform, img, alt, link) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($db, $insert_query);
                mysqli_stmt_bind_param($stmt, "ssss", $platform, $target_file, $alt, $link);
                if(mysqli_stmt_execute($stmt)) {
                    header("location:social.php?action=inserted");
                    exit;
                } else {
                    echo '<div class="message">Error inserting item.</div>';
                }
            } else {
                echo '<div class="message">Sorry, there was an error uploading your file.</div>';
            }
        }
    } else {
        echo '<div class="message">No file uploaded.</div>';
        $uploadOk = 0;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Add Social Media Profile</title>
</head>
<body>
    <div class="container">
        <h2>Add Social Media Profile</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Platform</label>
            <input type="text" name="platform" class="form-control" required>
            <label>New Image</label>
            <input type="file" name="image" class="form-control">
            <label>Alt Text</label>
            <input type="text" name="alt" class="form-control" required>
            <label>Link</label>
            <input type="text" name="link" class="form-control" required>
            <button type="submit" name="insert_submit" class="btn-primary">Insert</button>
        </form>
    </div>
</body>
</html>
