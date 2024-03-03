<?php require_once("config.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Skill Display</title>
    <style>
        /* CSS styles */
    </style>
</head>
<body>
<div class="container_display">


<span style="float:right;"><a href="upload_skill.php"><button class="btn-primary">Upload</button></a></span>

        
<span style="float:left;"><a href="../login/home.php"><button class="btn-primary">Main Page</button></a></span>


    <?php
    if(isset($_GET['image_success'])) {
        echo '<div class="success">Image Uploaded successfully</div>';
    }

    if(isset($_GET['action'])) {
        $action = $_GET['action'];
        if($action == 'saved') {
            echo '<div class="success">Skill Saved Successfully</div>';
        } elseif($action == 'deleted') {
            echo '<div class="success">Skill Deleted Successfully</div>';
        }
    }
    ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php
        $res = mysqli_query($db, "SELECT * FROM skills");
        while($row = mysqli_fetch_array($res)) {
            echo '<tr>
                 <td>'.$row['name'].'</td>
                  <td>'.$row['description'].'</td>
                  <td><img src="'.$row['image'].'" alt="Skill Image"></td>
                  <td>'.$row['date'].'</td>
                  <td>
                      <a href="edit_skill.php?id='.$row['id'].'"><button class="btn-primary">Edit</button></a>
                     <a href="delete_skill.php?id='.$row['id'].'" onClick="return confirm(\'Are you sure you want to delete this skill?\')"><button class="btn-primary btn_del">Delete</button></a>
                   </td> 
                </tr>';
        }
        ?>
    </table>
</div>
</body>
</html>
