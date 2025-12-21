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


        
        
  });