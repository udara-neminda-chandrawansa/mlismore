// package arrays
var pack1 = ['Wedding Package','Best for Weddings','$900'];
var pack2 = ['Portrait Package','Best for Portrait','$300'];
var pack3 = ['Social Package','Best for Social Events','$1500'];

// package arrays name array
var arrarr = ['pack1','pack2','pack3'];

function babayaga(arr){
  if(arr == arrarr[0]){
    var head = pack1[0];
    var para = pack1[1] + " - " + pack1[2];
    alert(head + " : " + para);
  }
  else if(arr == arrarr[1]){
    var head = pack2[0];
    var para = pack2[1] + " - " + pack2[2];
    alert(head + " : " + para);
  }
  else if(arr == arrarr[2]){
    var head = pack3[0];
    var para = pack3[1] + " - " + pack3[2];
    alert(head + " : " + para);
  }
}

// function to create accs

function createAcc(){
  var usr = document.getElementById('username').value;
  var psw = document.getElementById('password').value;

  if(psw.length > 1){
    alert("Account Creation Success " + usr + " !");
  }
}

// function to verify login accs

function verifyAcc() {
  var usr = document.getElementById('username').value;
  var psw = document.getElementById('password').value;

  if (usr == "admin" && psw == "123") {
    window.location.href = "admin_dash.html";
  }
  else if (usr == "udara" && psw == "123") {
    window.location.href = "cus_dash.html";
  }
  else {
    alert("Login Unsuccessful !");
  }
}

// function to browse through main panels

function browseMain(mainN){
  var main1 = document.getElementById('main1');
  var main2 = document.getElementById('main2');
  var main3 = document.getElementById('main3');

  if(mainN == 1){
    main1.style.zIndex = '3';
    main2.style.zIndex = '1';
    main3.style.zIndex = '1';
  }
  else if(mainN == 2){
    main1.style.zIndex = '1';
    main2.style.zIndex = '3';
    main3.style.zIndex = '1';
  }
  else if(mainN == 3){
    main1.style.zIndex = '1';
    main2.style.zIndex = '1';
    main3.style.zIndex = '3';
  }
}

// function to display selected images
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

// function to zoom clicked images in Gallery
document.addEventListener("DOMContentLoaded", function() {

  // select all gallery-images to a const
  const galleryImages = document.querySelectorAll('.gallery-images');

  // use a foreach loop to apply settings to the 'galleryImages'
  galleryImages.forEach(function(image) {

    // add a click event to each image in 'galleryImages'
    image.addEventListener('click', function() {

      // verify if the image contains 'zoomed-image' as a class
      const isZoomed = image.classList.contains('zoomed-image');
      
      // If the clicked image is zoomed, remove the zoomed-image class to make it normal
      if (isZoomed) {
        image.classList.remove('zoomed-image');
      }
      else {
        // If it's not zoomed, remove the zoomed-image class from all other images
        const currentlyZoomed = document.querySelector('.zoomed-image'); // select the currently zoomed image

        if (currentlyZoomed) {
          currentlyZoomed.classList.remove('zoomed-image'); // remove 'zoomed-image' class from selected image
        }

        // Toggle the zoomed-image class on the clicked image to zoom it in
        image.classList.add('zoomed-image');
      }
    });
  });
});

// function to delete images from gallery [admin]
function verifyDeletion(){
  const userResponse = confirm("Are you sure to delete this image from your Gallery ?");

  if (userResponse) {
    // User clicked "OK" (or equivalent) - perform the action for "Yes"
    alert("Delete Success !");
  } 
  else {
    // User clicked "Cancel" (or equivalent) - perform the action for "No"
    alert("Didn't Delete !");
  }
}

function navToggler(){
  const mediaQuery = window.matchMedia("(max-width: 600px)");

// Check if the media query matches
if (mediaQuery.matches) {
  var nav = document.getElementById("nav");
  var realNav = document.querySelector("nav");

  if(nav.style.display!="none"){
    nav.style.display="none";
    realNav.style.height = "fit-content";
  } else{nav.style.display="flex";realNav.style.height = "650px";}  
}}