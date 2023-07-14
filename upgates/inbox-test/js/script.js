(function ($) {
  $(".mobile-menu_btn").click(function (e) {
    $(".logo").hide();
    $(".mobile-menu_btn").hide();
    $("#mobile-logo_overlay").show();
    $("#mobile-menu_close").show();
    if ($(".main-nav").hasClass("active")) {
      $(".main-nav").removeClass("active").slideUp();
    } else {
      $(".main-nav").addClass("active").slideDown();
      $(".main-nav").css("display", "flex");
      $(".socials_overlay").css("display", "flex");
    }
  });

  $("#mobile-menu_close").click(function (e) {
    $("#mobile-logo_overlay").hide();
    $("#mobile-menu_close").hide();
    $(".main-nav").removeClass("active").slideUp();
    $(".logo").show();
    $(".mobile-menu_btn").show();
    $(".socials_overlay").hide();
  });

  $(".nav-header_slider").click(function (e) {
    e.preventDefault();
    $(".nav-header_slider").removeAttr("id");
    $(this).attr("id", "active");

    var attr = $(this).attr("id", "active");

    if (typeof attr !== typeof undefined && attr !== false) {
      if ($(this).hasClass("bookmark_btn")) {
        $(".slider_page").removeClass("active_page");
        $(".simple-bookmarking_page").addClass("active_page");
      }
      if ($(this).hasClass("intelligent-search_btn")) {
        $(".slider_page").removeClass("active_page");
        $(".intelligent-search_page").addClass("active_page");
      }
      if ($(this).hasClass("share-bookmarks_btn")) {
        $(".slider_page").removeClass("active_page");
        $(".share-bookmarks_page").addClass("active_page");
      }
    }
  });

  $(".faq-question").click(function () {
    if ($(this).next(".faq-answer").hasClass("open")) {
      $(".faq-answer").removeClass("open").slideUp();
      $(".faq-arrow").removeClass("reversed-arrow");
    } else {
      $(".faq-answer").removeClass("open").slideUp();
      $(".faq-arrow").removeClass("reversed-arrow");
      $(this).next(".faq-answer").addClass("open").slideDown();
      $(this).children(".faq-arrow").addClass("reversed-arrow");
    }
  });

  const emailValidator = () => {
    const emailValid = () => {
      $(".email-error_input-icon").css("display", "none");
      $(".email-error_sign").css("display", "none");
      $("#email_input").css("border", "none");
    };
    const emailNotValid = () => {
      $(".email-error_input-icon").css("display", "flex");
      $(".email-error_sign").css("display", "flex");
      $("#email_input").css("border", "2px solid var(--Soft-Red)");
    };

    const emailValidation = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    const emailInput = $("#email_input");

    if (emailValidation.test(emailInput.value)) {
      emailValid();
      return true;
    } else {
      emailNotValid();
      return false;
    }
  };

  $("#email_input").change(emailValidator);
})(jQuery);
