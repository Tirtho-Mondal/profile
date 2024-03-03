<?php 
require_once("config.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Project Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            width: 90%;
        }

        .container_display {
            margin: 50px auto;
            max-width: 80%;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .success {
            margin: 10px auto;
            padding: ;
            border-radius: 5px;
            background-color: #33CC00;
            color: #fff;
            font-size: 18px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .btn-primary {
            padding: 8px 16px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn_del {
            background-color: #FF5733 !important;
        }

        .btn-primary:hover, .btn_del:hover {
            transform: scale(1.05);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container_display">
    
        
<span style="float:left;"><a href="../login/home.php"><button class="btn-primary">Main Page</button></a></span>

    <?php
    if(isset($_GET['image_success'])) {
        echo '<div class="success">Image Uploaded successfully</div>';
    }

    if(isset($_GET['action'])) {
        $action = $_GET['action'];
        if($action == 'saved') {
            echo '<div class="success">Saved</div>';
        } elseif($action == 'deleted') {
            echo '<div class="success">Project Deleted Successfully ...</div>';
        }
    }
    ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>CV link</th>
            <th>Action</th>
        </tr>
        <?php
        $res = mysqli_query($db, "SELECT * FROM about where id=1");
        while($row = mysqli_fetch_array($res)) {
            echo '<tr>
                 <td>'.$row['name'].'</td>
                  <td>'.$row['description'].'</td>
                  <td><img src="'.$row['image'].'" alt="Project Image"></td>
                  <td><a href="'.$row['link'].'" target="_blank">'.$row['link'].'</a></td>
                  <td>
                      <a href="edit_about.php?id='.$row['id'].'"><button class="btn-primary">Edit</button></a>
                      <br><br>
                       </td>
                </tr>';
        }
        ?>
    </table>
</div>
</body>
</html>
