# WordPress and PHP Update Log

This document provides information about the compatibility of the Kratos theme with the latest versions of WordPress and PHP.

## Latest Versions (as of July 2026)

- **WordPress:** 7.0.2 (Released on July 17, 2026)
- **PHP:** 8.5.8 (Released on July 2, 2026)

## Compatibility Status

The Kratos theme is fully compatible with the latest stable releases of WordPress (7.0.2) and PHP (8.5.8).

Because of the extensive modernization and proactive security hardening implemented in prior cycles, the Kratos theme continues to operate perfectly with WordPress 7.0.2 and PHP 8.5.8 out of the box without any code alterations.

## About WordPress 7.0.2

WordPress 7.0.2 is an emergency security release containing critical security updates:
- **Facilitated SQL Injection Patch:** Addresses a team-reported SQL injection vulnerability (CVE-2026-60137 / GHSA-fpp7-x2x2-2mjf).
- **REST API Batch-Route Confusion and SQL Injection (RCE) Patch:** Addresses a critical vulnerability (CVE-2026-63030 / GHSA-ff9f-jf42-662q) reported by Adam Kues that could lead to Remote Code Execution via unauthenticated REST API requests.

### Theme Preparedness
- **SQLi Defense:** The Kratos theme had already transitioned to utilizing `$wpdb->prepare()` across all dynamic query execution points (such as `inc/shortcode.php`, `inc/widgets.php`, and `inc/myfunction.php`). Because we adhere to strict Zero-Trust input validation, no code modifications were necessary to ensure the theme is robust against such SQL injection vectors.
- **REST API and Routing:** No custom unauthenticated REST API routes are registered in the theme that utilize dynamic query building without preparation or nonce validations.

## About PHP 8.5.8

PHP 8.5.8 is a maintenance and security release:
- **`CurlHandle` and `curl_close()` Deprecation Support:** Prior updates to Kratos specifically added conditional logic to only execute `curl_close()` on PHP versions below 8.0, avoiding deprecation notices on PHP 8.5.8.
- **Null Safety and Strict Types:** The core theme files are fully hardened against PHP 8.5+ strict checks. Restored word-counting and layout utilities are robust against potential null pointer dereferences.

## Recent Improvements and Fixes

To ensure seamless operation on modern environments, the following updates have been implemented in previous releases:

### July 2026 Update
- **Red Ranger July Audit:** Fortified `inc/shortcode.php`, `inc/widgets.php`, and `inc/myfunction.php` using `$wpdb->prepare()` for all dynamic queries.
- **CSRF & Access Control:** Implemented `check_admin_referer('kratos_admin_options-update')` and `current_user_can('manage_options')` across all admin forms in `inc/live2d/live2d.php` and `pages/page-link.php`.
- **WordPress API Modernization:** Replaced deprecated `get_currentuserinfo()` with `wp_get_current_user()` and modernized legacy `bloginfo()`/`get_bloginfo()` calls to `home_url()` and `get_template_directory_uri()` throughout the theme.
- **PHP 8.5.8 Compatibility:** Finalized compatibility for PHP 8.5.8, including robust error handling for `CurlHandle` and suppressed deprecation warnings.

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
