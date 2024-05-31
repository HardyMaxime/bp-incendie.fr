import { isDefined } from './helpers';

export function initCookieConsent() {
    const buttons = document.querySelectorAll('.open-cookie-consent');
    if(!isDefined(buttons)) return;
    buttons.forEach(function(obj) {
        obj.addEventListener('click', function(e)
        {
            e.preventDefault();
            openCookieConsent();
        });
    });
}

function openCookieConsent()
{
    const banner = document.querySelectorAll('.cmplz-manage-consent');
    if(!isDefined(banner)) return;
    banner.forEach(function(obj) {
        obj.click();
    });
}