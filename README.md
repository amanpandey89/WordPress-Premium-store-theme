# 🛍️ Premium Store - Full Site Editing WooCommerce Theme

**Premium Store** is a modern, blazing-fast, and fully customizable WordPress block theme engineered specifically for eCommerce. Built natively on the **Full Site Editing (FSE)** architecture, it offers total control over your storefront's design directly from the Gutenberg Site Editor without requiring any code modifications.

![Theme Homepage Mockup](./premium-store/screenshot.png) <!-- Note: Assuming screenshot is placed here -->

## ✨ Features

- **Full Site Editing (FSE) Native:** No clunky PHP page builders. Customize headers, footers, and page structures intuitively using the native WordPress Block Editor.
- **Deep WooCommerce Integration:** Specially crafted Block Templates for Product Archives (PLP) and Single Products (PDP) using modern block patterns instead of legacy hooks.
- **Premium Block Patterns:** Includes professionally designed patterns for:
  - Hero Sections
  - Featured & Best Selling Product Grids
  - Testimonial Sliders
  - Promotional Banners and Newsletters
- **Advanced Capabilities Framework:** Custom-built Theme Options dashboard offering:
  - Custom `<head>` and `<body>` script injection (e.g., Google Analytics).
  - Brand settings (Fallback Logos).
  - Performance toggle options (disabling default Gutenberg CSS for advanced users).
- **Marketplace Ready:** Includes RTL support (`rtl.css`), translation files (`.pot`), and One Click Demo Import (OCDI) integration pre-configured.

## 📁 Directory Structure

The repository contains both the main parent theme and a pre-configured child theme.

```text
├── premium-store/             # The main parent theme
│   ├── parts/                 # Reusable template parts (Header/Footer)
│   ├── templates/             # FSE Block HTML Templates (index, front-page, single)
│   ├── patterns/              # WordPress Block Patterns (.php)
│   ├── inc/                   # Core PHP functions (Dashboard, WC integration, OCDI)
│   ├── theme.json             # Global Styles (Color Palettes, Typography, Layouts)
│   └── functions.php          # Main theme configurations and enqueues
│
└── premium-store-child/       # Ready-to-use boilerplate Child Theme
    ├── style.css
    └── functions.php
```

## 🚀 Installation & Setup

1. **Download:** Clone or download this repository.
2. **Upload:** Navigate to your WordPress Admin Dashboard -> **Appearance > Themes > Add New** and upload the `premium-store` directory.
3. **Activate:** Activate **Premium Store** (we recommend activating the Child Theme for your own customizations).
4. **Required Plugins:** Ensure **WooCommerce** is installed and activated.
5. **Dashboard:** Navigate to **Appearance > Premium Store** to access the custom theme dashboard for script injection and brand options.

## 🛠️ Customizing the Theme

Because this is a Block Theme, you do not need to edit PHP files to change the layout.
1. Navigate to **Appearance > Editor**.
2. From here, you can modify global colors, typography, or adjust the layout of the Header, Footer, and Page Templates via `theme.json` parameters.

## 🌐 Requirements

- **WordPress:** 6.4 or higher
- **WooCommerce:** 8.0 or higher
- **PHP:** 7.4 or higher

## 📄 License

This theme is released under the GNU General Public License v2 or later. See `license.txt` inside the theme folder for details.