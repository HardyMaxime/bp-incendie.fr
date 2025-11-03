import { isDefined, throttle } from './helpers';
import SplitType from "split-type";
import LocomotiveScroll from 'locomotive-scroll';

export function initAnimation() {
    initScroll();
    TextLineAppear();
}

function TextLineAppear() {
    const containerElement = document.querySelector(".line-appear");

    if (!isDefined(containerElement)) return;
    const lines = new SplitType(containerElement, {
      types: "line",
    });

    lines.lines.forEach(function (line, index) {
      if (Number(index) < 10) {
        line.style.transitionDelay = "." + index + "s";
      } else {
        line.style.transitionDelay = "." + index + "s";
      }
    });
}

function initScroll() {
    let loco = null;
    const BREAKPOINT = 768;
    const container = document.querySelector('[data-scroll-container]') || null;

    if(!isDefined(container)) return;

    const enableScroll = () => {
        if (loco) return; // déjà initialisé
        loco = new LocomotiveScroll({
            wrapper: document.querySelector('[data-scroll-container]'),
        });
        scrollAnimation();
    }

    const disableScroll = () => {
        if (!loco) return;
        loco.destroy();
        loco = null;
    };

    const initAccordingToWidth = () => {
        if (window.innerWidth >= BREAKPOINT) {
          enableScroll();
        } else {
          disableScroll();
        }
    };

    // Initialisation
    initAccordingToWidth();

    // Gestion du redimensionnement
    const handleResize = throttle(() => {
        if (window.innerWidth >= BREAKPOINT) {
          // sur desktop : init si besoin, sinon update
          if(!loco)
          {
            enableScroll();
          }
        } else {
          // sous le breakpoint : on détruit si présent
          if (loco)
          {
            disableScroll();
            loco = null;
          }
        }
    }, 250);

    // Event listener pour le resize
    window.addEventListener('resize', handleResize);
}

function scrollAnimation()
{
    window.addEventListener("progressEvent", (e) => {
        const { progress } = e.detail;
        // Limite le progress entre 1.0 et 1.2 sachant que progress est entre 0 et 1
        const limitedProgress = progress * 0.5 + 1;
        e.detail.target.style.transform = `scale(${limitedProgress})`;
    });
}
