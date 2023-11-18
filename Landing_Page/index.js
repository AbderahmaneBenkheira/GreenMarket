function openNavbar() {
    document.getElementById("sideNavigationBar")
      .style.width = "35%";
  }
  
function closeNavbar() {
   document.getElementById("sideNavigationBar")
    .style.width = "0%";
}

var video = document.getElementById("video11"); // Replace "yourVideoId" with the actual ID of your video element
var fraction = 0.8;

function checkScroll() {
    var x = video.offsetLeft,
        y = video.offsetTop,
        w = video.offsetWidth,
        h = video.offsetHeight,
        r = x + w, //right
        b = y + h, //bottom
        visibleX, visibleY, visible;

    visibleX = Math.max(0, Math.min(w, window.pageXOffset + window.innerWidth - x, r - window.pageXOffset));
    visibleY = Math.max(0, Math.min(h, window.pageYOffset + window.innerHeight - y, b - window.pageYOffset));

    visible = visibleX * visibleY / (w * h);

    if (visible > fraction) {
        video.play();
    } else {
        video.pause();
    }
}

window.addEventListener('scroll', checkScroll, false);
window.addEventListener('resize', checkScroll, false);

// Get the button:
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
