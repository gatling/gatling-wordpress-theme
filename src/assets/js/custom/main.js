$(document).ready(function () {
  // MENU
  $(".navicon-button").click(function () {
    $(this).toggleClass("open");
    $(".main-menu").toggleClass("active");
  });

  $(".submenu-li").mouseenter(function () {
    $(this).find(".submenu").addClass("visible");
  });

  $(".submenu").mouseleave(function () {
    $(this).removeClass("visible");
  });

  $(window).click(function (e) {
    var activeClass = $(e.target).parent().attr("class");
    if (activeClass !== "submenu-li") {
      $(".submenu").removeClass("visible");
    }
  });

  //DROPDOWN OPEN-SOURCE
  $(".tool-instruction .title").click(function () {
    $(this)
      .closest(".tool-instruction")
      .find(".instruction--content")
      .toggleClass("active");
    $(this).toggleClass("active");
  });

  //TABLE TABS (MOBILE)
  $(".solution-btn").click(function () {
    $(".solution-btn").removeClass("active");
    $(this).toggleClass("active");
    var solution = $(this).attr("data-solution");
    if (solution == "solution-1") {
      $(".table-comparison tr").removeClass("category-2");
      $(".table-comparison tr").addClass("category-1");
    } else if (solution == "solution-2") {
      $(".table-comparison tr").removeClass("category-1");
      $(".table-comparison tr").addClass("category-2");
    }
  });

  // SLICK
  $(".testimonials-slick").slick({
    centerMode: true,
    slidesToShow: 1,
    dots: true,
    focusOnSelect: true,
    variableWidth: true,
    arrows: false,
  });

  $(".press-slick").slick({
    infinite: true,
    slidesToShow: 6,
    slidesToScroll: 3,
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: false,
    responsive: [
      {
        breakpoint: 1000,
        settings: "unslick",
      },
    ],
  });

  $(".advantages-slick").slick({
    slidesToShow: 4,
    arrows: false,
    responsive: [
      {
        breakpoint: 1130,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          autoplay: true,
          autoplaySpeed: 3000,
          dots: true,
        },
      },
      {
        breakpoint: 870,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 3000,
          dots: true,
        },
      },
    ],
  });

  $(".timeline-slick").slick({
    slidesToShow: 6,
    arrows: false,
    responsive: [
      {
        breakpoint: 1130,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 2,
          dots: true,
          infinite: false,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          dots: true,
          infinite: false,
          focusOnSelect: true,
          variableWidth: true,
        },
      },
    ],
  });

  $(".team-slick").slick({
    slidesToShow: 3,
    arrows: false,
    dots: true,
    slidesToScroll: 2,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          variableWidth: true,
          focusOnSelect: true,
        },
      },
    ],
  });

  $(".resources-slick").slick({
    slidesToShow: 3,
    dots: true,
    arrows: false,
    responsive: [
      {
        breakpoint: 900,
        settings: {
          slidesToShow: 1,
          infinite: true,
          focusOnSelect: true,
        },
      },
    ],
  });

  $(".price-slick").slick({
    slidesToShow: 2,
    arrows: false,
    responsive: [
      {
        breakpoint: 900,
        settings: {
          arrows: false,
          dots: true,
          slidesToShow: 1,
        },
      },
    ],
  });

  $(".price-slick-2").slick({
    slidesToShow: 3,
    arrows: false,
    responsive: [
      {
        breakpoint: 900,
        settings: {
          slidesToShow: 1,
          dots: true,
        },
      },
    ],
  });

  $(".price-slick-5").slick({
    slidesToShow: 5,
    arrows: false,
    responsive: [
      {
        breakpoint: 900,
        settings: {
          slidesToShow: 1,
          dots: true,
        },
      },
    ],
  });

  $(".sessions-slick").slick({
    slidesToShow: 1,
    infinite: false,
    dots: true,
    arrows: false,
  });

  $(".tiles-slick").slick({
    slidesToShow: 1,
    dots: true,
    arrows: false,
  });

  var scrollx = 950 - $(window).width();
  $(".floating-circles").scrollLeft(scrollx / 2);
});
