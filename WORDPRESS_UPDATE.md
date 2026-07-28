# WordPress and PHP Update Log

This document provides information about the compatibility of the Kratos theme with the latest versions of WordPress and PHP.

## Latest Versions (as of July 2026)

- **WordPress:** 7.0.2 (Released July 17, 2026)
- **PHP:** 8.5.8 (Released July 2, 2026)

## Compatibility Status

The Kratos theme is fully compatible out-of-the-box with the latest stable releases of WordPress (7.0.2) and PHP (8.5.8). No code modifications or additions are required to maintain full compatibility.

## July 2026 Stable & Security Releases Overview

### WordPress 7.0.2 Security Release

On July 17, 2026, the WordPress Core team released WordPress 7.0.2 to address critical security vulnerabilities reported via their HackerOne program:
- **`wp2shell` Unauthenticated Remote Code Execution (RCE) Chain**: A critical vulnerability chain allowing unauthenticated remote code execution. This consists of:
  - **CVE-2026-60137**: A critical SQL Injection vulnerability in the `author__not_in` parameter of `WP_Query`.
  - **CVE-2026-63030**: A high-severity REST API route desynchronization and route desequencing confusion vulnerability in the batch endpoint (`/wp-json/batch/v1`).
- **Forced Automatic Background Updates**: Due to the severe nature of the `wp2shell` vulnerability chain, WordPress.org triggered forced automatic background updates to quickly patch all installations running affected versions (6.8.x, 6.9.x, 7.0.x).

Theme validation has confirmed that the Kratos theme does not utilize any unsafe custom extensions or patterns that interfere with these core patches. It remains 100% stable, secure, and compliant.

### PHP 8.5.8 Maintenance Release

On July 2, 2026, PHP 8.5.8 was released, bringing key performance and stability fixes to the active development branch:
- **AES-WRAP-PAD Memory Corruption Fix (CVE-2026-14355)**: Resolved an OpenSSL memory corruption bug within `openssl_encrypt()` which caused random process crashes or potential arbitrary code execution.
- **Phar Directory Bypass Mitigation**: Resolved an issue with Phar directory traversal and stream parsing validation.

The theme has been tested on PHP 8.5.8 and continues to execute cleanly without any deprecation notices, warnings, or runtime errors.

## Recent Improvements and Fixes

To ensure seamless operation on modern environments, the following updates have been implemented previously:

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
