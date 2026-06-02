// Runtime shape for elements that can participate in parallax.
type ParallaxItem = {
  host: HTMLElement;
  img: HTMLImageElement;
  visible: boolean;
};

export default {
  // Initialize parallax only when the environment supports and needs it.
  init(): void {
    // Respect reduced motion accessibility preference
    if (window.matchMedia?.('(prefers-reduced-motion: reduce)').matches) return;

    // Don't run on mobile
    if (window.innerWidth < 640) return;

    // Find parallax background containers
    const containers = Array.from(document.querySelectorAll<HTMLElement>('.rt-block__bg.bg-attachment-image-parallax'));
    if (!containers.length) return;

    console.log(containers);

    // Movement intensity and requestAnimationFrame lifecycle
    const speed = 200;
    let running = false;

    // Build a strict list of host/image pairs that can be animated
    const items: ParallaxItem[] = [];
    for (const container of containers) {
      const img = container.querySelector('img');
      const host = container.closest<HTMLElement>('.rt-block');

      if (!(img instanceof HTMLImageElement) || !(host instanceof HTMLElement)) {
        continue;
      }

      items.push({ host, img, visible: false });
    }

    if (!items.length) return;

    // Init the requestAnimationFrame loop based on visibility
    const ensureLoop = (): void => {
      const anyVisible = items.some(i => i.visible);
      if (anyVisible && !running) {
        running = true;
        requestAnimationFrame(tick);
      } else if (!anyVisible && running) {
        running = false;
      }
    };

    // Animate visible items by offsetting image transform from viewport center
    const tick = (): void => {
      if (!running) return;
      const vh = window.innerHeight || document.documentElement.clientHeight;
      const viewCenter = vh * 0.5;

      for (const item of items) {
        if (!item.visible) continue;
        // Get the block's position relative to the viewport
        const r = item.host.getBoundingClientRect();
        // Calculate center of the block
        const hostCenter = r.top + r.height * 0.5;
        // Move the image relative to viewport center
        const progress = (viewCenter - hostCenter) / Math.max(1, r.height);
        // Set the transform
        item.img.style.transform = `translateY(${progress * speed}px)`;
      }

      requestAnimationFrame(tick);
    };

    // Track background visibility with IntersectionObserver
    const parallaxObserver = new IntersectionObserver((entries) => {
      for (const entry of entries) {
        const item = items.find(i => i.host === entry.target);
        if (item) item.visible = entry.isIntersecting;
      }
      ensureLoop();
    }, { threshold: 0 });

    // Observe host blocks
    for (const item of items) {
      parallaxObserver.observe(item.host);
    }
  }
};
