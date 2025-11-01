import { isDefined, throttle } from './helpers';
import SplitType from "split-type";

export function initAnimation() {
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
