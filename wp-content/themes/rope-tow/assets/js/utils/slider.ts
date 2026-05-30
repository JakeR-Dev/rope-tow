import EmblaCarousel, { type EmblaCarouselType, type EmblaOptionsType } from "embla-carousel";

type SliderStyle = "single" | "double" | "triple";

// Set options for each slider style
function getOptions(style: SliderStyle): EmblaOptionsType {
  const base: EmblaOptionsType = {
    loop: false,
    align: "start",
    dragFree: true,
  };

  if (style === "single") {
    return {
      ...base,
      slidesToScroll: 1 
    };
  }

  if (style === "double") {
    return {
      ...base,
      slidesToScroll: 1
    };
  }

  return {
    ...base,
    slidesToScroll: 1  
  };
}

// If reached the end of the slider, disable button in that direction
function updateButtons(api: EmblaCarouselType, prevButton: HTMLButtonElement | null, nextButton: HTMLButtonElement | null): void {
  if (prevButton) {
    prevButton.disabled = !api.canScrollPrev();
  }

  if (nextButton) {
    nextButton.disabled = !api.canScrollNext();
  }
}

export default {
  init() {
    const sliders = document.querySelectorAll<HTMLElement>("[data-rt-slider]");

    // Make sure there are sliders present
    if (!sliders.length) {
      return;
    }

    sliders.forEach((slider) => {
      // Exit if the slider is already initialized
      if (slider.dataset.rtSliderReady === "true") {
        return;
      }

      // Get the slider container
      const viewport = slider.querySelector<HTMLElement>(".rt-slider__embla");
      if (!viewport) {
        return;
      }

      // Get the slider attributes and elements
      const style = (slider.dataset.rtSliderStyle ?? "single") as SliderStyle;
      const embla = EmblaCarousel(viewport, getOptions(style));
      const prevButton = slider.querySelector<HTMLButtonElement>("[data-rt-slider-prev]");
      const nextButton = slider.querySelector<HTMLButtonElement>("[data-rt-slider-next]");

      // Init the buttons
      prevButton?.addEventListener("click", () => embla.scrollPrev());
      nextButton?.addEventListener("click", () => embla.scrollNext());

      // Update buttons for enabled / disabled logic
      const syncButtons = () => updateButtons(embla, prevButton, nextButton);
      embla.on("select", syncButtons);
      embla.on("reInit", syncButtons);
      syncButtons();

      // Mark the slider as initialized
      slider.dataset.rtSliderReady = "true";
    });
  },
};
