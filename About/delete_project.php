<?php
require_once("config.php"); 
$id = $_GET['id']; 

// Fetching the necessary information from the projects table
$res = mysqli_query($db, "SELECT * FROM projects WHERE id=$id LIMIT 1");
if ($row = mysqli_fetch_array($res)) {
    $deleteimage = $row['img_src']; // Assuming 'img_src' column exists in the projects table
}

$folder = "uploads/";
unlink($folder.$deleteimage);

// Deleting the record from the projects table
$result = mysqli_query($db, "DELETE FROM projects WHERE id=$id");
if ($result) {
    header("location:project.php?action=deleted");
}
?>
