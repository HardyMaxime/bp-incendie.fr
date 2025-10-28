import { isDefined, throttle } from './helpers';

export function initNavbar() {
    const button = document.querySelector('.navbar-button') || null;
    if(!isDefined(button)) return;

    button.addEventListener('click', function(e){
        e.preventDefault();
        document.body.classList.toggle('menu-open');
    })
}