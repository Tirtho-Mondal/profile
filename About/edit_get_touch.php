<?php 
require_once("config.php"); 

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the contact record to be edited
    $result = mysqli_query($db, "SELECT * FROM contact WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    // Handle form submission for editing
    if(isset($_POST['update_submit'])) {
        $number = $_POST['number'];
        $email = $_POST['email'];
        $iframe = $_POST['iframe'];

        // Update the contact record
        $update_query = "UPDATE contact SET number=?, email=?, iframe=? WHERE id=?";
        $stmt = mysqli_prepare($db, $update_query);
        mysqli_stmt_bind_param($stmt, "sssi", $number, $email, $iframe, $id);

        if(mysqli_stmt_execute($stmt)) {
            header("location: get_in_touch.php?action=updated");
            exit;
        } else {
            echo '<div class="message">Error updating contact record.</div>';
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
    <title>Edit Contact Information</title>
</head>
<body>
    <div class="container">
        <h2>Edit Contact Information</h2>
        <form action="" method="POST">
            <label>Phone Number</label>
            <input type="text" name="number" class="form-control" value="<?php echo $row['number']; ?>" required>
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
            <label>Embedded Content (Iframe)</label>
            <textarea name="iframe" class="form-control" required><?php echo $row['iframe']; ?></textarea>
            <button type="submit" name="update_submit" class="btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
