<?php 
require_once("config.php"); 

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the education record to be edited
    $result = mysqli_query($db, "SELECT * FROM education WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    // Handle form submission for editing
    if(isset($_POST['update_submit'])) {
        $date_range = $_POST['date_range'];
        $institution = $_POST['institution'];
        $degree = $_POST['degree'];
        $details = $_POST['details'];

        // Update the education record
        $update_query = "UPDATE education SET date_range=?, institution=?, degree=?, details=? WHERE id=?";
        $stmt = mysqli_prepare($db, $update_query);
        mysqli_stmt_bind_param($stmt, "ssssi", $date_range, $institution, $degree, $details, $id);

        if(mysqli_stmt_execute($stmt)) {
            header("location: time_edu.php?action=updated");
            exit;
        } else {
            echo '<div class="message">Error updating education record.</div>';
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
    <title>Edit Education</title>
</head>
<body>
    <div class="container">
        <h2>Edit Education</h2>
        <form action="" method="POST">
            <label>Date Range</label>
            <input type="text" name="date_range" class="form-control" value="<?php echo $row['date_range']; ?>" required>
            <label>Institution</label>
            <input type="text" name="institution" class="form-control" value="<?php echo $row['institution']; ?>" required>
            <label>Degree</label>
            <input type="text" name="degree" class="form-control" value="<?php echo $row['degree']; ?>" required>
            <label>Details</label>
            <textarea name="details" class="form-control" required><?php echo $row['details']; ?></textarea>
            <button type="submit" name="update_submit" class="btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
