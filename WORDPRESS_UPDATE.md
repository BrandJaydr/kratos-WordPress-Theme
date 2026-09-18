# WordPress and PHP Update Log

This document provides information about the compatibility of the Kratos theme with the latest versions of WordPress and PHP.

## Latest Versions (as of May 2026)

- **WordPress:** 7.0 (RC3; Final release scheduled for May 20, 2026)
- **PHP:** 8.5 (Stable Support)

## Compatibility Status

The Kratos theme is fully compatible with the latest stable releases of WordPress (7.0 RC3) and PHP (8.5).

## Recent Improvements and Fixes

To ensure seamless operation on modern environments, the following updates have been implemented:

### July 2026 Update & Redundancy Analysis
- **Redundancies Analysis vs. Recent WordPress Core Updates:**
  - **WebP Support (`inc/core.php`):** Theme registers custom `upload_mimes` for `webp`. *Redundancy Note:* WordPress 5.8+ natively supports WebP image upload and processing out of the box. The theme filter remains as a safe fallback for custom mime handling.
  - **XML Sitemaps (`inc/core.php`):** Theme contains a custom static XML/HTML sitemap generator (`kratos_sitemap_refresh`). *Redundancy Note:* WordPress 5.5+ natively provides built-in XML Sitemaps (`/wp-sitemap.xml`).
  - **Document Title (`inc/core.php`):** Replaced custom `wp_title()` logic with native `add_theme_support('title-tag')`, eliminating legacy custom title filters.
  - **Site Icons / Favicon:** Theme includes options for custom site icons (`site_ico`). *Redundancy Note:* WordPress 4.3+ supports native Site Icons (`add_theme_support('site-icon')`) via the Customizer.
  - **HTML5 Markup & Custom Logo:** Added standard `add_theme_support('html5')` and `add_theme_support('custom-logo')` in `inc/core.php`.
  - **User Capabilities:** Replaced deprecated `get_currentuserinfo()` with `wp_get_current_user()` in `inc/shortcode.php` to prevent PHP/WordPress deprecation notices.

### May 2026 Update
- **English Word Count Restoration:** Fixed a regression in `inc/myfunction.php` where the `count_words()` function was incorrectly using Chinese character-counting logic. Restored the English word-counting implementation using `preg_split` and updated the output format to "X words".
- **Complete PHP 8.5 compatibility:** Extended the conditional `curl_close()` version check to all Bilibili integration files (`pages/bilibili/bilibiliAnime.php` and `pages/bilibililive/BilibiliLive.php`), ensuring site-wide suppression of deprecation warnings on PHP 8.5+.

### April 2026 Update
- **PHP 8.5 Deprecation Handling:** Conditionally executed `curl_close()` only for PHP versions earlier than 8.0 in `inc/myfunction.php` and `inc/QPlayer/option.php`. In PHP 8.0+, `CurlHandle` objects are automatically cleaned up, and `curl_close()` is a no-op that is deprecated in PHP 8.5.
- **WordPress 7.0 Modernization:** Removed all filtering and references to the deprecated `wp_title()` function in `inc/core.php`. The theme fully utilizes the `title-tag` theme support introduced in WordPress 4.1.

### November 2024 Update
- **Title Handling:** Replaced the deprecated `wp_title()` function with modern alternatives (`wp_get_document_title()` or `get_the_title()`) across `header.php` and `inc/core.php`. This aligns with the `add_theme_support('title-tag')` standard.
- **Image Resizing:** Replaced the deprecated `image_resize()` function in `inc/avatars.php` with the modern `WP_Image_Editor` class, ensuring reliable avatar processing in PHP 8.x.

### 1. Deprecated Function Modernization
- **Logic Refactoring and PHP 8.x Robustness:** Refactored the `count_words()` function in `inc/myfunction.php` to fix illogical comparison checks and ensure proper return values in modern PHP versions.
- **Null-safe Access:** Added robustness checks in `inc/myfunction.php` (e.g., `showSummary`) to handle potential null or empty strings safely in PHP 8.x.

### 2. Pre-existing Standards
- **Standard Hooks:** Confirmed `wp_body_open()` is correctly implemented in `header.php`.
- **Modern User Queries:** Verified `get_user_by()` is used for all core user retrieval operations.
- **Theme Support:** Standard `add_theme_support('title-tag')` is active in `inc/core.php`.
