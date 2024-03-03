<?php require_once("config.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Project Display</title>
</head>
<body>
<div class="container_display">
    <span style="float:right;"><a href="upload_project.php"><button class="btn-primary">Upload</button></a></span>
        
        <span style="float:left;"><a href="../login/home.php"><button class="btn-primary">Main Page</button></a></span>


    <?php
    if(isset($_GET['image_success'])) {
        echo '<div class="success">Image Uploaded successfully</div>';
    }

    if(isset($_GET['action'])) {
        $action = $_GET['action'];
        if($action == 'saved') {
            echo '<div class="success">Project Saved Successfully</div>';
        } elseif($action == 'deleted') {
            echo '<div class="success">Project Deleted Successfully</div>';
        }
    }
    ?>

    <table>
        <tr>
            <th>Title</th>
            <th>Sub Title</th>
            <th>Description</th>
            <th>Github Link</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php
        $res = mysqli_query($db, "SELECT * FROM projects");
        while($row = mysqli_fetch_array($res)) {
            echo '<tr>
                 <td>'.$row['title'].'</td>
                  <td>'.$row['sub_title'].'</td>
                  <td>'.$row['desc'].'</td>
                  <td>'.$row['github_link'].'</td>
                  <td><img src="'.$row['img_src'].'" alt="Project Image"></td>
                  <td>
                      <a href="edit_project.php?id='.$row['id'].'"><button class="btn-primary">Edit</button></a>
                      <a href="delete_project.php?id='.$row['id'].'" onClick="return confirm(\'Are you sure you want to delete this project?\')"><button class="btn-primary btn_del">Delete</button></a>
                   </td>
                </tr>';
        }
        ?>
    </table>
</div>
</body>
</html>
