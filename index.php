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
<body>
    <section id="banner-section" style="scroll-snap-align: start;">
        <div class="dark-bg banner">
            <nav>
                <div id="logo">
                    <img src="images/logo.png" alt="logo" onclick="navToggler('index')">
                </div>
                <ul id="nav">
                    <li onclick="location.href = '/mlismore.com';">Home</li>
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
            <div id="banner-body">
                <div id="left-banner">
                    <h2>Photographer</h2>
                    <h1>Malcolme</h1>
                    <h1>Lismore</h1>
                </div>
                <div id="right-banner">
                    <img src="images/portrait.png" alt="err">
                </div>
            </div>
        </div>
    </section>
    <section id="about-section">
        <div class="light-bg about">
            <div class="about-container">
                <h1 class="about-head">About Me...</h1>
                <div class="about-content">
                    <p class="about-para">I am a freelance photographer located on the North West coast of Scotland. My greatest passion in photography lies in capturing the beauty of the natural world. I offer a variety of images showcasing the rugged Scottish landscape, the fascinating wildlife, and the charming coastal birds. Nonetheless, my interests extend beyond landscape and wildlife photography. Similar to many photographers, I am available for hire to cover weddings, create portraits, and capture special events.</p>    
                    <div class="seperator"></div>
                    <div class="about-boast">
                        <div class="boast-item"><p>Capturer of about 900+ Photographs</p><img src="images/photo.png" alt="photo"></div>
                        <div class="boast-item"><p>Hired by 300+ Customers</p><img src="images/cus.png" alt="customer"></div>
                        <div class="boast-item"><p>15+ Awards Won</p><img src="images/trophy.png" alt="trophy"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="mid-section">
        <div class="dark-bg mid"> <!--parent div-->
            <div class="star-container"> <!--star div-->
                <img src="images/Star 1.png" alt="star" id="star1">
                <img src="images/Star 2.png" alt="star" id="star2">
                <img src="images/Star 3.png" alt="star" id="star3">    
            </div>
            <div class="text-container">
                <h1 id="mid-head">the beauty of nature captured...</h1>
                <div class="picinfo">
                    <p class="active">European Hummingbird</p>
                    <p>Sri Lankan Kingfisher</p>
                    <p>British Puffin</p>
                </div>    
            </div>
            <div id="carousel">
                <img src="images/Hummingbird.png" alt="carousel image" class="active">
                <img src="images/fishmonger.jpeg" alt="carousel image">
                <img src="images/puffin.png" alt="carousel image">
                <div id="car-buttons">
                    <div class="active-car-circle"></div>
                    <div></div>
                    <div></div>    
                </div>
            </div>
        </div>
    </section>
    <section id="signup-section">
        <div class="light-bg sign">
            <div class="signup">
                <h1 id="signup-head">Sign Up for a Job</h1>
                <button id="signupbtn" onclick="window.location.href='sign.html'">Sign Up</button>
            </div>
        </div>
    </section>
    <section id="hirepacks">
        <div class="packages dark-bg">
            <h1 id="packages-head">View Hiring Packages</h1>
            <div id="pack-carousel">
                
                <div class="packs">
                    <div class="pack" onclick="window.location.href='services.html#portraits';">
                        <h3>Portrait Package</h3>
                        <p>Unveil your unique essence through artful portraits, capturing your personality in every frame.</p>
                    </div>
                    <div class="pack" onclick="window.location.href='services.html';">
                        <h3>Wedding Package</h3>
                        <p>Capturing timeless moments of love and joy on your special day, preserving memories to cherish.</p>
                    </div>
                    <div class="pack" onclick="window.location.href='services.html#events';">
                        <h3>Social Package</h3>
                        <p>Documenting vibrant gatherings, encapsulating the spirit of celebrations, and crafting lasting memories.</p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <section id="testimonial-section">
        <div class="testimonials light-bg">
            <?php
                // Establish a database connection (replace with your database credentials)
                include "conn.php";

                // SQL query to retrieve testimonials with user names
                $sql = "SELECT ua.accName, ua.accPIC, t.testDesc FROM testimonials t INNER JOIN useraccounts ua ON t.accID = ua.accID";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data for each testimonial
                    while ($row = $result->fetch_assoc()) {

                        $uname = $row["accName"]; // get vars
                        $utest = $row["testDesc"];

                        echo "<div class='testi'>
                                <span class='testi-span'>
                                <img src='http://localhost/mlismore.com/picdisplay.php?username=$uname' class='testi-img'>
                                <h1 class='testi-h1'>" . $uname . " said,</h1>
                                </span>
                                <p class='testi-p'><strong>``</strong>" . $utest . "<strong>``</strong></p>
                              </div>";
                    }
                } else {
                    echo "No testimonials available.";
                }

                // Close the database connection
                $conn->close();
            ?>
        </div>
    </section>
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
</html>