<?php 
require_once("config.php"); 

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the project to be edited
    $result = mysqli_query($db, "SELECT * FROM projects WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    // Handle form submission for editing
    if(isset($_POST['update_submit'])) {
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
            // Keep the existing image if no new image is uploaded
            $image_path = $row['img_src'];
        }

        // Update the project with the new or existing image path
        $update_query = "UPDATE projects SET title=?, sub_title=?, `desc`=?, github_link=?, img_src=? WHERE id=?";
        $stmt = mysqli_prepare($db, $update_query);
        mysqli_stmt_bind_param($stmt, "sssssi", $title, $sub_title, $desc, $github_link, $image_path, $id);

        if(mysqli_stmt_execute($stmt)) {
            header("location: project.php?action=updated");
            exit;
        } else {
            echo '<div class="message">Error updating project.</div>';
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
    <title>Edit Project</title>
</head>
<body>
    <div class="container">
        <h2>Edit Project</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>" required>
            <label>Sub Title</label>
            <input type="text" name="sub_title" class="form-control" value="<?php echo $row['sub_title']; ?>" required>
            <label>Description</label>
            <textarea name="desc" class="form-control" required><?php echo $row['desc']; ?></textarea>
            <label>Github Link</label>
            <input type="text" name="github_link" class="form-control" value="<?php echo $row['github_link']; ?>" required>
            <label>Current Image</label><br>
            <?php if(!empty($row['img_src'])): ?>
                <img src="<?php echo $row['img_src']; ?>" alt="Current Image" style="max-width: 200px;"><br><br>
            <?php else: ?>
                <p>No image available</p>
            <?php endif; ?>
            <label>New Image</label>
            <input type="file" name="image" class="form-control">
            <button type="submit" name="update_submit" class="btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
