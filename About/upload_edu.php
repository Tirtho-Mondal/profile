<?php 
require_once("config.php"); 

// Handle form submission for inserting new education record
if(isset($_POST['insert_submit'])) {
    $date_range = $_POST['date_range'];
    $institution = $_POST['institution'];
    $degree = $_POST['degree'];
    $details = $_POST['details'];

    // Insert new education record
    $insert_query = "INSERT INTO education (date_range, institution, degree, details) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $insert_query);
    mysqli_stmt_bind_param($stmt, "ssss", $date_range, $institution, $degree, $details);

    if(mysqli_stmt_execute($stmt)) {
        header("location: time_edu.php?action=inserted");
        exit;
    } else {
        echo '<div class="message">Error inserting new education record.</div>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Add Education</title>
</head>
<body>
    <div class="container">
        <h2>Add Education</h2>
        <form action="" method="POST">
            <label>Date Range</label>
            <input type="text" name="date_range" class="form-control" required>
            <label>Institution</label>
            <input type="text" name="institution" class="form-control" required>
            <label>Degree</label>
            <input type="text" name="degree" class="form-control" required>
            <label>Result</label>
            <textarea name="details" class="form-control" required></textarea>
            <button type="submit" name="insert_submit" class="btn-primary">Insert</button>
        </form>
    </div>
</body>
</html>
