<?php require_once("config.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Education Display</title>
</head>
<body>
<div class="container_display">
    <span style="float:right;"><a href="upload_edu.php"><button class="btn-primary">Upload</button></a></span>
    
        
    <span style="float:left;"><a href="../login/home.php"><button class="btn-primary">Main Page</button></a></span>


    <?php
    if(isset($_GET['action'])) {
        $action = $_GET['action'];
        if($action == 'deleted') {
            echo '<div class="success">Education Deleted Successfully</div>';
        }
    }
    ?>

    <table>
        <tr>
            <th>Date Range</th>
            <th>Institution</th>
            <th>Degree</th>
            <th>Result</th>
            <th>Action</th>
        </tr>
        <?php
        $res = mysqli_query($db, "SELECT * FROM education");
        while($row = mysqli_fetch_array($res)) {
            echo '<tr>
                 <td>'.$row['date_range'].'</td>
                  <td>'.$row['institution'].'</td>
                  <td>'.$row['degree'].'</td>
                  <td>'.$row['details'].'</td>
                  <td>
                      <a href="edit_education.php?id='.$row['id'].'"><button class="btn-primary">Edit</button></a>
                      <a href="delete_education.php?id='.$row['id'].'" onClick="return confirm(\'Are you sure you want to delete this education?\')"><button class="btn-primary btn_del">Delete</button></a>
                   </td>
                </tr>';
        }
        ?>
    </table>
</div>
</body>
</html>
