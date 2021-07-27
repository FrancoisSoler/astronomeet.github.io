import 'jquery';
import 'bootstrap';
import 'popper.js';
import 'is-in-viewport';
import 'rellax';
import 'aos';
// TRES IMPORTANT:
import AOS from 'aos';
import 'jquery.scrollex';


var app = {
  init: function () {
    console.log('init');
    app.hideOnScroll();
    // app.displayMap();
    // app.hideNavOnToggleButton();
    app.rellax();
  },

  // Gestion du hide & show au scroll:
  hideOnScroll: function () {
    var scroll = $(document).scrollTop();
    // Gere la hauteur avant déclenchement (correspondant à la hauteur de la nav)
    var navHeight = $('.menu').outerHeight();
    // Si je souhaite plutot un déclenchement immédiat (mais je conserve la ligne précedente au cas ou).
    var navHeight = 0;
    $(window).scroll(function () {

      var scrolled = $(document).scrollTop();
      // Au lieu d'utiliser un la hauteur de la nav, je regle manuellement l'apparition du bg
      if (scrolled > navHeight) {
        $('.menu').addClass('animate');
      } else {
        $('.menu').removeClass('animate');
      }
      if (scrolled > scroll) {
        $('.menu').removeClass('sticky');
      } else {
        $('.menu').addClass('sticky');
      }
      // Je rajoute cette condition pour que le background disparaisse si on retourne en haut de la page, sur la vidéo:
      if (scrolled == 0) {
        if ($(document).outerWidth() > 768) {
        $('.menu').removeClass('sticky');
      }
    }
      scroll = $(document).scrollTop();

    });

  
  },


  rellax: function () {
    var rellax = new Rellax('.rellax');
  }

  // displayMap: function () {
  //   const options = {
  //     key: 'Ykf7AR5U0CY0Nm9FCUcony5wrg9RkpEC', // REPLACE WITH YOUR KEY !!!
  //     lat: 48.3,
  //     lon: 2.34,
  //     zoom: 5,
  //   };
  //   console.log('step 1');
  //   windyInit(options, windyAPI => {
  //     const { map } = windyAPI;
  //     // .map is instance of Leaflet map
  //     L.popup()
  //       .setLatLng([48.3, 2.34])
  //       .setContent('La putain de map 3 mois après :D')
  //       .openOn(map);
  //   })
  // },

  // hideNavOnToggleButton: function () {
  //   $('.navbar-toggler').click(function (e) {
  //     e.preventDefault();

  //     console.log("clic ok");
  //     const element = document.querySelector("#navbarNav");
  //     if (element.classList.contains("show")) {
  //       $("#navbarNav").removeClass("show");
  //     };
  //   });
  // }

};


AOS.init({
  duration: 4000,
  delay: 400,
  // No scroll effects on low width screen:
  disable: window.innerWidth < 968
});

// Gestion de l'arret des contenus vidéos lorsqu'ils n'apparaissent pas à l'écran avec le plugin isInViewport:
jQuery(document).ready(function ($) {
  "use strict";

  $(window).scroll(function () {
    $('video').each(function () {
      if ($(this).is(":in-viewport( 0 )")) {
        $(this)[0].play();
      } else {
        $(this)[0].pause();
      }
    });
  });
});

$(app.init);
