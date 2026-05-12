/**
 *
 *  Main TS
 *
 *  @package rope-tow
 * 	@description Rope Tow's main TypeScript file. Add your custom JavaScript here.
 *  @since 1.0.0
 */

// Import main SCSS file
import "../scss/main.scss";
import Navigation from "./utils/navigation";

// Init main JS
document.addEventListener("DOMContentLoaded", () => {
  console.log("main.ts loaded");
  Navigation.init();
});
