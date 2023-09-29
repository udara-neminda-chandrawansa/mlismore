<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" href="images/portrait.png">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>Image Upload Status | mlismore.com</title>
</head>
<body class="phpBody">
    <?php    
        $uploadDir = 'photos/'; // Directory to save the uploaded images
        $fname = basename($_FILES['imgSelecter']['name']); // filename
        $uploadFile = $uploadDir . $fname;
        $imgType = $_POST["imgType"];

        // image record insert method
        if($fname != ""){

            // error handler 4 inserting data to galleryImages table
            include "conn.php";
            //echo"Connection Success!";
    
                $sql = "INSERT INTO `galleryimages`(`imgDir`, `imgType`) VALUES ('$uploadFile','$imgType')";
        
                try {
                    $result = $conn->query($sql); // execute and get results to a var
                
                    // Check if the query was successful
                    if ($result) {
                        //echo "User account successfully created. <button id='goBackButton'>Go Back</button>";
                        echo"<script>alert('Image Record Submit Successfull!');</script>";
                    } else {
                        echo "Error in Record Submission : $conn->error <button id='goBackButton' class='dash_btn'>Go Back</button>";
                    }
                } catch (Exception $e) {
                    // Handle the exception here
                    $errcode = $e->getMessage();
                    echo "An error occurred in Record Submission : $errcode <button id='goBackButton' class='dash_btn'>Go Back</button>";
                } finally{
                    $conn->close();
                }
            }
        

        if (move_uploaded_file($_FILES['imgSelecter']['tmp_name'], $uploadFile)) {
            echo "
            <div id='successContent'>
                $fname is valid, and was successfully uploaded as a $imgType image
                <img src = 'images/success.png'>
                <button id='goBackButton' class='dash_btn'>Go Back</button>
            </div>";
        } 
        else {
            echo "Image Upload failed.<button id='goBackButton' class='dash_btn'>Go Back</button>";
        }
    ?>
    </body>
</html>
