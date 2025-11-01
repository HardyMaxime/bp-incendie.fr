import './../styles/main.scss'; 
import { triggerRevealScroll } from './partials/scroll-reveal';
import { preloadTransition } from './partials/preload-transition';
import { initCookieConsent } from './partials/cookie-consent';
import { initNavbar } from './partials/navbar';
import { initAnimation } from './partials/animation';
//import { initExemple } from './partials/exemple';

window.addEventListener('DOMContentLoaded', function() {

    if('IntersectionObserver' in window)
    {
        document.documentElement.classList.add('reveal-loaded')
        triggerRevealScroll();
    }

    setTimeout(function() {
        preloadTransition();
    }, 100);

    initCookieConsent();
    initNavbar();
    initAnimation();
    //initExemple();
});