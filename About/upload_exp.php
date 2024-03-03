<?php 
require_once("config.php"); 

// Handle form submission for inserting new data
if(isset($_POST['insert_submit'])) {
    $date_range = $_POST['date_range'];
    $position = $_POST['position'];
    $description = $_POST['description'];

    // Insert new experience record
    $insert_query = "INSERT INTO experience (date_range, position, description) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($db, $insert_query);
    mysqli_stmt_bind_param($stmt, "sss", $date_range, $position, $description);

    if(mysqli_stmt_execute($stmt)) {
        header("location: time_exap.php?action=inserted");
        exit;
    } else {
        echo '<div class="message">Error inserting new experience record.</div>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Add New Experience</title>
</head>
<body>
    <div class="container">
        <h2>Add New Experience</h2>
        <form action="" method="POST">
            <label>Date Range</label>
            <input type="text" name="date_range" class="form-control" required>
            <label>Position</label>
            <input type="text" name="position" class="form-control" required>
            <label>Description</label>
            <textarea name="description" class="form-control" required></textarea>
            <button type="submit" name="insert_submit" class="btn-primary">Insert</button>
        </form>
    </div>
</body>
</html>
