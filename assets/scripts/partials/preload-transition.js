import { isDefined } from './helpers';

export function preloadTransition() {
    let node = document.querySelector('.preload-transitions');
    if(!isDefined(node)) return;
    node.classList.remove('preload-transitions');
}