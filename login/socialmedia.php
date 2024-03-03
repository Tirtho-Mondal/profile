<?php
// Define database connection parameters

require_once("config.php");

// Assuming 'action' parameter is not relevant for experience table, so no need to check for it


// Fetch data from the database
$sql = "SELECT * FROM social_media_profiles";
$result = mysqli_query($db, $sql);

// Check if there are any rows in the result
if (mysqli_num_rows($result) > 0) {
    // Start generating the table
    echo "<table>";

    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        // Output data from each row
        echo "<td>" . $row['platform'] . "</td>";
        echo "<td><img src='" . $row['img'] . "' alt='" . $row['alt'] . "' class='icon' onclick=\"window.open('" . $row['link'] . "')\" /></td>";
        echo "</tr>";
    }

    // End the table
    echo "</table>";
} else {
    echo "0 results";
}

// Close the database connection

?>
