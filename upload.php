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

        if (move_uploaded_file($_FILES['imgSelecter']['tmp_name'], $uploadFile)) {
            echo "
            <div id='successContent'>
                $fname is valid, and was successfully uploaded.
                <img src = 'images/success.png'>
                <button id='goBackButton'>Go Back</button>
            </div>";
        } 
        else {
            echo "Upload failed.<button id='goBackButton'>Go Back</button>";
        }
    ?>
    </body>
</html>
