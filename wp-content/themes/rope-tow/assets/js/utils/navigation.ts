export default {
  header: document.querySelector(".navbar") as HTMLElement | null,
  menuItemsDesktop: document.querySelectorAll(".menu-primary > .menu-item-has-children") as NodeListOf<HTMLElement> | null,
  menuItemsMobile: document.querySelectorAll("ul.menu-primary-mobile li.menu-item-has-children") as NodeListOf<HTMLElement> | null,
  menuToggle: document.getElementById("menu-toggle") as HTMLElement | null,
  menuMobile: document.querySelector(".navbar-menu-mobile") as HTMLElement | null,
  init() {
    // If the header element does not exist, return
    if (!this.header) {
      return;
    }
    // Dynamically import headroom.js only when needed
    // Documentation: https://wicky.nillia.ms/headroom.js/
    import("headroom.js")
      .then(({ default: Headroom }) => {
        const headroom = new Headroom(this.header as HTMLElement);
        headroom.init();
      })
      .catch((err) => console.error("Failed to load Headroom.js", err));

    // Handling the default WordPress navigation menu
    if (this.menuItemsDesktop) {
      this.menuItemsDesktop.forEach((menuItem) => {
        menuItem.addEventListener("mouseover", (e) => {
          menuItem.classList.add("is-active");
        });
        menuItem.addEventListener("mouseleave", (e) => {
          menuItem.classList.remove("is-active");
        });
      });
    }

    if (this.menuItemsMobile) {
      this.menuItemsMobile.forEach((menuItem) => {
        menuItem.querySelector("a")?.addEventListener("click", (e) => {
          e.preventDefault();
          menuItem.classList.toggle("is-active");
          const subMenu = menuItem.querySelector(".sub-menu");
          if (subMenu) {
            subMenu.classList.toggle("is-active");
          }
        });
      });
    }

    // Menu toggle button (Hamburger button)
    if (this.menuToggle) {
      this.menuToggle.addEventListener("click", (e) => {
        e.preventDefault();
        this.menuToggle?.classList.toggle("is-active");
        this.menuMobile?.classList.toggle("is-active");
        this.header?.classList.toggle("mobile-menu-open");
        document.body.classList.toggle("menu-open");
      });
    }
  },
};
