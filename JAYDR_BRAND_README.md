# Jaydr Brand's Readme

This README tracks the changes, additions, improvements, and hardening done to this forked repository. It also serves as a record for version control, error logging, and vulnerability management.

## Version and Commit History

| Commit Hash | Date | Author | Description |
| :--- | :--- | :--- | :--- |
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
- **Funding Configuration**:
    - **Action**: Created `.github/FUNDING.yml` to manage repository funding.

### WordPress & PHP Compatibility Modernization
- **Title Handling**:
    - **Action**: Replaced the deprecated `wp_title()` function with modern alternatives (`wp_get_document_title()` or `get_the_title()`) across `header.php` and `inc/core.php`.
- **Image Resizing**:
    - **Action**: Replaced the deprecated `image_resize()` function in `inc/avatars.php` with the modern `WP_Image_Editor` class.

### Performance Improvements
- **Inefficient Snow Animation and Timer**:
    - **Issue**: The snow animation in `static/js/kratos.js` had multiple performance issues: repetitive DOM/attribute lookups in a high-frequency animation loop, expensive `Math.sqrt` calculations for every particle, and use of string-based `setInterval`.
    - **Action**: Hoisted DOM lookups, used squared distance comparison for distance checks, pre-calculated constant strings, and used function references for timers.

### Security Hardening
- **Neutralized Vulnerabilities**:
    - Addressed publicly accessible AJAX handlers and frontend templates lacking nonce verification and input sanitization.
    - Implemented `$wpdb->prepare()` for all dynamic database queries to prevent SQL injection.
    - Restricted sensitive PHP file operations behind capability and nonce checks.

## Error & Vulnerability Log

| Date | Type | Description | Status |
| :--- | :--- | :--- | :--- |
| 2026-04-07 | Logic Error | Illogical word count comparison in `inc/myfunction.php` | Fixed |
| 2026-04-07 | PHP 8.x Bug | Potential null pointer/empty string access in `showSummary` | Fixed |
| 2025-01-24 | Vulnerability | Stored XSS in Bilibili Comment Metadata | Fixed |

### Illogical Word Count Comparison (2026-04-07)
- **Error**: The `count_words()` function in `inc/myfunction.php` contained illogical comparison checks that could lead to incorrect return values.
- **Fix**: Refactored the logic to ensure proper string handling and accurate word counting in modern PHP versions.
- **Prevention**: Use robust string manipulation functions and verify logic against edge cases (empty strings, special characters).

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