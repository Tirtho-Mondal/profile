<?php 
require_once("config.php"); 

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the item to be edited using prepared statement
    $stmt = mysqli_prepare($db, "SELECT * FROM about_me_content WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // Handle form submission for editing
    if(isset($_POST['update_submit'])) {
        $image_path = $row['image_path'];
        $about_content = $_POST['about_content'];

        // Prepare image upload
        if (!empty($_FILES["image"]["name"])) {
            $target_dir = "";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
           
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo '<div class="message">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>';
                $uploadOk = 0;
            }
    
            // If everything is ok, try to upload file
            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_path = $target_file;
                } else {
                    echo '<div class="message">Sorry, there was an error uploading your file.</div>';
                }
            }
        }

        // Update the item using prepared statement
        $update_query = "UPDATE about_me_content SET image_path=?, about_content=? WHERE id=?";
        $stmt = mysqli_prepare($db, $update_query);
        mysqli_stmt_bind_param($stmt, "ssi", $image_path, $about_content, $id);
        if(mysqli_stmt_execute($stmt)) {
            header("location:about_me.php?action=updated");
            exit;
        } else {
            echo '<div class="message">Error updating item.</div>';
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
    <title>Edit About Me Content</title>
</head>
<body>
    <div class="container">
        <h2>Edit About Me Content</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Current Image</label><br>
            <?php if(!empty($row['image_path'])): ?>
                <img src="<?php echo $row['image_path']; ?>" alt="Current Image" style="max-width: 200px;"><br><br>
            <?php else: ?>
                <p>No image available</p>
            <?php endif; ?>
            <label>New Image</label>
            <input type="file" name="image" class="form-control">
            <label>About Content</label>
            <textarea name="about_content" class="form-control" required><?php echo $row['about_content']; ?></textarea>
            <button type="submit" name="update_submit" class="btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
