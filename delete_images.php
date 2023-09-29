<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" href="images/portrait.png">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>Image Delete Status | mlismore.com</title>
</head>
<body class="phpBody">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if an image is selected for deletion
    if (isset($_POST["selectImagetoDelete"]) && !empty($_POST["selectImagetoDelete"])) {

        $selectedImage = $_POST["selectImagetoDelete"];

        // Construct the path to the selected image
        $imagePath = $selectedImage;

        // error handler 4 image record delete method
        include "conn.php";
            //echo"Connection Success!";

            $sql = "DELETE FROM `galleryimages` WHERE imgDir = '$imagePath'";

            try {
                $result = $conn->query($sql); // execute and get results to a var
            
                // Check if the query was successful
                if ($result) {
                    //echo "User account successfully created. <button id='goBackButton'>Go Back</button>";
                    echo"<script>alert('Image Record Delete Successfull!');</script>";
                } else {
                    echo "Error in Record Deletion : $conn->error <button id='goBackButton' class='dash_btn'>Go Back</button>";
                }
            } catch (Exception $e) {
                // Handle the exception here
                $errcode = $e->getMessage();
                echo "An error occurred in Record Deletion : $errcode <button id='goBackButton' class='dash_btn'>Go Back</button>";
            } finally{
                $conn->close();
            }
        }

        // Check if the selected image file exists
        if (file_exists($imagePath)) {
            // Attempt to delete the image file
            if (unlink($imagePath)) {
                echo "
                Image '$selectedImage' has been successfully deleted.
                <img src = 'images/success.png'>
                <button id='goBackButton' class='dash_btn'>Go Back</button>";
            } else {
                echo "Failed to delete the image.<button id='goBackButton' class='dash_btn'>Go Back</button>";
            }
        } else {
            echo "The selected image : $selectedImage does not exist.<button id='goBackButton' class='dash_btn'>Go Back</button>";
        }
    } else {
        echo "Please select an image to delete.<button id='goBackButton' class='dash_btn'>Go Back</button>";
    }
?>
</body>
</html>