document.addEventListener('DOMContentLoaded', () => {
  "use strict";

  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove();
    });
  }

  /**
   * Scroll top button
   */
  const scrollTop = document.querySelector('.scroll-top');
  if (scrollTop) {
    const togglescrollTop = function () {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
    window.addEventListener('load', togglescrollTop);
    document.addEventListener('scroll', togglescrollTop);
  };

  // languageBar popup model
  const toggleButtoncountry = document.getElementById('toggleButtoncountry');
  const targetDivcountry = document.getElementById('languagePopup');
  const closeButton = document.getElementById('closeButtoncountry');

  toggleButtoncountry.addEventListener('click', function() {
    targetDivcountry.classList.toggle('open');
  });
  closeButtoncountry.addEventListener('click', function() {
    targetDivcountry.classList.remove('open');
  });

  /**
   * Mobile nav toggle
   */
  const mobileNavShow = document.querySelector('.mobile-nav-show');
  const mobileNavHide = document.querySelector('.mobile-nav-hide');

  document.querySelectorAll('.mobile-nav-toggle').forEach(el => {
    el.addEventListener('click', function (event) {
      event.preventDefault();
      mobileNavToogle();
    })
  });

  function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavShow.classList.toggle('d-none');
    mobileNavHide.classList.toggle('d-none');
  }

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navbar a').forEach(navbarlink => {

    if (!navbarlink.hash) return;

    let section = document.querySelector(navbarlink.hash);
    if (!section) return;

    navbarlink.addEventListener('click', () => {
      if (document.querySelector('.mobile-nav-active')) {
        mobileNavToogle();
      }
    });

  });

  /**
   * Toggle mobile nav dropdowns
   */
  const navDropdowns = document.querySelectorAll('.navbar .dropdown > a');

navDropdowns.forEach(el => {
  el.addEventListener('click', function(event) {
    if (document.querySelector('.mobile-nav-active')) {
      event.preventDefault();
      const isActive = this.classList.contains('active');
      navDropdowns.forEach(item => {
        if (item !== this) {
          item.classList.remove('active');
          item.nextElementSibling.classList.remove('dropdown-active');

          let dropDownIndicator = item.querySelector('.dropdown-indicator');
          dropDownIndicator.classList.remove('bi-chevron-up');
          dropDownIndicator.classList.add('bi-chevron-down');
        }
      });
      this.classList.toggle('active', !isActive);
      this.nextElementSibling.classList.toggle('dropdown-active', !isActive);

      let dropDownIndicator = this.querySelector('.dropdown-indicator');
      dropDownIndicator.classList.toggle('bi-chevron-up', !isActive);
      dropDownIndicator.classList.toggle('bi-chevron-down', isActive);
    }
  });
});

document.addEventListener('click', function(event) {
  if (!event.target.closest('.navbar .dropdown > a')) {
    navDropdowns.forEach(el => {
      el.classList.remove('active');
      el.nextElementSibling.classList.remove('dropdown-active');

      let dropDownIndicator = el.querySelector('.dropdown-indicator');
      dropDownIndicator.classList.remove('bi-chevron-up');
      dropDownIndicator.classList.add('bi-chevron-down');
    });
  }
});


  

  // Homepage Slider

  new Swiper('.swiper-hader-link', {
    speed: 1000,
    loop: false,
    autoplay: {
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },
    slidesPerView: 'auto',
    breakpoints: {
      320: {
        slidesPerView: 4,
        spaceBetween: 10
      },
    }
  });

  new Swiper('.swiper-testimonilas', {
    speed: 1000,
    loop: false,
    autoplay: {
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },
    slidesPerView: 'auto',
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 10
      },
      992: {
        slidesPerView: 2,
        spaceBetween: 10
      },
    }
  });


// purecounter
new PureCounter();


});