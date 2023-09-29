<?php
        include "conn.php";

        //echo"Connection Success!";

        $sql = "SELECT * from galleryImages"; // query

        $result = $conn->query($sql); // execute and get results to a var

        if($result->num_rows > 0){ // check num of rows
            while($row = $result->fetch_assoc()){
                
                // parse results to vars                    
                $imgDir = $row["imgDir"];

                echo"<option value='$imgDir'>$imgDir</option>";
            }
        } 
        else{
            echo"<option>No Images</option>";
        }
        
        $conn->close();
    

//echo"<option value=''>Hi</option>";
?>