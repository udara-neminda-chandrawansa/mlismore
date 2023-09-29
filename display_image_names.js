// display_en.js
document.addEventListener("DOMContentLoaded", function () {
    // Target the <select> where you want to display the options
    const optionSel = document.getElementById("selectImagetoDelete");

    // Make an AJAX request to the PHP script
    fetch("view_im.php")
        .then(response => response.text())
        .then(data => {
            // Insert the option data into the <select>
            optionSel.innerHTML = data;
        })
        .catch(error => {
            console.error("Error fetching data:", error);
        });
});