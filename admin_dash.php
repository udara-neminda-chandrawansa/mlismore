<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="website icon" href="images/portrait.png">
    <script src="script.js"></script>
    <title>Photography at its finest | mlismore.com</title>
</head>
<body class="dark-bg">
    <!--nav section-->
    <section id="nav-section" class="dark-bg">
        <nav>
            <div id="logo">
                <img src="images/logo.png" alt="logo" onclick="navToggler('')">
            </div>
            <ul id="nav">
                <li onclick="location.href = 'index.php';">Home</li>
                <li>Services
                    <i class="fa fa-caret-down"></i>
                    <div class="subnav">
                            <ul>
                                <li onclick="window.location.href='services.html';">Weddings</li>
                                <li onclick="window.location.href='services.html#portraits';">Portraits</li>
                                <li onclick="window.location.href='services.html#events';">Social Events</li>
                            </ul>
                        </div>
                </li>
                <li>Gallery
                    <i class="fa fa-caret-down"></i>
                    <div class="subnav">
                        <ul>
                            <li onclick="window.location.href = 'gallery.html';">Landscape</li>
                            <li onclick="window.location.href = 'gallery.html#wildlife-section';">Wildlife</li>
                            <li onclick="window.location.href = 'gallery.html#birds-section';">Coastal Birds</li>
                        </ul>
                    </div>
                </li>
                <li onclick="window.location.href='login.html'">Sign In</li>
            </ul>
        </nav>
    </section>
    <!--content section-->
    <section id="content-section">
        <!--Control Panel Section-->
        <section id="control-section" class="dark-bg">
            <div id="control-panel">
                <div class="control-button" onclick="browseMain('1')">
                    <img src="images/add_en.png" alt="img">
                    Upload New Images
                </div>
                <div class="control-button" onclick="browseMain('2')">
                    <img src="images/edit_en.png" alt="img">
                    Edit existing Images
                </div>
                <div class="control-button" onclick="browseMain('3')">
                    <img src="images/view_en.png" alt="img">
                    View Recieved Enquiries
                </div>
                <div class="control-button" onclick="browseMain('4')">
                    <img src="images/edit_en.png" alt="img">
                    Edit User Profile
                </div>
            </div>
        </section>
        <!--Main Panel-->
        <section class="dark-bg" id="task-pane">
            <div class="main admin-main" id="main1">
                <h1>Drop your Image here</h1>
                <!--Image Uploader Form-->
                <form class="admin-form" enctype="multipart/form-data" action="upload.php" method="POST">
                    <input type="file" name="imgSelecter" id="imgSelecter">
                    <!--Grand Parent Span-->
                    <span style="width: 100%;display: flex;flex-direction: row;align-items:center;justify-content:center;gap:1em;">
                        <!--Parent Span-->
                        <span>
                            <!--Child Span-->
                            <span style="display: flex;justify-content: center;">
                                <label for="rdLandscape" style="display: flex;min-width: 150px;">Landscape</label>
                                <input type="radio" name="imgType" id="rdLandscape" value="Landscape" checked>
                            </span>
                            <!--Child Span-->
                            <span style="display: flex;justify-content: center;">
                                <label for="rdWildlife" style="display: flex;min-width: 150px;">Wildlife</label>
                                <input type="radio" name="imgType" id="rdWildlife" value="Wildlife">    
                            </span>
                            <!--Child Span-->
                            <span style="display: flex;justify-content: center;">
                                <label for="rdBird" style="display: flex;min-width: 150px;">Coastal Birds</label>
                                <input type="radio" name="imgType" id="rdBird" value="Coastal Bird">
                            </span>
                        </span>
                        <input type="submit" value="Upload" id="uploadBtn" class="dash_btn" onclick="return verifyImageUploader()">
                    </span>
                </form>
                <!--Image Display-->
                <img src="" alt="Selected Image will be displayed here" id="selectedImage">
            </div>
            <div class="main admin-main" id="main2">
                <h1>Remove Images from Gallery</h1>
                <!--Image Deletion Form-->
                <form class="admin-form" enctype="multipart/form-data"  action="delete_images.php" method="post">
                    <select name="selectImagetoDelete" id="selectImagetoDelete" class="userSelect" size="10"></select> <!--Select which holds options that are echoed by view_im.php-->
                    <script src="display_image_names.js"></script><!--ajax for connectivity of above php-->
                    <input id="deletebtn" type="submit" value="Delete" class="dash_btn" onclick="return verifyImageDeleter()">
                </form>
            </div>
            <div class="main admin-main" id="main3">
                <h1>All Enquiries</h1>
                <!--Enquiry Viewer-->                
                <div id="table-container" style="max-height: 90%;max-width: 100%;overflow-y: scroll;">
                    <?php
                        // Create a database connection
                        include "conn.php";
                        
                        // Fetch data from a database table
                        $sql = "SELECT e.enqID, u.accName,  e.cusTel, e.cusJob, e.jobDate, e.jobTime, e.cusLoc, e.cusMail, e.enStatus FROM enqs e INNER JOIN useraccounts u ON e.accID = u.accID ORDER BY e.enqID ASC;";
                        $result = $conn->query($sql);

                        // Check if there are any rows
                        if ($result->num_rows > 0) {
                            echo "<table border='1px'>";
                            echo "<tr>
                                    <th>Enquiry ID</th>
                                    <th>Customer Name</th>
                                    <th>Customer Tel No</th>
                                    <th>Required Service</th>
                                    <th>Customer Email</th>
                                    <th>Job Date</th>
                                    <th>Job Time</th>
                                    <th>Job Location</th>
                                    <th>Status</th>
                                    <th colspan='2'>Actions</th>
                                    </tr>";
                            
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                // parse data to var
                                $cusLoc = $row["cusLoc"];
                                $cusMail = $row["cusMail"]; //<a href = "mailto: abc@example.com">Send Email</a>
                                $cusTel = $row["cusTel"];// <a href="tel:9051290512">Call 9051290512</a>
                                $jobDate = $row["jobDate"];// 
                                $jobTime = $row["jobTime"];//
                                $enqID = $row["enqID"];// for accepting and deleting btns

                                // condition to get status
                                $status;
                                if($row["enStatus"]==0){
                                    $status = "images/unaccepted.png";
                                }
                                else{
                                    $status = "images/accepted.png";
                                }

                                echo "<tr>";
                                echo "<td>" . $enqID . "</td>";
                                echo "<td>" . $row["accName"] . "</td>";
                                echo "<td><a href='tel:$cusTel'> Call $cusTel </a></td>";
                                echo "<td>" . $row["cusJob"] . "</td>";
                                echo "<td><a href = 'mailto:$cusMail'> $cusMail </a></td>";
                                echo "<td>" . $jobDate . "</td>";
                                echo "<td>" . $jobTime . "</td>";
                                if($cusLoc!=""){
                                    echo "<td><a href = '$cusLoc'>Link Address</a></td>";
                                }
                                else{
                                    echo "<td>No Location</td>";
                                }
                                echo "<td><img src='$status' class='statusImg'></td>";
                                echo "<td>
                                        <form action='acceptEnq.php' method='post'>
                                            <input type='hidden' name='enqIDtoAccept' value='$enqID'>
                                            <button class='enqBtn' onclick='return verifyAcceptEnq()'>Accept</button>
                                        </form>
                                        </td>";
                                echo "<td>
                                        <form action='deleteEnq.php' method='post'>
                                            <input type='hidden' name='enqIDtoDelete' value='$enqID'>
                                            <button class='enqBtn' onclick='return verifyDeleteEnq()'>Delete</button>
                                        </form>
                                        </td>";
                                echo "</tr>";
                            }                            
                            echo "</table>";
                        } else {
                            echo "No data available.";
                        }

                        // Close the database connection
                        $conn->close();
                    ?>
                    <a href="view_messages.php">See Messages</a>
                </div>
            </div>
            <div class="main admin-main" id="main4">
                <form action="dbcon.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="pagename" value="profileUpAdmin">
                    <div class="userFormDiv">
                        <h2>Edit User Profile</h2>
                        <p>New Username</p>
                        <input type="text" name="txtUsername" id="txtUsername" placeholder="Enter New Username">
                        <p>New Password</p>
                        <input type="text" name="txtPassword" id="txtPassword" placeholder="Enter New Password">
                        <p>Profile Picture</p>
                        <input type="file" name="profPic" id="profPic" style="height: 25%;">
                        <button onclick="return verifyUserProfile()">Submit</button>
                    </div>    
                </form>
            </div>
        </section>
    </section>
    <!--Footer-->
    <section id="footer-section">
        <footer class="dark-bg foot">
            <div class="foot-links">
                <ul>
                    <li onclick="window.location.href='about.html'">About Me</li>
                    <li onclick="window.location.href='testimonials.php'">Testimonials</li>
                    <li onclick="window.location.href='gallery.html'">Gallery</li>
                    <li onclick="window.location.href='contacts.html'">Contact Us</li>
                </ul>
            </div>
            <div class="social">
                <ul>
                    <li>follow us on social media</li>
                    <li onclick="window.location.href='https://www.facebook.com/'"><img src="images/fb.png" alt="fb"></li>
                    <li onclick="window.location.href='https://www.instagram.com/'"><img src="images/insta.png" alt="insta"></li>
                    <li onclick="window.location.href='https://www.linkedin.com/'"><img src="images/lkdin.png" alt="lkdin"></li>
                </ul>
            </div>
        </footer>
    </section>

    <script>
        function verifyAcceptEnq(){
            return confirm("Do you want to proceed with accepting this record?");
        }
        function verifyDeleteEnq(){
            return confirm("Do you want to proceed with deleting this record?");
        }
        function verifyImageUploader(){
            const imgSelecter = document.getElementById('imgSelecter');
            if(imgSelecter.value==""){
                alert("Please select an Image before pressing the Upload button!");
                return false;
            }else{
                return confirm("Are you sure to Upload this Image?");
            }
        }
        function verifyImageDeleter(){
            const selectImagetoDelete = document.getElementById('selectImagetoDelete');
            if(selectImagetoDelete.value==""){
                alert("Please select an Image before pressing the Delete button!");
                return false;
            }else{
                return confirm("Are you sure to Delete this Image?");
            }
        }
    </script>
</body>
</html>