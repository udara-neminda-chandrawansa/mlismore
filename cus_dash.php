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
<?php 
    $uname = $_GET['uname'];
    $enqID = "";
?>
<body class="dark-bg">
    <!--nav section-->
    <section id="nav-section" class="dark-bg">
        <nav>
            <div id="logo">
                <img src="images/logo.png" alt="logo" onclick="navToggler('')">
            </div>
            <ul class="nav-ul" id="nav">
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
    <!--control section-->
    <section id="content-section">
        <section id="control-section" class="dark-bg">
            <div id="control-panel">
                <div class="control-button" onclick="browseMain('1')">
                    <img src="images/add_en.png" alt="img">
                    Create a new Enquiry
                </div>
                <div class="control-button" onclick="browseMain('2')">
                    <img src="images/edit_en.png" alt="img">
                    Edit existing Enquiries
                </div>
                <div class="control-button" onclick="browseMain('3')">
                    <img src="images/add_en.png" alt="img">
                    Submit a Testimonial
                </div>
                <div class="control-button" onclick="browseMain('4')">
                    <img src="images/edit_en.png" alt="img">
                    Edit User Profile
                </div>
            </div>
        </section>
        <section class="dark-bg" id="task-pane">
            <div class="main" id="main1"><!--Enq Creation-->
                <form action="dbcon.php" method="post">
                    <input type="hidden" name="pagename" value="addEnq">
                    <div class="userFormDiv">
                        <h2>Create Enquiry</h2>
                        <?php
                        echo"<input type='hidden' name='txtName' id='txtName' value='$uname'>";
                        ?>
                        <p>Contact No</p>
                        <input type="text" name="txtTel" id="txtTel" placeholder="Contact Number">
                        <span class="spFlex">
                            <p>Type of Job</p>
                            <p>Date & Time</p>
                        </span>
                        <span class="spFlex">
                            <span class="jobTypeSelecter">
                                <span class="spJob">
                                    <input type="radio" name="jtype" id="rdWedding" class="rdJob" value="Wedding" checked>
                                    <label for="rdWedding" class="lblJob">Wedding</label>
                                </span>
                                <span class="spJob">
                                    <input type="radio" name="jtype" id="rdPortrait" class="rdJob" value="Portrait">
                                    <label for="rdPortrait" class="lblJob">Portrait</label>
                                </span>
                                <span class="spJob">
                                    <input type="radio" name="jtype" id="rdEvent" class="rdJob" value="Event">
                                    <label for="rdEvent" class="lblJob">Event</label>
                                </span>
                            </span>
                            <span class="spDateTime">
                                <input type="date" name="txtDate" id="txtDate">
                                <input type="text" name="txtTime" id="txtTime" placeholder="Start Time - End Time">
                            </span>
                        </span>
                        <p>Email</p>
                        <input type="email" name="txtMail" id="txtMail" placeholder="Customer Email Address">
                        <p>Location [URL]</p>
                        <input type="url" name="txtLoc" id="txtLoc" placeholder="URL of Google Maps Location (Applicable for Weddings/Events)">
                        <button onclick="return verifyEnqCreationFrm()">Submit</button>
                    </div>
                </form>
            </div>
            <div class="main" id="main2"><!--Enq Edit-->
                <form action="dbcon.php" method="post">
                    <input type="hidden" name="pagename" value="editEn">
                    <div class="userFormDiv">
                        <h2>Edit Enquiry</h2>                        
                        <?php
                        echo"<input type='hidden' name='txtName' id='txtName' value='$uname'>";
                        ?>
                        <div class="Select-Container">
                            <select name="selEN" id="selEN" class="userSelect" style="border-radius: 5px;width:355px;">
                                <option value="0">-- Select Enquiry to Update --</option>
                                <?php
                                    // vars to create connection string
                                    include "conn.php";
                                        //echo"Connection Success!";

                                        $sql = "SELECT * from enqs join useraccounts on enqs.accID = useraccounts.accID where accName='$uname'"; // query

                                        $result = $conn->query($sql); // execute and get results to a var

                                        if($result->num_rows > 0){ // check num of rows
                                            while($row = $result->fetch_assoc()){
                                                
                                                // parse results to vars
                                                $enqID = $row["enqID"];
                                                $cusJob = $row["cusJob"];
                                                $enStatus = $row["enStatus"];
                                                $enStatusText;
                                                if($enStatus == 1){
                                                    $enStatusText = "Accepted";
                                                }else{$enStatusText = "Not Accepted";}

                                                echo"<option value='$enqID'>$cusJob ($enStatusText)</option>";
                                            }
                                        } 
                                        else{
                                            echo"<option>No Enquiries</option>";
                                        }
                                        $conn->close();
                                    
                                ?>
                            </select>
                            <div class="tooltip"></div>
                        </div>
                        <?php
                            echo"<input type='hidden' name='enqID' id='enqID' value='$enqID'>";
                        ?>
                        <!--Label-->
                        <p>Contact No</p>
                        <!--Input-->
                        <input type="text" name="txtTel2" id="txtTel2" placeholder="Contact Number">
                        <!--Label-->
                        <span class="spFlex">
                            <p>Type of Job</p>
                            <p>Date & Time</p>
                        </span>
                        <!--Input-->
                        <span class="spFlex">
                            <span class="jobTypeSelecter">
                                <span class="spJob">
                                    <input type="radio" name="jtype2" id="rdWedding2" class="rdJob" value="Wedding" checked>
                                    <label for="rdWedding2" class="lblJob">Wedding</label>
                                </span>
                                <span class="spJob">
                                    <input type="radio" name="jtype2" id="rdPortrait2" class="rdJob" value="Portrait">
                                    <label for="rdPortrait2" class="lblJob">Portrait</label>
                                </span>
                                <span class="spJob">
                                    <input type="radio" name="jtype2" id="rdEvent2" class="rdJob" value="Event">
                                    <label for="rdEvent2" class="lblJob">Event</label>
                                </span>
                            </span>
                            <span class="spDateTime">
                                <input type="date" name="txtDate2" id="txtDate2">
                                <input type="text" name="txtTime2" id="txtTime2" placeholder="Start Time - End Time">
                            </span>
                        </span>
                        <!--Label-->
                        <p>Email</p>
                        <!--Input-->
                        <input type="text" name="txtMail2" id="txtMail2" placeholder="Customer Email Address">
                        <!--Label-->
                        <p>Location [URL]</p>
                        <!--Input-->
                        <input type="text" name="txtLoc2" id="txtLoc2" placeholder="URL of Google Maps Location (Applicable for Weddings/Events)">
                        <button onclick="return verifyEnqEditFrm()">Submit</button>
                    </div>
                </form>
            </div>
            <div class="main" id="main3"><!--Testimonail Add-->
                <form action="dbcon.php" method="post">
                    <input type="hidden" name="pagename" value="testimonial">
                    <div class="userFormDiv">
                        <h2>Add Testimonial</h2>
                        <?php
                        echo"<input type='hidden' name='txtName' id='txtName' value='$uname'>";
                        ?>
                        <p>Testimonial</p>
                        <textarea name="txtTestimonial" id="txtTestimonial" cols="30" rows="10" placeholder="Your Testimonial here"></textarea>
                        <p id="charCount">0 / 255 characters remaining</p>
                        <button onclick="return verifyTesti()">Submit</button>
                    </div>    
                </form>
            </div>
            <div class="main" id="main4"><!--User Profile Edit-->
                <form action="dbcon.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="pagename" value="profileUp">
                    <div class="userFormDiv">
                        <h2>Edit User Profile</h2>
                        <?php
                        echo"<input type='hidden' name='txtName' id='txtName' value='$uname'>";
                        ?>
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

