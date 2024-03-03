<?php
require_once("config.php"); 
$id = $_GET['id']; 

// Fetching the necessary information from the social_media_profiles table
$res = mysqli_query($db, "SELECT * FROM social_media_profiles WHERE id=$id LIMIT 1");
if ($row = mysqli_fetch_array($res)) {
    // Assuming 'img' column contains the image filename
    $deleteimage = $row['img']; 
}

// If 'img' column contains the image filename and it's stored in 'About' folder
$folder = "About/";
unlink($folder.$deleteimage);

// Deleting the record from the social_media_profiles table
$result = mysqli_query($db, "DELETE FROM social_media_profiles WHERE id=$id");
if ($result) {
    header("location:social.php?action=deleted");
}
?>
