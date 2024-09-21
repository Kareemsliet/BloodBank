
$(document).ready(function() {
    $('.articles-carousel').owlCarousel({
        loop: false,
        margin: 10,
        rtl: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: false
            },
            1000: {
                items: 3,
                nav: true,
                loop: false
            }
        }
    })
});


let item=document.getElementById('carousel-0');
item.classList.add('active');


function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else {
    console.log("Geolocation is not supported by this browser.");
    }
  }

  function showPosition(position) {
    console.log("Latitude: " + position.coords.latitude +
    "/Longitude:"+ position.coords.longitude);
  }
