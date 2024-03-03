<?php
require_once("config.php"); 
$id = $_GET['id']; 

// Deleting the record from the message table
$result = mysqli_query($db, "DELETE FROM messages WHERE id=$id");
if ($result) {
    header("location:message.php?action=deleted");
}
?>
