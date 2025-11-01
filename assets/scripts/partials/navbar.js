import { isDefined, throttle } from './helpers';

export function initNavbar() {

    pageScrolled();

    const button = document.querySelector('.navbar-button') || null;
    if(!isDefined(button)) return;

    button.addEventListener('click', function(e){
        e.preventDefault();
        document.body.classList.toggle('menu-open');
    })
}

function pageScrolled()
{
    const gap = 100; // tu peux ajuster cette valeur selon ton besoin (en pixels)

    window.addEventListener('scroll', () => {
        if (window.scrollY > gap) {
            document.body.classList.add('scrolled');
        } else {
            document.body.classList.remove('scrolled');
        }
    });
}