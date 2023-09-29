// Go back button (php files)

document.addEventListener("DOMContentLoaded", function() {
  const goBackButton = document.getElementById('goBackButton');

  goBackButton.addEventListener('click', function() {
    window.history.back(); // Go back to the previous page
    // window.location.reload(); // Reload the previous page
    /*above code doesn't work because the history.back always happens last. 
    So the upload.php runs again without reloading admin_dash.php*/
  });
});


// function to browse through main panels (dashboards)

function browseMain(mainN){
  var main1 = document.getElementById('main1');
  var main2 = document.getElementById('main2');
  var main3 = document.getElementById('main3');
  var main4 = document.getElementById('main4');

  if(mainN == 1){
    main1.style.zIndex = '3';
    main2.style.zIndex = '1';
    main3.style.zIndex = '1';
    main4.style.zIndex = '1';
  }
  else if(mainN == 2){
    main1.style.zIndex = '1';
    main2.style.zIndex = '3';
    main3.style.zIndex = '1';
    main4.style.zIndex = '1';
  }
  else if(mainN == 3){
    main1.style.zIndex = '1';
    main2.style.zIndex = '1';
    main3.style.zIndex = '3';
    main4.style.zIndex = '1';
  }
  else if(mainN == 4){
    main1.style.zIndex = '1';
    main2.style.zIndex = '1';
    main3.style.zIndex = '1';
    main4.style.zIndex = '3';
  }
}

// function to display selected images when uploading(admin dashboard)
document.addEventListener("DOMContentLoaded", function() {
  const imgSelecter = document.getElementById('imgSelecter');
  const selectedImage = document.getElementById('selectedImage');

  imgSelecter.addEventListener('change', function() {
    const file = imgSelecter.files[0]; // Get the selected file

    if (file) {
      const reader = new FileReader(); // Create a FileReader to read the file

      reader.onload = function(event) {
        selectedImage.src = event.target.result; // Update the src attribute of the img tag
      }

      reader.readAsDataURL(file); // Read the selected file as a data URL
    } 
    else {
      selectedImage.src = ''; // Clear the src attribute if no file is selected
    }
  });
});

// function to toggle nav visibility (all)

function navToggler(pagename){
  const mediaQuery = window.matchMedia("(max-width: 600px)");

// Check if the media query matches and page is index.php
if (mediaQuery.matches && pagename == "index") {
  var nav = document.getElementById("nav");
  var realNav = document.querySelector("nav");
  var banner = document.getElementById("banner-body");

  if(nav.style.display=="none"){
    realNav.style.height = "650px";
    nav.style.display="flex";
    banner.style.display = "none";
  } else{
    realNav.style.height = "fit-content";
    nav.style.display="none";
    banner.style.display = "flex";
  }
}else if(mediaQuery.matches){// just media query matching
  var nav = document.getElementById("nav");
  var realNav = document.querySelector("nav");
  var nav_sec = document.getElementById("nav-section");

  if(nav.style.display=="none"){
    realNav.style.height = "650px";
    nav.style.display="flex";
    nav_sec.style.height = "100vh";
  } else{
    realNav.style.height = "fit-content";
    nav.style.display="none";
    nav_sec.style.height = "fit-content";
  }}
}