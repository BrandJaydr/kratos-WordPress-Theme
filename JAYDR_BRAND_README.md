# Jaydr Brand's Readme

This README tracks the changes, additions, improvements, and hardening done to this forked repository. It also serves as a record for version control, error logging, and vulnerability management.

## Version and Commit History

| Commit Hash | Date | Author | Description |
| :--- | :--- | :--- | :--- |
| `[Current]` | 2026-04-11 | google-labs-jules[bot] | Refactor word count logic for English localization and update documentation |
| `bc3b7e4` | 2026-04-10 | Jaydr Brand | Merge pull request #16 from BrandJaydr/scribe-jaydr-brand-readme-update |
| `24effb1` | 2026-04-10 | google-labs-jules[bot] | Update Jaydr Brand's Readme with History, Improvements, and Error Logs |
| `aebe761` | 2026-04-10 | Jaydr Brand | Merge pull request #15 from BrandJaydr/international-services-refactor |
| `c167b7e` | 2026-04-10 | google-labs-jules[bot] | ⚡ Bolt: Optimize performance & 🌐 Translation: Full English localization |
| `ad8aa70` | 2026-04-10 | google-labs-jules[bot] | Fix typography issues and add global/per-page configuration options |
| `afc3a6a` | 2026-04-07 | google-labs-jules[bot] | Update JAYDR_BRAND_README.md and sync theme version to 2.3 |
| `bc3a010` | 2026-04-07 | google-labs-jules[bot] | Overhaul documentation and bump theme version to 2.3 |
| `8de0284` | 2026-04-06 | google-labs-jules[bot] | Add Jaydr Brand's Readme to track fork changes and security logs |
| `59e9a69` | 2026-04-06 | google-labs-jules[bot] | Update Kratos theme for WordPress 6.7 and PHP 8.4 compatibility |
| `3969085` | 2026-04-05 | Jaydr Brand | Merge pull request #5 (Security hardening) |
| `294a865` | 2026-04-05 | google-labs-jules[bot] | Security Hardening: Patching high-impact vulnerabilities |
| `0348eaa` | 2026-04-05 | Jaydr Brand | Merge pull request #3 (Performance optimization) |
| `55eecfe` | 2026-04-05 | Jaydr Brand | Merge pull request #2 (XSS fix) |
| `4764892` | 2026-04-05 | google-labs-jules[bot] | ⚡ Bolt: Optimize snow animation and site timer performance |
| `43f4ad9` | 2026-04-05 | google-labs-jules[bot] | 🛡️ Sentinel: [HIGH] Fix XSS vulnerability in Bilibili comment metadata |
| `912e107` | 2026-04-05 | Jaydr Brand | Merge pull request #1 (WP/PHP compatibility) |
| `5223a19` | 2026-04-05 | google-labs-jules[bot] | Further improvements for WordPress and PHP 8.x compatibility |
| `f6aa5d9` | 2026-04-05 | google-labs-jules[bot] | Update theme for WordPress 6.9.4 and PHP 8.5.4 compatibility |

## Improvements & Hardening

### Documentation
- **Repository Map**:
    - **Action**: Created `REPO_MAP.md`, providing a comprehensive overview of the theme's directory structure and explaining the purpose of each directory and file.
- **Theme Configuration Guide**:
    - **Action**: Created `THEME_CONFIGURATION.md`, providing a detailed reference for every theme setting, mapping configuration IDs to their functional impact in core files.
- **Translation Log**:
    - **Action**: Created `TRANSLATION_LOG.md` to track full English localization efforts across PHP, JS, and JSON configuration files.
- **Funding Configuration**:
    - **Action**: Created `.github/FUNDING.yml` to manage repository funding.

### Internationalization & Service Alternatives
- **Social & Media Integrations**:
    - **Action**: Implemented native integrations for **AniList** (Anime Tracking), **Mastodon**, **Bluesky**, and **YouTube** (Social Dynamics) as international alternatives to Bilibili.
- **Music Streaming**:
    - **Action**: Added support for **Audius**, **Jamendo**, and **SoundCloud** within QPlayer, providing region-free alternatives to Netease Music.
- **Anime Avatar Picker**:
    - **Action**: Integrated with **Alpha Coders API** to allow users to browse and select anime avatars directly from the theme settings. Selected avatars are automatically downloaded to the Media Library and set as the user's local avatar.
- **Polymorphic Feed Loader**:
    - **Action**: Refactored `pages/page-bibo.php` to dynamically switch between Bilibili, Mastodon, or YouTube feeds based on user configuration.

