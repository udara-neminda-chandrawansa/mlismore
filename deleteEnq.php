<?php 
    // Create a database connection
    include "conn.php";


        $enqID = $_POST["enqIDtoDelete"];

        $sql = "DELETE from `enqs` WHERE `enqID`='$enqID'";

        try {
            $result = $conn->query($sql); // execute and get results to a var
        
            // Check if the query was successful
            if ($result) {

                echo"<script>window.location.href='admin_dash.php';alert('Enquiry Deleted Successfully!');</script>";
            } else {//CONTD FROM HERE
                echo "Error: $conn->error";
            }
        } catch (Exception $e) {
            // Handle the exception here
            $errcode = $e->getMessage();
            echo "An error occurred: $errcode";
        } finally{
            $conn->close();
        }
    
?>