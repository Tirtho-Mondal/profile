<?php 
require_once("config.php"); 

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the experience record to be edited
    $result = mysqli_query($db, "SELECT * FROM experience WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    // Handle form submission for editing
    if(isset($_POST['update_submit'])) {
        $date_range = $_POST['date_range'];
        $position = $_POST['position'];
        $description = $_POST['description'];

        // Update the experience record
        $update_query = "UPDATE experience SET date_range=?, position=?, description=? WHERE id=?";
        $stmt = mysqli_prepare($db, $update_query);
        mysqli_stmt_bind_param($stmt, "sssi", $date_range, $position, $description, $id);

        if(mysqli_stmt_execute($stmt)) {
            header("location: time_exap.php?action=updated");
            exit;
        } else {
            echo '<div class="message">Error updating experience record.</div>';
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
    <title>Edit Experience</title>
</head>
<body>
    <div class="container">
        <h2>Edit Experience</h2>
        <form action="" method="POST">
            <label>Date Range</label>
            <input type="text" name="date_range" class="form-control" value="<?php echo $row['date_range']; ?>" required>
            <label>Position</label>
            <input type="text" name="position" class="form-control" value="<?php echo $row['position']; ?>" required>
            <label>Description</label>
            <textarea name="description" class="form-control" required><?php echo $row['description']; ?></textarea>
            <button type="submit" name="update_submit" class="btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
