<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" href="images/portrait.png">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>Account Creation | mlismore.com</title>
</head>
<body class="phpBody">
<?php
    // vars to create connection string
    $server_name = "localhost";
    $db_uname = "root";
    $db_pass = "";
    $db_name = "mlismoredb";
    $table_name = "useraccounts";

    // connection string
    $conn = mysqli_connect($server_name,$db_uname,$db_pass,$db_name);

    // user inputs to vars
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // login method
    if(isset($_POST["username"]) && $_POST["pagename"] == "login"){

        // error handler
        if(!$conn){
            die("Connection Failed! Error Code : " . mysqli_connect_error()); // display error
        }
        else{
            //echo"Connection Success!";

            $sql = "SELECT * from $table_name where accName = '".$username."' and accPsw = '".$password."'"; // query

            $result = $conn->query($sql); // execute and get results to a var

            if($result->num_rows > 0){ // check num of rows
                while($row = $result->fetch_assoc()){
                    
                    // parse results to vars                    
                    $uid = $row["accID"];
                    //$uname = $row["accName"];
                    //$upsw = $row["accPsw"];
                    
                    if($uid == 1){
                        header('Location: admin_dash.html');
                        exit;    
                    }
                    else{
                        header('Location: cus_dash.html');
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
    //echo"<script>alert('Invalid Data !');</script>";

    // sign up method
    if(isset($_POST["username"]) && $_POST["pagename"] == "sign"){

        // error handler
        if(!$conn){
            die("Connection Failed! Error Code : " . mysqli_connect_error()); // display error
        }
        else{
            //echo"Connection Success!";

            $sql = "INSERT into $table_name(`accName`, `accPsw`) values('".$username."', '".$password."')"; // query


            try {
                $result = $conn->query($sql); // execute and get results to a var
            
                // Check if the query was successful
                if ($result) {
                    //echo "User account successfully created. <button id='goBackButton'>Go Back</button>";
                    echo"<script>window.location.href='login.html';alert('Account Creation Successfull! Now you can Login!!');</script>";
                } else {
                    echo "Error: $conn->error <button id='goBackButton'>Go Back</button>";
                }
            } catch (Exception $e) {
                // Handle the exception here
                $errcode = $e->getMessage();
                echo "An error occurred: $errcode <button id='goBackButton'>Go Back</button>";
            } finally{
                $conn->close();
            }
        }
    }
?>
</body>
</html>