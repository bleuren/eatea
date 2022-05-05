'use strict';

// Mobile Navigation
if (document.getElementsByClassName('nav-menu').length) {

    document.addEventListener('click', function (e) {
        for (var target = e.target; target && target != this; target = target.parentNode) {
            if (target.matches('.mobile-nav-toggle')) {
                document.body.classList.toggle('mobile-nav-active');
                var toggle = document.querySelector('.mobile-nav-toggle i');
                toggle.className =
                    toggle.className === 'fas fa-bars' ?
                    'fas fa-times' :
                    'fas fa-bars';
                var overly = document.querySelector('.mobile-nav-overly');
                if (overly.classList.contains('none')) {
                    overly.classList.remove('none');
                    overly.classList.add('block');
                } else {
                    overly.classList.remove('block');
                    overly.classList.add('none');
                }
            }
        }
    }, false);

    document.addEventListener('click', function (e) {
        for (var target = e.target; target && target != this; target = target.parentNode) {
            if (target.matches('.mobile-nav .drop-down > a')) {
                e.preventDefault();
                slideToggle(target.nextElementSibling, 300);
                target.parentNode.classList.toggle('active');
            }
        }
    }, false);

} else if (document.querySelector('.mobile-nav, .mobile-nav-toggle').length) {
    document.querySelector('.mobile-nav, .mobile-nav-toggle').hide();
}

// Toggle .header-scrolled class to #header when page is scrolled

if (document.getElementById('hero')) {
    window.addEventListener('scroll', function () {
        if (document.documentElement.scrollTop > 100) {
            document.querySelector('#header').classList.add('header-scrolled');
        } else {
            document.querySelector('#header').classList.remove('header-scrolled');
        }
    });
    if (document.documentElement.scrollTop > 100) {
        document.querySelector('#header').classList.add('header-scrolled');
    }
    document.querySelector('#scroll_down').addEventListener('click', scrollDown);
} else {
    document.querySelector('section').classList.add('mt-16', 'md:mt-20');
}



function scrollDown() {
    var windowCoords = document.documentElement.clientHeight - 64;
    (function scroll() {
        if (window.pageYOffset < windowCoords) {
            window.scrollBy(0, 10);
            setTimeout(scroll, 0);
        }
        if (window.pageYOffset > windowCoords) {
            window.scrollTo({
                top: windowCoords,
                behavior: "smooth"
            });
        }
    })();
}



const slideUp = (el, duration = 300) => {
    el.style.height = el.offsetHeight + 'px';
    el.offsetHeight;
    el.style.transitionProperty = 'height, margin, padding';
    el.style.transitionDuration = duration + 'ms';
    el.style.transitionTimingFunction = 'ease';
    el.style.overflow = 'hidden';
    el.style.height = 0;
    el.style.paddingTop = 0;
    el.style.paddingBottom = 0;
    el.style.marginTop = 0;
    el.style.marginBottom = 0;
    setTimeout(() => {
        el.style.display = 'none';
        el.style.removeProperty('height');
        el.style.removeProperty('padding-top');
        el.style.removeProperty('padding-bottom');
        el.style.removeProperty('margin-top');
        el.style.removeProperty('margin-bottom');
        el.style.removeProperty('overflow');
        el.style.removeProperty('transition-duration');
        el.style.removeProperty('transition-property');
        el.style.removeProperty('transition-timing-function');
    }, duration);
};

// slideDown
const slideDown = (el, duration = 300) => {
    el.style.removeProperty('display');
    let display = window.getComputedStyle(el).display;
    if (display === 'none') {
        display = 'block';
    }
    el.style.display = display;
    let height = el.offsetHeight;
    el.style.overflow = 'hidden';
    el.style.height = 0;
    el.style.paddingTop = 0;
    el.style.paddingBottom = 0;
    el.style.marginTop = 0;
    el.style.marginBottom = 0;
    el.offsetHeight;
    el.style.transitionProperty = 'height, margin, padding';
    el.style.transitionDuration = duration + 'ms';
    el.style.transitionTimingFunction = 'ease';
    el.style.height = height + 'px';
    el.style.removeProperty('padding-top');
    el.style.removeProperty('padding-bottom');
    el.style.removeProperty('margin-top');
    el.style.removeProperty('margin-bottom');
    setTimeout(() => {
        el.style.removeProperty('height');
        el.style.removeProperty('overflow');
        el.style.removeProperty('transition-duration');
        el.style.removeProperty('transition-property');
        el.style.removeProperty('transition-timing-function');
    }, duration);
};

// slideToggle
const slideToggle = (el, duration = 300) => {
    if (window.getComputedStyle(el).display === 'none') {
        return slideDown(el, duration);
    } else {
        return slideUp(el, duration);
    }
};
