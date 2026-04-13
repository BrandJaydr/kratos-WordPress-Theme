# Jaydr Brand's Readme

This README tracks the changes, additions, improvements, and hardening done to this forked repository. It also serves as a record for version control, error logging, and vulnerability management.

## Version and Commit History

| Commit Hash | Date | Author | Description |
| :--- | :--- | :--- | :--- |
| `2019434` | 2026-04-13 | google-labs-jules[bot] | Update WordPress (7.0) and PHP (8.5) compatibility |
| `0c32cb1` | 2026-04-12 | google-labs-jules[bot] | Document latest fork improvements and security fixes in Jaydr Brand's Readme |
| `6d02582` | 2026-04-11 | Jaydr Brand | Merge pull request #17 from BrandJaydr/fix-avatar-profile-issues-15658743060621139685 |
| `116af33` | 2026-04-11 | google-labs-jules[bot] | Implement Anime Avatar Picker and fix profile avatar issues |
| `ba41563` | 2026-04-11 | google-labs-jules[bot] | Finalize international services integration with QPlayer SoundCloud support and documentation |
| `24effb1` | 2026-04-10 | google-labs-jules[bot] | Update Jaydr Brand's Readme with History, Improvements, and Error Logs |
| `b7ac4e4` | 2026-04-10 | Jaydr Brand | Merge pull request #12 (README and Log updates) |
| `aebe761` | 2026-04-10 | Jaydr Brand | Merge pull request #15 (International services refactor) |
| `8700096` | 2026-04-10 | google-labs-jules[bot] | Finalize internationalization with hardening, caching, and documentation |
| `c167b7e` | 2026-04-10 | google-labs-jules[bot] | ⚡ Bolt: Optimize performance & 🌐 Translation: Full English localization |
| `ad8aa70` | 2026-04-10 | google-labs-jules[bot] | Fix typography issues and add global/per-page configuration options |
| `d5a6dac` | 2026-04-08 | google-labs-jules[bot] | Update JAYDR_BRAND_README.md with new commit history and compatibility improvements |
| `bc3a010` | 2026-04-07 | google-labs-jules[bot] | Overhaul documentation and bump theme version to 2.3 |
| `afc3a6a` | 2026-04-07 | google-labs-jules[bot] | Update JAYDR_BRAND_README.md and sync theme version to 2.3 |
| `bd05411` | 2026-04-06 | Jaydr Brand | Create FUNDING.yml |
| `6f2a902` | 2026-04-06 | Jaydr Brand | Merge branch 'master' into wordpress-php-compatibility-update |
| `273012e` | 2026-04-06 | Jaydr Brand | Merge branch 'master' into translate-chinese-to-english |
| `8de0284` | 2026-04-06 | google-labs-jules[bot] | Add Jaydr Brand's Readme to track fork changes and security logs |

## Improvements & Hardening

### Documentation
- **Repository Map**:
    - **Action**: Created `REPO_MAP.md`, providing a comprehensive overview of the theme's directory structure and explaining the purpose of each directory and file.
- **Theme Configuration Guide**:
    - **Action**: Created `THEME_CONFIGURATION.md`, providing a detailed reference for every theme setting, mapping configuration IDs to their functional impact in core files.
- **Translation Log**:
    - **Action**: Created `TRANSLATION_LOG.md` to track full English localization efforts across PHP, JS, and JSON configuration files.
- **International Integration Guide**:
    - **Action**: Created `INTERNATIONAL_INTEGRATION.md` to provide a user guide for configuring new services like AniList, Mastodon, and Audius.
- **Funding Configuration**:
    - **Action**: Created `.github/FUNDING.yml` to manage repository funding.

### Internationalization & Service Alternatives
- **Social & Media Integrations**:
    - **Action**: Implemented native integrations for **AniList** (Anime Tracking), **Mastodon**, **Bluesky**, and **YouTube** (Social Dynamics) as international alternatives to Bilibili.
- **Music Streaming**:
    - **Action**: Added support for **Audius**, **Jamendo**, and **SoundCloud** within QPlayer, providing region-free alternatives to Netease Music.
- **Polymorphic Feed Loader**:
    - **Action**: Refactored `pages/page-bibo.php` to dynamically switch between Bilibili, Mastodon, or YouTube feeds based on user configuration.

### Typography & UI Customization
- **Global Typography Controls**:
    - **Action**: Added a new **Typography** tab in theme options, allowing users to configure Google Fonts, font sizes, and line heights globally.
- **Per-Page Customization**:
    - **Action**: Implemented a **Page Options** meta box for posts and pages, enabling per-instance overrides for sidebar layouts and header hero visibility.

### WordPress & PHP Compatibility Modernization
- **Title Handling**:
    - **Action**: Replaced the deprecated `wp_title()` function with modern alternatives (`wp_get_document_title()` or `get_the_title()`) across `header.php` and `inc/core.php`.
- **Image Resizing**:
    - **Action**: Replaced the deprecated `image_resize()` function in `inc/avatars.php` with the modern `WP_Image_Editor` class.
- **PHP 8.5 Compatibility**:
    - **Action**: Implemented conditional `curl_close()` in `inc/myfunction.php` and `inc/QPlayer/option.php` to avoid deprecation warnings in PHP 8.5.
- **WordPress 7.0 Modernization**:
    - **Action**: Removed all legacy filters and references to `wp_title()` in `inc/core.php` to fully align with WordPress 7.0 standards.

### Anime Avatar Picker & Profile Enhancements
- **Anime Avatar Picker**:
    - **Action**: Integrated Alpha Coders API to allow users to browse and select anime avatars directly from the WordPress profile page.
