$(window).scroll(function() {
    if ($(this).scrollTop() > 110){  
        $('.main-header #allStoreHeader').addClass("sticky");
        $('#allStore_nav').addClass("sticky");
        $('body').addClass("paddingTopCss");
    }
    else{
        $('.main-header #allStoreHeader').removeClass("sticky");
        $('#allStore_nav').removeClass("sticky");
        $('body').removeClass("paddingTopCss");
    }
});
//goto top
    $('.allStore-goToTop').click(function(event) {
    event.preventDefault();
    $('html, body').animate({
        scrollTop: $("body").offset().top
    }, 500);
});	

