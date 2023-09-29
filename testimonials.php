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
<style>
    body{
        background-color: #0F131F;
    }
    .testi2{
        display:flex;align-items:center;flex-direction:column;padding-top: 20px;
        animation: testi_anime 3s forwards;
    }
    @keyframes testi_anime{
        0%{
            opacity: 0;
        }
        100%{
            opacity: 1;
        }
    }
    .testi2 .testi-span{
        display:flex;gap:1em;
    }
    .testi2 .testi-span .testi-img{
        margin-left:20px;
    }
</style>
<body>
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
    <?php
        // Establish a database connection
        include "conn.php";

        // SQL query to retrieve testimonials with user names
        $sql = "SELECT ua.accName, ua.accPIC, t.testDesc FROM testimonials t INNER JOIN useraccounts ua ON t.accID = ua.accID";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data for each testimonial
            while ($row = $result->fetch_assoc()) {

                $uname = $row["accName"]; // get vars
                $utest = $row["testDesc"];

                echo "<div class='dark-bg testi2'>
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