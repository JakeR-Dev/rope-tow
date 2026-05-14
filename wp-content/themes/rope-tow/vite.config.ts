import { defineConfig } from "vite";

export default defineConfig({
  server: {
    cors: true,
  },
  build: {
    outDir: "dist",
    emptyOutDir: true,
    manifest: "manifest.json",
    rollupOptions: {
      input: {
        main: "assets/js/main.ts",
        editor: "assets/js/editor.js",
      }
    }
  }
});
