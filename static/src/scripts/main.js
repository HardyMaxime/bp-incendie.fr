import './../styles/main.scss'; 
import { triggerRevealScroll } from './partials/scroll-reveal';
import { preloadTransition } from './partials/preload-transition';
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

    //initExemple();
});