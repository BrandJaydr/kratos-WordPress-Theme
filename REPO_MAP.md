# Kratos Theme Repository Map

This document provides a complete overview of the Kratos theme's directory structure and explains the purpose of each directory and key file.

---

## Root Directory
The root directory contains the core WordPress theme templates and essential documentation.

| File/Directory | Description |
| :--- | :--- |
| `404.php` | The template for displaying "404 Not Found" error pages. |
| `comments.php` | Handles the display and processing of the comments section. |
| `footer.php` | The theme's footer template. Includes social icons, site info, and snowflake/Live2D scripts. |
| `functions.php` | The main theme engine. It loads core logic and external components from the `inc/` directory. |
| `header.php` | The theme's header template. Manages SEO metadata, navigation, and the Bibo layout toggle. |
| `index.php` | The primary template for the blog post index and archive loops. |
| `options.php` | Defines all theme settings (tabs and fields) used in the admin configuration panel. |
| `page.php` | The default template for static WordPress pages. |
| `single.php` | The template for displaying individual blog posts. |
| `style.css` | The main stylesheet. Also contains theme metadata (Version, Author, etc.). |
| `inc/` | **Directory:** Contains core theme logic, functional components, and integrated "plugins". |
| `pages/` | **Directory:** Custom page templates for archives, links, Bilibili tracking, and more. |
| `static/` | **Directory:** Static assets including CSS, JavaScript, fonts, and images. |
| `README.md` | General theme information, features, and historical update logs. |
| `THEME_CONFIGURATION.md` | Detailed guide explaining every setting in the theme options panel. |
| `JAYDR_BRAND_README.md` | Record of changes, hardening, and performance improvements for this fork. |
| `WORDPRESS_UPDATE.md` | Compatibility notes for modern WordPress (6.7+) and PHP (8.3+) environments. |
| `SERVICE_ALTERNATIVES.md` | Analysis and recommendations for internationalizing theme services. |
| `INTERNATIONAL_INTEGRATION.md`| User guide for configuring international alternatives for theme services. |
| `screenshot.png` | The theme's preview image shown in the WordPress admin panel. |

---

## `inc/` - Core Logic & Components
This directory houses the functional "guts" of the theme, organized into logical modules.

| Module/File | Description |
| :--- | :--- |
| `QPlayer/` | An integrated, customizable background music player component. |
| `enlighter/` | The EnlighterJS component used for advanced, beautiful code highlighting. |
| `live2d/` | Logic and assets for the "Waifu" (Live2D) animated character feature. |
| `theme-options/` | The underlying framework that powers the theme's settings panel. |
| `tinymce-advanced/` | Enhancements for the WordPress Classic Editor (TinyMCE). |
| `anilist.php` | **New:** Integration with the AniList GraphQL API for anime tracking. |
| `mastodon.php` | **New:** Integration with the Mastodon API for social dynamic feeds. |
| `youtube.php` | **New:** Integration with the YouTube API for latest video updates. |
| `bluesky.php` | **New:** Integration with the Bluesky public API for social posts. |
| `avatars.php` | Manages local avatar uploads and Gravatar server mirrors. |
| `core.php` | Theme initialization, script/style enqueuing, and sitemap generation logic. |
| `imgcfg.php` | Handles homepage banners (carousels) and post thumbnail logic. |
| `myfunction.php` | A collection of utility functions (word counts, category filters, email alerts). |
| `post.php` | Logic for post view counts, the "Love" (like) button, and password protection. |
| `share.php` | Implementation of social media sharing buttons. |
| `shortcode.php` | Definitions for custom shortcodes used in the post editor. |
| `smtp.php` | Custom SMTP mailer configuration for reliable email delivery. |
| `ua.php` | Parses and displays user browser and OS icons in the comment section. |
| `widgets.php` | Definitions for custom sidebar widgets (e.g., about me, social links). |
| `OwO.json` | Configuration data for the "OwO" emoticon picker. |
| `buttons/` | **Directory:** JavaScript and assets for custom editor buttons (shortcodes). |
| `content-templates/` | **Directory:** Modular templates for different post formats (Standard, Status/Diary). |
| `single-templates/` | **Directory:** Templates for individual post views based on format. |

---

## `pages/` - Custom Templates
Specific layouts for unique site features.

- `page-bibo.php`: A template that mimics the Bilibili "Dynamic" (Bibo) wall layout. Now supports Mastodon, YouTube, and Bluesky.
- `page-mastodon.php`: **New:** Layout for displaying Mastodon status feeds.
- `page-youtube.php`: **New:** Layout for displaying latest YouTube uploads.
- `page-bluesky.php`: **New:** Layout for displaying Bluesky social feeds.
- `page-bilibili.php`: Displays anime watch progress. Supports both Bilibili and AniList.
- `page-archives.php`: A comprehensive site archive/history page.
- `page-link.php`: A dedicated "Links" or "Blogroll" page for sharing friends' sites.
- `page-notitle.php`: A simple page template that hides the page title.

---

## `static/` - Theme Assets
Organization of non-PHP assets.

- **`css/`**: Contains Bootstrap, Animate.css, Prism.js styles, and custom login styling.
- **`fonts/`**: Houses the Font Awesome icon font files.
- **`js/`**: Core JavaScript files:
    - `kratos.js`: Primary theme logic and event handlers.
    - `pjax.js`: Handles fast, no-refresh page transitions.
    - `prism.js`: Lightweight code highlighting for the frontend.
    - `wow.min.js`: Triggers CSS animations on scroll.
    - `weixinAudio.js`: Audio player library used for WeChat-style voice posts.
- **`images/`**:
    - `avatar/`: Default random avatars for users.
    - `smilies/`: Emoticon assets for the comment section.
    - `ua/`: Icons representing various browsers and operating systems.
    - `thumb/`: Fallback images used when a post lacks a featured image.
    - `cursor.cur`: Custom themed mouse cursors.
    - `sticky.png`: "TOP" icon shown on sticky posts.
    - `fingerprint.png`: Graphic used on password-protected post pages.
