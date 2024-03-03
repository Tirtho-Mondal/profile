<?php
require_once("config.php"); 
$id = $_GET['id']; 

// Fetching the necessary information from the education table
$res = mysqli_query($db, "SELECT * FROM education WHERE id=$id LIMIT 1");
if ($row = mysqli_fetch_array($res)) {
    // No need to fetch any specific column for deletion, as we are deleting the entire record
}

// Deleting the record from the education table
$result = mysqli_query($db, "DELETE FROM education WHERE id=$id");
if ($result) {
    header("location:time_edu.php?action=deleted");
} else {
    echo '<div class="message">Error deleting education record.</div>';
}
?>
