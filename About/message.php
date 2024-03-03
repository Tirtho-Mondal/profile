<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Messages</title>
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
        
        
    <span style="float:left;"><a href="../login/home.php"><button class="btn-primary">Main Page</button></a></span>


        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Created At</th>
                <th></th>
            </tr>
            <?php
            require_once("config.php");
            
            // Retrieve messages from the database
            $query = "SELECT * FROM messages";
            $result = mysqli_query($db, $query);

            // Check if there are any messages
            if (mysqli_num_rows($result) > 0) {
                // Output each message as a table row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                            <td>'.$row['id'].'</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>'.$row['subject'].'</td>
                            <td>'.$row['message'].'</td>
                            <td>'.$row['created_at'].'</td>
                            <td>
                                <a href="delete_message.php?id='.$row['id'].'" onClick="return confirm(\'Are you sure you want to delete this skill?\')"><button class="btn-primary btn_del">Delete</button></a>
                            </td> 
                        </tr>';
                }
            } else {
                // If there are no messages, display a message in a single table row
                echo '<tr><td colspan="6">No messages found</td></tr>';
            }
            ?>
        </table>
    </div>
</body>
</html>
