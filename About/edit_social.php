<?php 
require_once("config.php"); 

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the item to be edited using prepared statement
    $stmt = mysqli_prepare($db, "SELECT * FROM social_media_profiles WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // Handle form submission for editing
    if(isset($_POST['update_submit'])) {
        $platform = $_POST['platform'];
        $alt = $_POST['alt'];
        $link = $_POST['link'];

        // Prepare image upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        

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
                // Update the item with image using prepared statement
                $update_query = "UPDATE social_media_profiles SET platform=?, img=?, alt=?, link=? WHERE id=?";
                $stmt = mysqli_prepare($db, $update_query);
                mysqli_stmt_bind_param($stmt, "ssssi", $platform, $target_file, $alt, $link, $id);
                if(mysqli_stmt_execute($stmt)) {
                    header("location:social.php?action=updated");
                    exit;
                } else {
                    echo '<div class="message">Error updating item.</div>';
                }
            } else {
                echo '<div class="message">Sorry, there was an error uploading your file.</div>';
            }
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
    <title>Edit Social Media Profile</title>
</head>
<body>
    <div class="container">
        <h2>Edit Social Media Profile</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Platform</label>
            <input type="text" name="platform" class="form-control" value="<?php echo $row['platform']; ?>" required>
            <label>Current Image</label><br>
            <?php if(!empty($row['img'])): ?>
                <img src="<?php echo $row['img']; ?>" alt="Current Image" style="max-width: 200px;"><br><br>
            <?php else: ?>
                <p>No image available</p>
            <?php endif; ?>
            <label>New Image</label>
            <input type="file" name="image" class="form-control">
            <label>Alt Text</label>
            <input type="text" name="alt" class="form-control" value="<?php echo $row['alt']; ?>" required>
            <label>Link</label>
            <input type="text" name="link" class="form-control" value="<?php echo $row['link']; ?>" required>
            <button type="submit" name="update_submit" class="btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