</body>
<script>
    // code to validate testimonial char count (out of 255)
    const textarea = document.getElementById('txtTestimonial');
    const charCount = document.getElementById('charCount');
    const maxLength = 255;

    textarea.addEventListener('input', function() {
    const text = textarea.value;
    const remainingChars = maxLength - text.length;
    
    charCount.textContent = `${text.length} / ${maxLength} characters remaining`;
    
    // Trim the text if it exceeds the maximum length
    if (text.length > maxLength) {
        textarea.classList.add('too-long');
        textarea.value = text.substring(0, maxLength);
        charCount.textContent = `${maxLength} / ${maxLength} characters remaining`;
    } else {
        textarea.classList.remove('too-long');
    }
    });

    function verifyEnqCreationFrm() {// function to verify enq creation form has valid user inputs
        const cnum = document.getElementById('txtTel');
        const jDate = document.getElementById('txtDate');
        const jTime = document.getElementById('txtTime');
        const mail = document.getElementById('txtMail');

        if (cnum.value == "" || jDate.value == "" || jTime.value == "" || mail.value == "") {
            alert("Please verify all the input fields before submitting!");
            return false; // Prevent form submission
        } else {
            return true; // Allow form submission
        }
    }

    function verifyEnqEditFrm(){// function to verify enq edit form has valid user inputs
        const selEn = document.getElementById('selEN');
        const cnum = document.getElementById('txtTel2');
        const jDate = document.getElementById('txtDate2');
        const jTime = document.getElementById('txtTime2');
        const mail = document.getElementById('txtMail2');

        //alert(cnum.value + jDate.value + jTime.value + jLoc.value + mail.value);
        if(selEn.value == "0" || cnum.value == "" || jDate.value == "" || jTime.value == "" || mail.value == ""){// check values of user inputs
            alert("Please verify all the input fields before submitting!");
            return false; // Prevent form submission
        }
        else{
            return true; // Allow form submission
        }
    }

    function verifyTesti(){// function to verify testi form has valid user inputs
        const txtTestimonial = document.getElementById('txtTestimonial');
        if(txtTestimonial.value == ""){
            alert("Please verify all the input fields before submitting!");
            return false; // Prevent form submission
        }
        else{
            return true; // Allow form submission
        }
    }

    function verifyUserProfile(){
        const txtPassword = document.getElementById('txtPassword');
        const profPic = document.getElementById('profPic');

        if(txtPassword.value == "" || profPic.value == ""){
            alert("Please verify all the input fields before submitting!");
            return false; // Prevent form submission
        }
        else{
            return true; // Allow form submission
        }
    }
</script>
</html>