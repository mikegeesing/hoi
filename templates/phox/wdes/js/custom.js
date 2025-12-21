// Overwrite the sidebar minimize function
function overwriteSidebarMinimize() {
  if (jQuery(".container").width() <= 720) {
    jQuery(".panel-sidebar").find(".panel-body, .list-group").show();
    jQuery(".panel-sidebar").find(".panel-minimise").removeClass("minimised");
  }
}

// Allow Different Layouts Based on Query Key add a class to the body
function changeLayout() {
  var urlParams = new URLSearchParams(window.location.search);
  var layout = urlParams.get("layout");
  var existingLayoutClass = Array.from(document.body.classList).find(
    (className) => className.startsWith("wdes-layout-")
  );
  var defaultClass = existingLayoutClass || "wdes-layout-default";

  // Retrieve layout from localStorage if not specified in the URL
  if (!layout) {
    layout = localStorage.getItem("layout") || null;
  }

  // Reset body classes to remove any existing layout classes
  document.body.classList.forEach(function (className) {
    if (className.startsWith("wdes-layout-")) {
      document.body.classList.remove(className);
    }
  });

  if (layout) {
    // Store the layout in localStorage
    localStorage.setItem("layout", layout);

    // Add the layout class to the body
    document.body.classList.add("wdes-layout-" + layout);
  } else {
    // Revert to the default class if no layout is specified
    document.body.classList.add(defaultClass);
    localStorage.removeItem("layout"); // Clear localStorage if no layout is provided
  }
}

// Allow Different Themes Based on Query Key and add a class to the body
function changeTheme() {
  var urlParams = new URLSearchParams(window.location.search);
  var theme = urlParams.get("theme");
  var existingThemeClass = Array.from(document.body.classList).find(
    (className) => className.startsWith("wdes-style-")
  );
  var defaultClass = existingThemeClass || "wdes-style-default";

  // Retrieve theme from localStorage if not specified in the URL
  if (!theme) {
    theme = localStorage.getItem("theme") || null;
  }

  // Reset body classes to remove any existing theme classes
  document.body.classList.forEach(function (className) {
    if (className.startsWith("wdes-style-")) {
      document.body.classList.remove(className);
    }
  });

  if (theme) {
    // Store the theme in localStorage
    localStorage.setItem("theme", theme);

    // Add the theme class to the body
    document.body.classList.add("wdes-style-" + theme);
  } else {
    // Revert to the default class if no theme is specified
    document.body.classList.add(defaultClass);
    localStorage.removeItem("style"); // Clear localStorage if no theme is provided
  }
}

// Allow Different Colors Schemes Based on Query Key and change css variables
function changeColorScheme() {
  // Retrieve the color value from the URL
  var urlParams = new URLSearchParams(window.location.search);
  var color = urlParams.get("color");

  if (color) {
    // Save the color to local storage
    localStorage.setItem("colorScheme", color);
  } else {
    // If no color in URL, check local storage
    color = localStorage.getItem("colorScheme");
  }

  // Apply the color scheme based on the value
  switch (color) {
    case "green":
      document.documentElement.style.setProperty("--main-clr", "#45c36d");
      document.documentElement.style.setProperty(
        "--brand-primary-lighter",
        "#57da81"
      );
      document.documentElement.style.setProperty(
        "--brand-primary-lighter-2",
        "#57d980"
      );
      document.documentElement.style.setProperty("--btn-bg", "#e5ffed");
      document.documentElement.style.setProperty(
        "--main-color-lighter-v1",
        "#eefff3"
      );
      break;

    case "blue":
      document.documentElement.style.setProperty("--main-clr", "#283194");
      document.documentElement.style.setProperty(
        "--brand-primary-lighter",
        "#3842b4"
      );
      document.documentElement.style.setProperty(
        "--brand-primary-lighter-2",
        "#4954cc"
      );
      document.documentElement.style.setProperty("--btn-bg", "#eef0ff");
      document.documentElement.style.setProperty(
        "--main-color-lighter-v1",
        "#f6f7ff"
      );
      break;

    case "orange":
      document.documentElement.style.setProperty("--main-clr", "#E87A2D");
      document.documentElement.style.setProperty(
        "--brand-primary-lighter",
        "#ef853b"
      );
      document.documentElement.style.setProperty(
        "--brand-primary-lighter-2",
        "#f69e60"
      );
      document.documentElement.style.setProperty("--btn-bg", "#ffeee1");
      document.documentElement.style.setProperty(
        "--main-color-lighter-v1",
        "#fdf8f4"
      );
      break;

    case "red":
      document.documentElement.style.setProperty("--main-clr", "#D14C4C");
      document.documentElement.style.setProperty(
        "--brand-primary-lighter",
        "#e46363"
      );
      document.documentElement.style.setProperty(
        "--brand-primary-lighter-2",
        "#f29393"
      );
      document.documentElement.style.setProperty("--btn-bg", "#fff1f1");
      document.documentElement.style.setProperty(
        "--main-color-lighter-v1",
        "#fff7f7"
      );
      break;

    default:
      break;
  }
}

