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
    <style>
        .message_section{
            padding: 0px 30px;
            height: calc(100vh - 90px);
            overflow-y: scroll;
        }
        .message_section p{
            padding-top: 30px;
            font-family: Thasadith,serif;
            font-weight: 600;
        }
        .message_section p a{
            color: #000;
        }
    </style>
</head>
<body class="light-bg">
    <section id="nav-section" class="light-bg">
        <nav id="dark-nav">
            <div id="logo">
                <img src="images/logo.png" alt="logo" style="filter:drop-shadow(1px 1px 1px #000);" onclick="navToggler('')">
            </div>
            <ul id="nav">
                <li onclick="location.href = 'index.php';">Home</li>
                <li>Services
                    <i class="fa fa-caret-down" id="dark-caret-down"></i>
                    <div class="subnav">
                            <ul>
                                <li onclick="window.location.href='services.html';">Weddings</li>
                                <li onclick="window.location.href='services.html#portraits';">Portraits</li>
                                <li onclick="window.location.href='services.html#events';">Social Events</li>
                            </ul>
                        </div>
                </li>
                <li>Gallery
                    <i class="fa fa-caret-down" id="dark-caret-down"></i>
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
    <section class="message_section">
    <?php
        include "conn.php";


        // SQL query to retrieve testimonials with user names
        $sql = "SELECT * FROM contacts";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data for each testimonial
            while ($row = $result->fetch_assoc()) {

                $email = $row["cEmail"]; // get vars
                $message = $row["cMessage"];

                echo "<p><a href='mailto:$email'>$email</a> texted : $message</p>";
            }
        } else {
            echo "No testimonials available.";
        }

        // Close the database connection
        $conn->close();
    ?>
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