### Typography & UI Customization
- **Global Typography Controls**:
    - **Action**: Added a new **Typography** tab in theme options, allowing users to configure Google Fonts, font sizes, and line heights globally.
- **Per-Page Customization**:
    - **Action**: Implemented a **Page Options** meta box for posts and pages, enabling per-instance overrides for sidebar layouts and header hero visibility.

### WordPress & PHP Compatibility Modernization
- **WordPress 7.0 & PHP 8.5 Stable Support**:
    - **Action**: Modernized core files to ensure full compatibility with WordPress 7.0 and PHP 8.5. This includes removing all references to deprecated functions like `wp_title()` in `inc/core.php`.
    - **Note**: These fixes were specifically restored in commit `e916f1a` after being lost in a previous merge.
- **PHP 8.5 Deprecation Handling**:
    - **Action**: Implemented conditional `curl_close()` calls across the theme (e.g., in `inc/myfunction.php` and `inc/QPlayer/option.php`) to handle the deprecation of the function in PHP 8.5 and the transition to `CurlHandle` objects in PHP 8.0+.
- **Title Handling**:
    - **Action**: Replaced the deprecated `wp_title()` function with modern alternatives (`wp_get_document_title()` or `get_the_title()`) across `header.php` and `inc/core.php`.
- **Image Resizing**:
    - **Action**: Replaced the deprecated `image_resize()` function in `inc/avatars.php` with the modern `WP_Image_Editor` class.

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
| 2026-04-11 | Logic Error | Incorrect word count for English text in `inc/myfunction.php` | Fixed |
| 2026-04-10 | Logic Error | Post summaries unreadable due to aggressive whitespace stripping | Fixed |
| 2026-04-10 | UI/UX | Content bleeding off post cards on mobile | Fixed |
| 2026-04-07 | Logic Error | Illogical word count comparison in `inc/myfunction.php` | Fixed |
| 2026-04-07 | PHP 8.x Bug | Potential null pointer/empty string access in `showSummary` | Fixed |
| 2025-01-24 | Vulnerability | Stored XSS in Bilibili Comment Metadata | Fixed |

### Incorrect Word Count (2026-04-11)
- **Error**: The `count_words()` function was counting characters instead of words, which is incorrect for English content.
- **Fix**: Refactored `count_words()` to use `preg_split` for accurate English word counting and localized labels to English.
- **Prevention**: Use word-based splitting logic for non-logographic languages.

### Aggressive Whitespace Stripping (2026-04-10)
- **Error**: The `trimall()` function was being applied to post summaries in `showSummary()`, removing all spaces and making English text unreadable.
- **Fix**: Removed the `trimall()` call from the `showSummary()` pipeline to preserve natural word spacing.
- **Prevention**: Do not use "strip all whitespace" functions on text blocks where readability depends on spaces.

### Illogical Word Count Comparison (2026-04-07)
- **Error**: The `count_words()` function in `inc/myfunction.php` contained illogical comparison checks that could lead to incorrect return values.
- **Fix**: Refactored the logic to ensure proper string handling and accurate word counting in modern PHP versions.
- **Prevention**: Use robust string manipulation functions and verify logic against edge cases (empty strings, special characters).

### UI Content Bleed (2026-04-10)
- **Error**: Long titles or URLs without break points were bleeding out of post cards on narrow viewports.
- **Fix**: Implemented `word-wrap: break-word` and adjusted padding in the theme's core CSS.
- **Prevention**: Always test responsive layouts with long, unbreakable strings.

### PHP 8.x Null/Empty String Access (2026-04-07)
- **Error**: Potential null or empty string access in `inc/myfunction.php` (e.g., `showSummary`) which could trigger warnings or errors in PHP 8.x.
- **Fix**: Added null-safe robustness checks to handle potential null or empty strings safely.
- **Prevention**: Always validate variable state before performing operations that expect specific data types (e.g., strings).

### XSS in Bilibili Comment Metadata (2025-01-24)
- **Vulnerability**: Cross-Site Scripting (XSS) via unsanitized Bilibili-related comment metadata (`uid`, `photo`, `hang`, `level`).
- **Details**: Raw user input from `$_POST` and `$_REQUEST` was saved directly into comment metadata and rendered without escaping.
- **Fix**: Sanitize input using `sanitize_text_field()` and `esc_url_raw()`. Escape output using `esc_html()`, `esc_attr()`, and `esc_url()`.
- **Prevention**: Enforce strict input sanitization and output escaping across all metadata handling functions.

---

*Note: This file is maintained to ensure a clear record of modifications since the repository was forked.*