// Extend ICheck
(function ($) {
  // Save the original iCheck method
  var originalICheck = $.fn.iCheck;

  // Override the iCheck method
  $.fn.iCheck = function (options) {
    // Replace the existing classes with your custom ones
    var extendedOptions = $.extend({}, options, {
      checkboxClass: "icheckbox-wdes", // Your custom class only
      radioClass: "iradio-wdes", // Your custom class only
    });

    // Call the original iCheck method with the updated options
    return originalICheck.call(this, extendedOptions);
  };

  // Function to initialize iCheck on uninitialized inputs
  $.fn.initICheck = function () {
    this.filter("input[type='checkbox'], input[type='radio']")
      .not(".no-icheck") // Exclude inputs with specific classes
      .not(".toggle-switch-success")
      .not(".icheck-initialized") // Skip already initialized inputs
      .each(function () {
        var $input = $(this);
        var $parent = $input.parent();

        // Check if already initialized
        if (!$parent.hasClass("icheckbox") && !$parent.hasClass("iradio")) {
          $input.iCheck({
            inheritID: true,
            checkboxClass: "icheckbox-wdes",
            radioClass: "iradio-wdes",
            increaseArea: "20%",
          });
          $input.addClass("icheck-initialized"); // Mark as initialized
        }
      });
  };
})(jQuery);

// Initialize on specific inputs
jQuery("input[type='checkbox'], input[type='radio']").initICheck();

// Cart Offset
function cartOffset() {
  jQuery(window).on("scroll", function () {
    if (jQuery(window).scrollTop() > 150) {
      jQuery(".secondary-cart-sidebar").addClass("sticky-cart");
    } else {
      jQuery(".secondary-cart-sidebar").removeClass("sticky-cart");
    }
  });
}

// Dropdown Search
function enableDropdownSearch(dropdownSelector) {
  if (!$(dropdownSelector).length) return;

  $(dropdownSelector).on("keyup", function () {
    const value = $(this).val().toLowerCase();
    const $dropdownMenu = $(this).closest(".dropdown-menu");
    const $items = $dropdownMenu
      .find("li:has(a)")
      .not(".language-search-dropdown");

    let matchCount = 0;

    $items.each(function () {
      const isMatch = $(this).text().toLowerCase().indexOf(value) > -1;
      $(this).toggle(isMatch);
      if (isMatch) matchCount++;
    });

    // Handle "No Results" message
    let $noResults = $dropdownMenu.find(".no-results");
    if (!$noResults.length) {
      $noResults = $(
        '<li class="no-results" style="text-align:center; color:#999;">No results found</li>'
      );
      $dropdownMenu.append($noResults);
    }

    $noResults.toggle(matchCount === 0);
  });
}

document.addEventListener("DOMContentLoaded", function () {
  overwriteSidebarMinimize();

  changeLayout();

  changeColorScheme();

  changeTheme();

  cartOffset();

  enableDropdownSearch(".dropdown-search");
});
