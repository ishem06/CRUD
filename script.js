document.addEventListener("DOMContentLoaded", function() {
    var menuToggle = document.getElementById("menu-toggle");
    var menu = document.querySelector(".menu");

    menuToggle.addEventListener("change", function() {
        if (menuToggle.checked) {
            menu.style.display = "block"; // Show menu when checkbox is checked
        } else {
            menu.style.display = "none"; // Hide menu when checkbox is unchecked
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var header = document.getElementById("header");

    // Add scroll event listener
    window.addEventListener("scroll", function() {
        if (window.scrollY > 0) {
            header.style.backgroundColor = "rgba(0, 0, 0, 0.8)"; // Change header background color when scrolling
        } else {
            header.style.backgroundColor = "rgba(0, 0, 0, 0.2)"; // Reset to transparent when scrolled to top
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var currentImageIndex = 0;
    var images = ['hdd.png', 'wings.jpg']; // Add more image URLs if needed
    var hero = document.getElementById("hero");
    var canvas = document.createElement("canvas");
    var ctx = canvas.getContext("2d");
    var backgroundImage = new Image();

    function prevBackground() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        loadNewImage(images[currentImageIndex]);
    }

    function nextBackground() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        loadNewImage(images[currentImageIndex]);
    }

    function loadNewImage(imageUrl) {
        backgroundImage.src = imageUrl;
    }

    backgroundImage.onload = function() {
        hero.style.backgroundImage = "url('" + backgroundImage.src + "')";
    };

    // Attach event listeners to the buttons
    document.getElementById("prevBtn").addEventListener("click", prevBackground);
    document.getElementById("nextBtn").addEventListener("click", nextBackground);

    // Initialize background image
    loadNewImage(images[currentImageIndex]);

    // Automatically move to the next image every 2 seconds
    var intervalId = setInterval(nextBackground, 2000 );

    // Clear the interval when the mouse enters the hero element
    hero.addEventListener("mouseenter", function() {
        clearInterval(intervalId);
    });

    // Restart the interval when the mouse leaves the hero element
    hero.addEventListener("mouseleave", function() {
        intervalId = setInterval(nextBackground, 2000);
    });

});



document.addEventListener("DOMContentLoaded", function() {
    var menuLinks = document.querySelectorAll('.menu a');
    var currentPage = window.location.href;
  
    menuLinks.forEach(function(link) {
      if (link.href === currentPage) {
        link.classList.add('active');
      }
    });
  });
 
 
  function closeWindow() {
    var windowElement = document.getElementById("window");
    windowElement.style.display = "none";
}

// Function to show the window after 3 seconds
function showWindow() {
    var windowElement = document.getElementById("window");
    windowElement.style.display = "block";
}

// Delay showing the window
setTimeout(showWindow, 2000); 

function switchImage() {
    var slides = document.querySelectorAll('.slideshow img');
    var current = 0;

    setInterval(function() {
        slides[current].style.opacity = 0;
        current = (current + 1) % slides.length;
        slides[current].style.opacity = 1;
    }, 3000); // Change image every 3 seconds (adjust as needed)
}

// Call the function to start the slideshow
switchImage();