document.addEventListener("DOMContentLoaded", function () {
    // Target the <div> where you want to display the images
    const imgContainer = document.getElementById("landscape");

    // Define the parameters you want to send
    const params = new URLSearchParams();
    params.append("imgType", "landscape"); // Replace with your parameter name and value

    // Make an AJAX request to the PHP script with parameters
    fetch("gallery_image_retriever.php", {
        method: "POST", // Use the POST method to send data
        body: params,   // Send the parameters in the request body
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })
        .then(response => response.text())
        .then(data => {
            // Insert the image data into the <div>
            imgContainer.innerHTML = data;

            // Modify the image properties here
            const images = imgContainer.getElementsByTagName("img");
            for (let i = 0; i < images.length; i++) {
                const img = images[i];
                // Example: Change the width and height of each image
                img.addEventListener('click', function() {

                    // verify if the image contains 'zoomed-image' as a class
                    const isZoomed = img.classList.contains('zoomed-image');
                    
                    // If the clicked image is zoomed, remove the zoomed-image class to make it normal
                    if (isZoomed) {
                        img.classList.remove('zoomed-image');
                    }
                    else {
                      // If it's not zoomed, remove the zoomed-image class from all other images
                      const currentlyZoomed = document.querySelector('.zoomed-image'); // select the currently zoomed image
              
                      if (currentlyZoomed) {
                        currentlyZoomed.classList.remove('zoomed-image'); // remove 'zoomed-image' class from selected image
                      }
              
                      // Toggle the zoomed-image class on the clicked image to zoom it in
                      img.classList.add('zoomed-image');
                    }
                  });
            }
        })
        .catch(error => {
            console.error("Error fetching data:", error);
        });
});