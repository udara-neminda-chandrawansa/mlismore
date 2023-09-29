<?php     
    $imgType = $_POST["imgType"];

    include "conn.php";
        //echo"Connection Success!";

        $sql = "SELECT * FROM `galleryimages` WHERE imgType = '$imgType';"; // query

        $result = $conn->query($sql); // execute and get results to a var

        if($result->num_rows > 0){ // check num of rows
            while($row = $result->fetch_assoc()){
                
                // parse results to vars                    
                $imgDir = $row["imgDir"];

                echo"<img src='$imgDir' alt='img' class='gallery-images'>";//<img src="" alt="" class="gallery-images">
            }
        } 
        else{
            echo"No Images";
        }
        
        $conn->close();
        
?>