- **Automated Media Library Integration**:
    - **Action**: Implemented logic to automatically download selected anime avatars to the local WordPress Media Library, ensuring persistent storage and local serving.
- **Profile Form Hardening**:
    - **Action**: Fixed an issue where local avatar uploads failed due to missing `enctype` on the profile form by utilizing the `user_edit_form_tag` hook.

### QPlayer SoundCloud Support
- **SoundCloud Integration**:
    - **Action**: Added a dedicated `[soundcloud]` shortcode and integrated SoundCloud API support into QPlayer, expanding international music streaming options.

### Performance Improvements
- **Inefficient Snow Animation and Timer**:
    - **Issue**: High-frequency animation loops and timers in `static/js/kratos.js` were causing CPU spikes due to redundant DOM operations and expensive calculations.
    - **Action**:
        - Optimized snow animation to **60fps** by hoisting DOM/attribute lookups and replacing `Math.sqrt` with squared distance comparisons.
        - Optimized the site timer by using direct function references in `setInterval` and hoisting the birth date object outside the interval.
        - Documented these patterns in `.jules/bolt.md`.

### Security Hardening
- **Neutralized Vulnerabilities**:
    - Addressed publicly accessible AJAX handlers and frontend templates lacking nonce verification and input sanitization.
    - Implemented `$wpdb->prepare()` for all dynamic database queries to prevent SQL injection.
    - Restricted sensitive PHP file operations behind capability and nonce checks.
- **External Integration Hardening**:
    - Implemented strict XSS escaping (`esc_html`, `esc_attr`, `esc_url`) for all data fetched from third-party APIs (AniList, Mastodon, YouTube).
    - Integrated **Transients API** caching for external requests to improve performance and prevent rate-limiting.

## Error & Vulnerability Log

| Date | Type | Description | Status |
| :--- | :--- | :--- | :--- |
| 2026-04-10 | UI/UX | Content bleeding off post cards on mobile | Fixed |
| 2026-04-11 | Security | Potential SSRF in Anime Avatar Picker (URL validation) | Fixed |
| 2026-04-11 | Logic Error | Profile avatar upload failing due to missing form multipart encoding | Fixed |
| 2026-04-10 | Logic Error | Post summaries unreadable due to aggressive whitespace stripping | Fixed |
| 2026-04-07 | Logic Error | Illogical word count comparison in `inc/myfunction.php` | Fixed |
| 2026-04-07 | PHP 8.x Bug | Potential null pointer/empty string access in `showSummary` | Fixed |
| 2025-01-24 | Vulnerability | Stored XSS in Bilibili Comment Metadata | Fixed |

### Illogical Word Count Comparison (2026-04-07)
- **Error**: The `count_words()` function in `inc/myfunction.php` contained illogical comparison checks that could lead to incorrect return values.
- **Fix**: Refactored the logic to ensure proper string handling and accurate word counting in modern PHP versions.
- **Prevention**: Use robust string manipulation functions and verify logic against edge cases (empty strings, special characters).

### Aggressive Whitespace Stripping (2026-04-10)
- **Error**: The `trimall()` function was being applied to post summaries, removing all spaces and making the text unreadable for English content.
- **Fix**: Removed `trimall()` from `showSummary()` in `inc/myfunction.php` to preserve natural spacing.
- **Prevention**: Do not use `trimall()` on blocks of text where readability depends on whitespace.

### UI Content Bleed (2026-04-10)
- **Error**: Long titles or URLs without break points were bleeding out of post cards on narrow viewports.
- **Fix**: Implemented `word-wrap: break-word` and adjusted padding in the theme's core CSS.
- **Prevention**: Always test responsive layouts with long, unbreakable strings.

### PHP 8.x Null/Empty String Access (2026-04-07)
- **Error**: Potential null or empty string access in `inc/myfunction.php` (e.g., `showSummary`) which could trigger warnings or errors in PHP 8.x.
- **Fix**: Added null-safe robustness checks to handle potential null or empty strings safely.
- **Prevention**: Always validate variable state before performing operations that expect specific data types (e.g., strings).

### Profile Avatar Upload Failure (2026-04-11)
- **Error**: The local avatar upload feature on the WordPress profile page was failing because the form lacked the `enctype="multipart/form-data"` attribute.
- **Fix**: Added the `user_edit_form_tag` action hook in `inc/avatars.php` to inject the correct encoding attribute into the profile form.
- **Prevention**: Always ensure forms handling file uploads have the correct `enctype` attribute set.

### Anime Avatar Picker SSRF Protection (2026-04-11)
- **Vulnerability**: Potential Server-Side Request Forgery (SSRF) when fetching external avatar images from the Alpha Coders API.
- **Fix**: Implemented strict URL validation and ensured images are processed and sanitized before being saved to the local media library.
- **Prevention**: Never trust external URLs; always validate and sanitize them before performing server-side requests.

### XSS in Bilibili Comment Metadata (2025-01-24)
- **Vulnerability**: Cross-Site Scripting (XSS) via unsanitized Bilibili-related comment metadata (`uid`, `photo`, `hang`, `level`).
- **Details**: Raw user input from `$_POST` and `$_REQUEST` was saved directly into comment metadata and rendered without escaping.
- **Fix**: Sanitize input using `sanitize_text_field()` and `esc_url_raw()`. Escape output using `esc_html()`, `esc_attr()`, and `esc_url()`.
- **Prevention**: Enforce strict input sanitization and output escaping across all metadata handling functions.

---

*Note: This file is maintained to ensure a clear record of modifications since the repository was forked.*