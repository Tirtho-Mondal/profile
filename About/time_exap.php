<?php
require_once("config.php");

// Check if the database connection is successful
if (!$db) {
    die("Database connection error: " . mysqli_connect_error());
}

// Fetch experience data from the database
$query = "SELECT * FROM experience";
$result = mysqli_query($db, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    // Output the table headers
    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Experience Display</title>
        <style>
            /* Reset CSS */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            /* Body styles */
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
            }

            /* Container styles */
            .container_display {
                max-width: 800px;
                margin: 20px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            /* Table styles */
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

            /* Button styles */
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
                background-color: #0056b3;
            }

            .btn-primary.btn_del {
                background-color: #dc3545;
            }

            button:hover {
                filter: brightness(90%);
            }
        </style>
    </head>
    <body>
    <div class="container_display">
        <span style="float:right;"><a href="upload_exp.php"><button class="btn-primary">Upload</button></a></span>
        
        
        <span style="float:left;"><a href="../login/home.php"><button class="btn-primary">Main Page</button></a></span>

    
        <table>
            <thead>
                <tr>
                    <th>Date Range</th>
                    <th>Position</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';

    // Output each row of experience data
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
                <tr>
                    <td>' . htmlspecialchars($row['date_range']) . '</td>
                    <td>' . htmlspecialchars($row['position']) . '</td>
                    <td>' . htmlspecialchars($row['description']) . '</td>
                    <td>
                        <a href="edit_experience.php?id=' . $row['id'] . '"><button class="btn-primary">Edit</button></a>
                        <a href="delete_experience.php?id=' . $row['id'] . '" onClick="return confirm(\'Are you sure you want to delete this experience?\')"><button class="btn-primary btn_del">Delete</button></a>
                    </td>
                </tr>';
    }

    // Close the table and container
    echo '
            </tbody>
        </table>
    </div>
    </body>
    </html>';
} else {
    // If no rows are returned, display a message
    echo "No experience data found.";
}

// Close the database connection
mysqli_close($db);
?>
