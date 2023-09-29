<?php
if (isset($_GET['username'])) {
    // Now you can use $username in your code
    $username = $_GET['username'];

    // Check the connection
    include "conn.php";
    
    // SQL query to retrieve the binary image data for a specific user
    $sql = "SELECT accPIC FROM useraccounts WHERE accName = '$username';";

    // Execute the query
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch the image data
        $row = $result->fetch_assoc();
        $imageData = $row["accPIC"];
        
        // Display the image (assuming it"s a JPEG image)
        header("Content-type: image/jpeg");
        echo $imageData;
    } else {
        echo "No image found for the user.";
    }

    // Close the connection
    $conn->close();
}else{
        // Handle the case when the username parameter is not provided
        echo "Username parameter is missing.";
}
?>