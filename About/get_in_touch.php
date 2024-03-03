<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Information</title>
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
        
        <span style="float:left;"><a href="../login/home.php"><button class="btn-primary">Main Page</button></a></span>

        <table>
            <tr>
                <th>ID</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Embedded Content</th>
    
                <th>Action</th>
            </tr>
            <?php
            require_once("config.php");
            $res = mysqli_query($db, "SELECT * FROM contact");
            while($row = mysqli_fetch_array($res)) {
                echo '<tr>
                     <td>'.$row['id'].'</td>
                     <td>'.$row['number'].'</td>
                     <td>'.$row['email'].'</td>
                     <td>'.$row['iframe'].'</td>
                     <td>
                        <a href="edit_get_touch.php?id='.$row['id'].'"><button class="btn-edit">Edit</button></a>
                     </td>
                    </tr>';
            }
            ?>
        </table>
    </div>
</body>
</html>
