$(document).ready(function(){

    //======< Scroll to top button >======
  
    $("#scrolltoTop").click(function() {
        $("html").animate({ scrollTop: 0 }, "slow");
        });



// =======< accordion js >========
$(".accordion > li:first").addClass("active").find("p").slideDown();
$('.accordion li').on('click', function () {
    var dropDown = $(this).find("p");

    $(this).closest(".accordion").find("p").not(dropDown).slideUp();

    if ($(this).hasClass("active")) {
        $(this).removeClass("active");
    } else {
        $(this).closest(".accordion").find("li.active").removeClass("active");
        $(this).addClass("active");
    }

    dropDown.stop(false, true).slideToggle();
});
        //======< Custom Tab >======
        $('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');

        $(".tab ul.tabs li a").on("click", function (g) {
            var tab = $(this).closest('.tab'),
                index = $(this).closest('li').index();
        
            tab.find('ul.tabs > li').removeClass('current');
            $(this).closest('li').addClass('current');
        
            tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
            tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
        
            g.preventDefault();
        });

        if ($(".billingCycle").length > 0) {
            var billingPlanInputs = $("input[name='billingPlan']");
            billingPlanInputs.change(function () {
              var billingPlan = $(this).val();
              $.each(['.monthly-price', '.yearly-price', '.biannual-price', '.triennial-price'], function (index, tag) {
                $(tag).css('display', 'none');
              });
              $('.' + billingPlan + '-price').css('display', 'block');
            });
          } 


        // When hovering over elements with data-toggle="tooltip"
        $('[data-toggle="tooltip"]').hover(function(){
            var tooltipText = $(this).attr('data-original-title'); // Get tooltip text from data-original-title
            var placement = $(this).attr('data-placement') || 'top'; // Get placement or default to 'top'
            // Create and position the tooltip div
            var tooltipDiv = $('<div class="tooltips"><div class="inner">' + tooltipText + '</div></div>').appendTo('body');
            // Position the tooltip relative to the hovered element based on placement
            var elementOffset = $(this).offset();
            var elementWidth = $(this).outerWidth();
            var elementHeight = $(this).outerHeight();
            var tooltipWidth = tooltipDiv.outerWidth();
            var tooltipHeight = tooltipDiv.outerHeight();
            var topPos, leftPos;
            switch (placement) {
                case 'top':
                    topPos = elementOffset.top - tooltipHeight - 10;
                    leftPos = elementOffset.left + elementWidth / 2 - tooltipWidth / 2;
                    break;
                case 'bottom':
                    topPos = elementOffset.top + elementHeight + 10;
                    leftPos = elementOffset.left + elementWidth / 2 - tooltipWidth / 2;
                    break;
                case 'left':
                    topPos = elementOffset.top + elementHeight / 2 - tooltipHeight / 2;
                    leftPos = elementOffset.left - tooltipWidth - 10;
                    break;
                case 'right':
                    topPos = elementOffset.top + elementHeight / 2 - tooltipHeight / 2;
                    leftPos = elementOffset.left + elementWidth + 10;
                    break;
            }
            tooltipDiv.css({
                top: topPos,
                left: leftPos
            });
            // Show the tooltip
            tooltipDiv.fadeIn();
        }, function(){
            // When mouse leaves, remove the tooltip
            $('.tooltips').remove();
        });
        
  });