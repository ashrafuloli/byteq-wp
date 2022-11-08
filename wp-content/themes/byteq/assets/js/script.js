(function ($) {

    'use strict';

    $('.main-menu').meanmenu({
        meanMenuContainer: '.mobile-menu', meanScreenWidth: "1199", meanExpand: '', meanContract: '',
    });

    $(".menu-bar").on("click", function (e) {
        e.preventDefault();
        $(".mobile-menu-wrapper").toggleClass("active");
        $('.menu-overlay').addClass('active');
        $(this).addClass('active');
    });

    $(".menu-close").on("click", function (e) {
        e.preventDefault();
        $(".mobile-menu-wrapper").removeClass("active");
        $('.menu-overlay').removeClass('active');
        $('.menu-bar').removeClass('active');
    });

    $('.menu-overlay').on('click', function () {
        $(this).removeClass('active');
        $(".mobile-menu-wrapper").removeClass("active");
        $('.menu-bar').removeClass('active');
    });


    $('.search-btn > a').on('click', function (e) {
        e.preventDefault();
        $(".search_wrapper").addClass("active");
    });

    $('.search-close').on('click', function (e) {
        e.preventDefault();
        $(".search_wrapper").removeClass("active");
    });

    $("input#keyword").keyup(function() {
        if ($(this).val().length > 2) {
            $("#datafetch").show();
        } else {
            $("#datafetch").hide();
        }
    });

    /*-------------------------------------------
        Sticky Header
    --------------------------------------------- */

    let win = $(window);
    let sticky_id = $(".header-area");
    win.on('scroll', function () {
        let scroll = win.scrollTop();
        if (scroll < 245) {
            sticky_id.removeClass("sticky-header");
        } else {
            sticky_id.addClass("sticky-header");
        }
    });

    /*------------------------------------
        Data-Background
    --------------------------------------*/
    $("[data-background]").each(function () {
        $(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
    });

    $("[data-bg-color]").each(function () {
        $(this).css("background", $(this).attr("data-bg-color"))
    });

    function testimonialSliderActive() {
        if (jQuery(".testimonial-slider-active .swiper-container").length > 0) {
            let testimonialSlider1 = new Swiper('.testimonial-slider-active .swiper-container', {
                // Optional parameters
                slidesPerView: 1,
                slidesPerColumn: 1,
                paginationClickable: true,
                loop: true,
                // spaceBetween: 30,

                autoplay: {
                    delay: 3000,
                },

                scrollbar: {
                    el: '.swiper-scrollbar',
                    hide: true,
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.testimonial-button-next',
                    prevEl: '.testimonial-button-prev',
                },

                a11y: false
            })
        }
    }


    function startAos() {
        // AOS.init({
        //     // Global settings:
        //     disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
        //     startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
        //     initClassName: 'aos-init', // class applied after initialization
        //     animatedClassName: 'aos-animate', // class applied on animation
        //     useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
        //     disableMutationObserver: false, // disables automatic mutations' detections (advanced)
        //     debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
        //     throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)
        //
        //
        //     // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
        //     offset: 120, // offset (in px) from the original trigger point
        //     delay: 0, // values from 0 to 3000, with step 50ms
        //     duration: 400, // values from 0 to 3000, with step 50ms
        //     easing: 'ease', // default easing for AOS animations
        //     once: false, // whether animation should happen only once - while scrolling down
        //     mirror: false, // whether elements should animate out while scrolling past them
        //     anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
        // });
    }

    // startAos();


    $(window).on('elementor/frontend/init', function () {
        // elementorFrontend.hooks.addAction('frontend/element_ready/hero.default', startAos);
        // elementorFrontend.hooks.addAction('frontend/element_ready/featured_list.default', startAos);
        // elementorFrontend.hooks.addAction('frontend/element_ready/service.default', startAos);
        // elementorFrontend.hooks.addAction('frontend/element_ready/cta.default', startAos);
        // elementorFrontend.hooks.addAction('frontend/element_ready/testimonial.default', startAos);
        elementorFrontend.hooks.addAction('frontend/element_ready/testimonial.default', testimonialSliderActive);
    });


})(jQuery);
