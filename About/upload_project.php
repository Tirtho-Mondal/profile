<?php
require_once("config.php");

if(isset($_POST['upload_submit'])) {
    $title = $_POST['title'];
    $sub_title = $_POST['sub_title'];
    $desc = $_POST['desc'];
    $github_link = $_POST['github_link'];

    // Image handling
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed_exts = array("jpg", "jpeg", "png", "gif");

        if(in_array($image_ext, $allowed_exts)) {
            $image_path = "uploads/" . uniqid() . "." . $image_ext;
            move_uploaded_file($image_tmp, $image_path);
        } else {
            echo '<div class="message">Invalid image format. Please upload JPG, JPEG, PNG, or GIF.</div>';
            exit;
        }
    } else {
        echo '<div class="message">No image uploaded.</div>';
        exit;
    }

    // Insert the new project into the database
    $insert_query = "INSERT INTO projects (title, sub_title, `desc`, github_link, img_src) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $insert_query);
    mysqli_stmt_bind_param($stmt, "sssss", $title, $sub_title, $desc, $github_link, $image_path);

    if(mysqli_stmt_execute($stmt)) {
        header("location: project.php?image_success=1");
        exit;
    } else {
        echo '<div class="message">Error uploading project.</div>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Upload Project</title>
</head>
<body>
    <div class="container">
        <h2>Upload New Project</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
            <label>Sub Title</label>
            <input type="text" name="sub_title" class="form-control" required>
            <label>Description</label>
            <textarea name="desc" class="form-control" required></textarea>
            <label>Github Link</label>
            <input type="text" name="github_link" class="form-control" required>
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
            <button type="submit" name="upload_submit" class="btn-primary">Upload</button>
        </form>
    </div>
</body>
</html>
