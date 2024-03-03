<?php
require_once("config.php");

// Check if the 'id' parameter is set in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Deleting the record from the experience table
    $delete_query = "DELETE FROM experience WHERE id=?";
    $stmt = mysqli_prepare($db, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    // Check if the deletion was successful
    if(mysqli_stmt_affected_rows($stmt) > 0) {
        header("location:time_exap.php?action=deleted");
        exit;
    } else {
        echo '<div class="message">Error deleting experience record.</div>';
    }
} else {
    echo '<div class="message">No record ID specified for deletion.</div>';
}
?>
