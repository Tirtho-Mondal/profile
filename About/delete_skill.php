<?php
require_once("config.php"); 
$id = $_GET['id']; 

// Fetching the necessary information from the skills table
$res = mysqli_query($db, "SELECT * FROM skills WHERE id=$id LIMIT 1");
if ($row = mysqli_fetch_array($res)) {
    $deleteimage = $row['image']; // Assuming 'image' column exists in the skills table
}

$folder = "uploads/";
unlink($folder.$deleteimage);

// Deleting the record from the skills table
$result = mysqli_query($db, "DELETE FROM skills WHERE id=$id");
if ($result) {
    header("location:skill.php?action=deleted");
}
?>
