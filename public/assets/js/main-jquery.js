!(function ($) {
    "use strict";

    var pathname = window.location.pathname;
    // Mobile Navigation
    if ($('.nav-menu').length) {
        $(document).on('click', '.mobile-nav-toggle', function (e) {
            $('body').toggleClass('mobile-nav-active');
            $('.mobile-nav-toggle i').toggleClass('fa-bars fa-times');
            $('.mobile-nav-overly').toggle();
        });

        $(document).on('click', '.mobile-nav .drop-down > a', function (e) {
            e.preventDefault();
            $(this).next().slideToggle(300);
            $(this).parent().toggleClass('active');
        });

        $(document).click(function (e) {
            var container = $(".mobile-nav, .mobile-nav-toggle");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                if ($('body').hasClass('mobile-nav-active')) {
                    $('body').removeClass('mobile-nav-active');
                    $('.mobile-nav-toggle i').toggleClass('fa-bars fa-times');
                    $('.mobile-nav-overly').fadeOut();
                }
            }
        });
    } else if ($(".mobile-nav, .mobile-nav-toggle").length) {
        $(".mobile-nav, .mobile-nav-toggle").hide();
    }

    // Navigation active state on scroll
    var nav_sections = $('section');
    var main_nav = $('.nav-menu, .mobile-nav');

    $(window).on('scroll', function () {
        var cur_pos = $(this).scrollTop() + 200;

        nav_sections.each(function () {
            var top = $(this).offset().top,
                bottom = top + $(this).outerHeight();

            if (cur_pos >= top && cur_pos <= bottom) {
                if (cur_pos <= bottom) {
                    main_nav.find('li').removeClass('active');
                }
                main_nav.find('a[href="#' + $(this).attr('id') + '"]').parent('li').addClass('active');
            }
            if (cur_pos < 300) {
                $(".nav-menu ul:first li:first").addClass('active');
            }
        });
    });

    // Toggle .header-scrolled class to #header when page is scrolled

    if (pathname == '/') {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#header').addClass('header-scrolled');
            } else {
                $('#header').removeClass('header-scrolled');
            }
        });

        if ($(window).scrollTop() > 100) {
            $('#header').addClass('header-scrolled');
        }
    } else {
        $('section')[0].classList.add("mt-16");
        $('section')[0].classList.add("md:mt-20");
        
        // $('section')[0].style.cssText = "margin-top:64px";
    }

    // Menu list isotope and filter
    $(window).on('load', function () {
        var menuIsotope = $('.menu-container').isotope({
            itemSelector: '.menu-item',
            layoutMode: 'fitRows'
        });

        $('#menu-flters li').on('click', function () {
            $("#menu-flters li").removeClass('filter-active');
            $(this).addClass('filter-active');

            menuIsotope.isotope({
                filter: $(this).data('filter')
            });
        });
    });
})(jQuery);

