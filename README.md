# **Rope Tow**

> Rope Tow is your new favorite WordPress starter theme. Fast, modern, and flexible, Rope Tow is the perfect foundation for your next WordPress project.

<!-- ![Rope Tow](static/nylon-cover.png) -->

## **Prerequisites**

Before you start with Rope Tow, ensure you have the following setup:

- **macOS Users:** We recommend [laravel/valet](https://laravel.com/docs/master/valet) for an effortless dev environment configuration.
- A local web server: Either Apache or Nginx.
- [Node.js](https://nodejs.org/)
- [wp-cli](https://wp-cli.org/)

## **Theme Setup**

All build tooling lives inside the theme directory:

```bash
cd wp-content/themes/rope-tow
npm install
```

## **Development**

Start the Vite dev server with HMR (Hot Module Replacement):

```bash
npm run dev
```

Clone the `wp-config-sample.php` into a new `wp-config.php` file, updating the database info to match your local setup.

## **Build**

Compile and hash assets for production:

```bash
npm run build
```

Output goes to `wp-content/themes/rope-tow/dist/`. Ensure `VITE_DEV_SERVER` is **not** defined in `wp-config.php` so WordPress reads from the manifest.

