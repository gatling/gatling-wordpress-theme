$(document).ready(function () {
  $(".slider-events").slick({
    infinite: false,
    appendArrows: $(".slider--navigation"),
    prevArrow:
      '<button type="button" class="custom-arrow prev-btn"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="14" viewBox="0 0 20 14"><path d="M.272 6.331L6.224.277c.363-.37.952-.37 1.315 0s.363.968 0 1.338L3.175 6.054H19.07c.514 0 .93.424.93.946s-.416.946-.93.946H3.175l4.364 4.44c.363.369.363.968 0 1.337-.181.185-.42.277-.658.277-.237 0-.475-.092-.657-.277L.272 7.669c-.363-.37-.363-.968 0-1.338z"/></svg></button>',
    nextArrow:
      '<button type="button" class="custom-arrow next-btn"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="14" viewBox="0 0 20 14"><path d="M19.728 6.331L13.776.277c-.363-.37-.952-.37-1.315 0s-.363.968 0 1.338l4.364 4.439H.93C.416 6.054 0 6.478 0 7s.416.946.93.946h15.895l-4.364 4.44c-.363.369-.363.968 0 1.337.181.185.42.277.658.277.237 0 .475-.092.657-.277l5.952-6.054c.363-.37.363-.968 0-1.338z"/></svg></button>',
    responsive: [
      {
        breakpoint: 999999,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 2,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 560,
        settings: {
          slidesToShow: 1,
          variableWidth: true,
        },
      },
    ],
  });

  var $resourcesGrid = $(".resources-grid").isotope({
    itemSelector: ".grid-item",
    layoutMode: "fitRows",
    fitRows: {
      gutter: 30,
    },
  });

  var filterFns = {
    search: function () {
      var name = $(this).text().toUpperCase();
      var input = $("#search").val().toUpperCase();

      return name.includes(input);
    },
  };

  $(".resources-filters .buttons, .resources-filters .dropdown-buttons").on(
    "click",
    "button:not(.deploy-dropdown)",
    function () {
      var filterValue = $(this).attr("data-filter");
      $resourcesGrid.isotope({ filter: filterValue });
    }
  );

  $(".resources-filters").on("keyup", "#search", function () {
    var filterValue = filterFns["search"];
    $resourcesGrid.isotope({ filter: filterValue });
    $(".resources-filters button").removeClass("active");
    $(".resources-filters .default-btn").addClass("active");
  });

  $(".resources-filters .buttons").each(function (i, buttonGroup) {
    var $buttonGroup = $(buttonGroup);
    $buttonGroup.on("click", "button", function () {
      $buttonGroup.find(".active").removeClass("active");
      $(this).addClass("active");
    });
  });

  $(".dropdown-buttons").on("click", ".deploy-dropdown", function () {
    $(this).closest(".dropdown-buttons").toggleClass("open");
  });

  $(".dropdown-buttons").on(
    "click",
    "button:not(.deploy-dropdown)",
    function () {
      var $buttonGroup = $(this).closest(".dropdown-buttons");
      $buttonGroup.find(".active").removeClass("active");
      $buttonGroup.removeClass("open");
      $(this).addClass("active");
    }
  );
});
