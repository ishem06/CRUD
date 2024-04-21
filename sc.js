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
            header.style.backgroundColor = "transparent"; // Reset to transparent when scrolled to top
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var menuLinks = document.querySelectorAll('.menu a');

    menuLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            // Remove 'active' class from all links
            menuLinks.forEach(function(link) {
                link.classList.remove('active');
            });

            // Add 'active' class to the clicked link
            this.classList.add('active');
        });
    });
});



