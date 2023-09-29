<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" href="images/portrait.png">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>User Handling | mlismore.com</title>
</head>
<body class="phpBody">
<?php
    // conn1 was here

    // function delegator
    if (isset($_POST['pagename'])) {
        $pagename = $_POST['pagename'];
    
        if ($pagename === 'login') {
            // Call the function
            login(); 
        } elseif ($pagename === 'sign') {
            // Call the function
            sign();
        } elseif ($pagename === 'testimonial') {
            // Call the function
            testi();
        } elseif ($pagename === 'profileUp') {
            // Call the function
            updateProfile();
        } elseif ($pagename === 'profileUpAdmin') {
            // Call the function
            updateAdminProfile();
        } elseif ($pagename === 'addEnq') {
            // Call the function
            createEnq();
        } elseif ($pagename === 'editEn') {
            // Call the function
            editEnq();
        } elseif ($pagename === 'contacts') {
            // Call the function
            sendMessage();
        }
    // Handle other actions if needed
    }

    // login method
    function login(){
        if(isset($_POST["username"])){

            // user inputs to vars
            $username = $_POST["username"];
            $password = $_POST["password"];

            include "conn.php";
            //echo"Connection Success!";

            $sql = "SELECT * from $table_name where accName = '".$username."' and accPsw = '".$password."'"; // query

            $result = $conn->query($sql); // execute and get results to a var

            if($result->num_rows > 0){ // check num of rows
                while($row = $result->fetch_assoc()){
                    
                    // parse results to vars                    
                    $uid = $row["accID"];
                    $uname = $row["accName"];
                    //$upsw = $row["accPsw"];
                    
                    if($uid == 1){
                        // Construct the URL with query parameters
                        $redirectUrl = 'admin_dash.php?uname=' . urlencode($uname);

                        header('Location: ' . $redirectUrl);
                        exit;    
                    }
                    else{
                        // Construct the URL with query parameters
                        $redirectUrl = 'cus_dash.php?uname=' . urlencode($uname);

                        header('Location: ' . $redirectUrl);
                        exit;
                    }
                }
            } 
            else{
                //header('Location: login.html');
                echo"<script>window.location.href='login.html';alert('Invalid Account Creadentials!');</script>";
            }
            
            $conn->close();
        }
    }
    
    // sign up method
    function sign(){
        if(isset($_POST["username"])){
            
            // user inputs to vars
            $username = $_POST["username"];
            $password = $_POST["password"];

            include "conn.php";
            //echo"Connection Success!";

                $sql = "INSERT into $table_name(`accName`, `accPsw`) values('".$username."', '".$password."')"; // query


                try {
                    $result = $conn->query($sql); // execute and get results to a var
                
                    // Check if the query was successful
                    if ($result) {
                        //echo "User account successfully created. <button id='goBackButton'>Go Back</button>";
                        echo"<script>window.location.href='login.html';alert('Account Creation Successfull! Now you can Login!!');</script>";
                    } else {
                        echo "Error: $conn->error <button id='goBackButton' class='dash_btn'>Go Back</button>";
                    }
                } catch (Exception $e) {
                    // Handle the exception here
                    $errcode = $e->getMessage();
                    echo "An error occurred: $errcode <button id='goBackButton' class='dash_btn'>Go Back</button>";
                } finally{
                    $conn->close();
                }
            
        }
    }

    // testimonial submit method
    function testi(){
        if(isset($_POST["txtName"]) && isset($_POST["txtTestimonial"])){

            // find accID according to accName[txtName]
            $txtName = $_POST["txtName"];
            $txtTest = $_POST["txtTestimonial"];

            include "conn.php";
            //echo"Connection Success!";

                $sql = "INSERT INTO testimonials (accID, testDesc) SELECT ua.accID, '$txtTest' FROM useraccounts ua WHERE ua.accName = '$txtName';";

                // $sql = "INSERT INTO `testimonials`(`accID`, `testDesc`) VALUES ('".$uid."', '".$txtTest."')"; // query

                try {
                    $result = $conn->query($sql); // execute and get results to a var
                
                    // Check if the query was successful
                    if ($result) {
                        // Construct the URL with query parameters
                        $redirectUrl = 'cus_dash.php?uname=' . urlencode($txtName);

                        echo"<script>window.location.href='$redirectUrl';alert('Testimonial Submit Successfull!');</script>";
                    } else {
                        echo "Error: $conn->error <button id='goBackButton' class='dash_btn'>Go Back</button>";
                    }
                } catch (Exception $e) {
                    // Handle the exception here
                    $errcode = $e->getMessage();
                    echo "An error occurred: $errcode <button id='goBackButton' class='dash_btn'>Go Back</button>";
                } finally{
                    $conn->close();
                }
        }
    }
    
    //profileUp method
    function updateProfile(){
        if(isset($_POST["txtName"]) && isset($_FILES["profPic"]) && $_FILES["profPic"]["error"] == UPLOAD_ERR_OK){
            // File upload was successful, proceed with processing
            $txtName = $_POST["txtName"];
            $txtPass = $_POST["txtPassword"];
            $txtUsername = $_POST["txtUsername"];

            // Read the binary data from the uploaded file
            $profilePictureData = file_get_contents($_FILES["profPic"]["tmp_name"]);

            include "conn.php";
            echo "Connection Success!"; // Uncomment for debugging

                // Use a prepared statement to safely insert binary data
                $sql = "UPDATE useraccounts SET accName = ?, accPsw = ?, accPIC = ? WHERE accName = '$txtName';";
                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {
                    // Bind parameters and execute the statement
                    mysqli_stmt_bind_param($stmt, "sss", $txtUsername, $txtPass, $profilePictureData);
                    $result = mysqli_stmt_execute($stmt);

                    if ($result) {
                        // Construct the URL with query parameters
                        $redirectUrl = 'cus_dash.php?uname=' . urlencode($txtUsername);

                        echo"<script>window.location.href='$redirectUrl';alert('Profile Updated Successfull!');</script>";
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
        }
    }

    // profileUp method 4 admin
    function updateAdminProfile(){
        if(isset($_FILES["profPic"]) && $_FILES["profPic"]["error"] == UPLOAD_ERR_OK){
            // File upload was successful, proceed with processing
            $txtUsername = $_POST["txtUsername"];
            $txtPass = $_POST["txtPassword"];

            // Read the binary data from the uploaded file
            $profilePictureData = file_get_contents($_FILES["profPic"]["tmp_name"]);

            include "conn.php";
            echo "Connection Success!"; // Uncomment for debugging

                // Use a prepared statement to safely insert binary data
                $sql = "UPDATE useraccounts SET accName = ?, accPsw = ?, accPIC = ? WHERE accID = '1';";
                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {
                    // Bind parameters and execute the statement
                    mysqli_stmt_bind_param($stmt, "sss",$txtUsername, $txtPass, $profilePictureData);
                    $result = mysqli_stmt_execute($stmt);

                    if ($result) {
                        // 
                        echo"<script>window.location.href='admin_dash.php';alert('Profile Updated Successfull!');</script>";
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
        }
    }

    // Enquiry creation method
    function createEnq(){
        if(isset($_POST["txtName"]) && isset($_POST["txtTel"])){

            // vars
            $txtName = $_POST["txtName"];
            $txtTelNo = $_POST["txtTel"];
            $jobType = $_POST["jtype"];
            $jobDate = $_POST["txtDate"];
            $jobTime = $_POST["txtTime"];
            $txtMail = $_POST["txtMail"];
            $txtLocation = $_POST["txtLoc"];

            // error handler 4 inserting data to testimonials table
            include "conn.php";
            //echo"Connection Success!";

                $sql = "INSERT INTO `enqs`(`accID`, `cusTel`, `cusJob`, `jobDate`, `jobTime`, `cusMail`, `cusLoc`) SELECT ua.accID, '$txtTelNo','$jobType','$jobDate','$jobTime','$txtMail','$txtLocation' FROM useraccounts ua WHERE ua.accName = '$txtName';";

                try {
                    $result = $conn->query($sql); // execute and get results to a var
                
                    // Check if the query was successful
                    if ($result) {
                        // Construct the URL with query parameters
                        $redirectUrl = 'cus_dash.php?uname=' . urlencode($txtName);

                        echo"<script>window.location.href='$redirectUrl';alert('Enquiry Created Successfull!');</script>";
                    } else {
                        echo "Error: $conn->error <button id='goBackButton' class='dash_btn'>Go Back</button>";
                    }
                } catch (Exception $e) {
                    // Handle the exception here
                    $errcode = $e->getMessage();
                    echo "An error occurred: $errcode <button id='goBackButton' class='dash_btn'>Go Back</button>";
                } finally{
                    $conn->close();
                }
        }
    }

    // Enquiry update method
    function editEnq(){
        if(isset($_POST["txtName"]) && isset($_POST["txtTel2"])){

            // vars
            $txtName = $_POST["txtName"];
            $enqID = $_POST["selEN"];
            $txtTelNo = $_POST["txtTel2"];
            $jobType = $_POST["jtype2"];
            $jobDate = $_POST["txtDate2"];
            $jobTime = $_POST["txtTime2"];
            $txtMail = $_POST["txtMail2"];
            $txtLocation = $_POST["txtLoc2"];

            // error handler 4 inserting data to testimonials table
            include "conn.php";
            //echo"Connection Success!";

                $sql = "UPDATE `enqs` SET `cusTel`='$txtTelNo',`cusJob`='$jobType',`jobDate`='$jobDate',`jobTime`='$jobTime',`cusMail`='$txtMail',`cusLoc`='$txtLocation',`enStatus`='0' WHERE `enqID`='$enqID'";

                try {
                    $result = $conn->query($sql); // execute and get results to a var
                
                    // Check if the query was successful
                    if ($result) {
                        // Construct the URL with query parameters
                        $redirectUrl = 'cus_dash.php?uname=' . urlencode($txtName);

                        echo"<script>window.location.href='$redirectUrl';alert('Enquiry Updated Successfull!');</script>";
                    } else {
                        echo "Error: $conn->error <button id='goBackButton' class='dash_btn'>Go Back</button>";
                    }
                } catch (Exception $e) {
                    // Handle the exception here
                    $errcode = $e->getMessage();
                    echo "An error occurred: $errcode <button id='goBackButton' class='dash_btn'>Go Back</button>";
                } finally{
                    $conn->close();
                }
        }
    }

    // Contact us page
    function sendMessage(){
        if(isset($_POST["email"])){

            $email = $_POST["email"];
            $message = $_POST["message"];

            // error handler 4 inserting data to contacts table
            include "conn.php";
            //echo"Connection Success!";

                $sql = "INSERT INTO `contacts`(`cEmail`, `cMessage`) VALUES ('$email','$message')";

                try {
                    $result = $conn->query($sql); // execute and get results to a var
                
                    // Check if the query was successful
                    if ($result) {
                        echo"<script>window.location.href='contacts.html';alert('Your message was recorded Successfully!');</script>";
                    } else {
                        echo "Error: $conn->error <button id='goBackButton' class='dash_btn'>Go Back</button>";
                    }
                } catch (Exception $e) {
                    // Handle the exception here
                    $errcode = $e->getMessage();
                    echo "An error occurred: $errcode <button id='goBackButton' class='dash_btn'>Go Back</button>";
                } finally{
                    $conn->close();
                }
        }
    }
?>
</body>
</html>