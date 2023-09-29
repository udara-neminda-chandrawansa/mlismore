<?php
// profileUp method
if (isset($_FILES["profPic"]) && $_FILES["profPic"]["error"] == UPLOAD_ERR_OK) {
    // File upload was successful, proceed with processing
    $txtName = $_POST["txtName"];
    $txtPass = $_POST["txtPassword"];

    // Read the binary data from the uploaded file
    $profilePictureData = file_get_contents($_FILES["profPic"]["tmp_name"]);

    include "conn.php";
    

        // Use a prepared statement to safely insert binary data
        $sql = "UPDATE useraccounts SET accPsw = ?, accPIC = ? WHERE accName = 'udara';";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Bind parameters and execute the statement
            mysqli_stmt_bind_param($stmt, "ss", $txtPass, $profilePictureData);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                // Redirect and display a success message
                echo "<script>window.location.href='cus_dash.html';alert('User Profile Updated!');</script>";
            } else {
                // Handle SQL execution error
                echo "Error: " . mysqli_error($conn);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            // Handle prepared statement creation error
            echo "Error creating prepared statement: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
}else{
    echo"Data Retrieval Error!";
}
?>
