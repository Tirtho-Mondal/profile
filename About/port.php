<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Port Boxes</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        .container_display {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            max-width: 100px;
            height: auto;
        }
        
        button {
            padding: 5px 10px;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }

        .btn-edit {
            background-color: #007bff;
        }

        .btn-delete {
            background-color: #dc3545; /* Red color for delete button */
        }
        
        button:hover {
            filter: brightness(90%); /* Slightly reduce brightness on hover */
        }
    </style>
</head>
<body>
    <div class="container_display">
        <!-- Add navigation buttons -->
        <span style="float:right;"><a href="insert_port_box.php"><button class="btn-primary">Upload</button></a></span>
        
        <span style="float:left;"><a href="../login/home.php"><button class="btn-primary">Main Page</button></a></span>

        <table>
            <tr>
                <th>ID</th>
                <th>Class</th>
                <th>Image</th>
                <th>Link</th>
                <th>Action</th>
            </tr>
            <?php
            // Include the configuration file
            require_once("config.php");

            // Fetch data from the port_boxes table
            $res = mysqli_query($db, "SELECT * FROM port_boxes");

            // Loop through the fetched data and display it in a table
            while($row = mysqli_fetch_array($res)) {
                echo '<tr>
                     <td>'.$row['id'].'</td>
                     <td>'.$row['class'].'</td>
                     <td><img src="'.$row['image'].'" alt=""></td>
                     <td>'.$row['link'].'</td>
                     <td>
                        <a href="edit_port_box.php?id='.$row['id'].'"><button class="btn-edit">Edit</button></a>
                        <a href="delete_port_box.php?id='.$row['id'].'" onClick="return confirm(\'Are you sure you want to delete this port box?\')"><button class="btn-delete">Delete</button></a>
                     </td>
                    </tr>';
            }
            ?>
        </table>
    </div>
</body>
</html>
