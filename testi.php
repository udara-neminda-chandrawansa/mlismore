<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials Testing</title>
</head>
<style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: start;
        }

        .testimonials-container {
            text-align: center;
        }

        .testi {
            opacity: 0; /* Initially set opacity to 0 for the fade-in effect */
            transform: translateY(20px); /* Initially set a slight upward translation */
            transition: opacity 3s ease, transform 3s ease; /* Add transition */
            display: inline-block;
            width: 100%;
            height: 150px;
            margin: 10px;
        }

        /* Apply animation when testimonials come into view */
        .testi.fade-in {
            opacity: 1;
            transform: translateY(0);
        }
</style>
<body>
<div class="testimonials-container">
<?php
// Establish a database connection (replace with your database credentials)
include "conn.php";

// SQL query to retrieve testimonials with user names
$sql = "SELECT ua.accName, t.testDesc FROM testimonials t INNER JOIN useraccounts ua ON t.accID = ua.accID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each testimonial
    while ($row = $result->fetch_assoc()) {
        echo
            "<div class='testi'>
                <p>" . $row["accName"] . " said..,</p>
                <p>" . $row["testDesc"] . "</p>
            </div>
            ";
    }
} else {
    echo "No testimonials available.";
}

// Close the database connection
$conn->close();
?>
</div>
</body>
<script>
    // JavaScript to add the fade-in class when testimonials come into view
    const testimonials = document.querySelectorAll('.testi');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    });

    testimonials.forEach(testimonial => {
        observer.observe(testimonial);
    });
</script>
</html>
