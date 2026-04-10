# Jaydr Brand's Readme

This README tracks the changes, additions, improvements, and hardening done to this forked repository. It also serves as a record for error logging and vulnerability management.

## Version and Commit History

| Commit Hash | Date | Author | Description |
| :--- | :--- | :--- | :--- |
| `bd05411` | 2026-04-06 | Jaydr Brand | Create FUNDING.yml |
| `bc3a010` | 2026-04-07 | google-labs-jules[bot] | Overhaul documentation and bump theme version to 2.3 |
| `8de0284` | 2026-04-06 | google-labs-jules[bot] | Add Jaydr Brand's Readme to track fork changes and security logs |

## Improvements & Hardening

### Documentation
- **Repository Map (`REPO_MAP.md`)**:
    - Provides a comprehensive overview of the theme's directory structure and explains the purpose of each directory and file.
- **Theme Configuration Guide (`THEME_CONFIGURATION.md`)**:
    - A detailed reference for every theme setting, mapping configuration IDs to their functional impact.
- **Translation Log (`TRANSLATION_LOG.md`)**:
    - Comprehensive record of the localization process from Chinese to English across templates, logic, and assets.
- **WordPress/PHP Compatibility Update (`WORDPRESS_UPDATE.md`)**:
    - Documentation for ensuring compatibility with WordPress 6.7+ and PHP 8.3/8.4, including modernization of deprecated functions.

### Performance Improvements
- **Inefficient Snow Animation and Timer**:
    - **Issue**: The snow animation in `static/js/kratos.js` had multiple performance issues: repetitive DOM/attribute lookups in a high-frequency animation loop, expensive `Math.sqrt` calculations, and string-based `setInterval`.
    - **Action**: Hoisted DOM lookups, implemented squared distance comparison to avoid expensive square root calls, and converted string-based timers to function references.

### Security Hardening
- **Modernization & Standards**:
    - **Deprecated Function Removal**: Replaced `wp_title()` with `wp_get_document_title()` in `header.php` and `inc/core.php`.
    - **Image Processing**: Migrated from deprecated `image_resize()` to the `WP_Image_Editor` class in `inc/avatars.php`.
    - **PHP 8.x Robustness**: Refactored `count_words()` and `showSummary()` in `inc/myfunction.php` to handle null/empty strings safely in modern PHP versions.
- **Vulnerability Neutralization**:
    - **AJAX Nonce Verification**: Implemented `check_ajax_referer` in `kratos_love` (`inc/post.php`) to prevent CSRF.
    - **Input Sanitization**: Ensured Bilibili-related metadata is sanitized with `sanitize_text_field()` before storage.
    - **Output Escaping**: Applied `esc_html()`, `esc_attr()`, and `esc_url()` to all metadata rendered in frontend/admin templates.
    - **Capability Checks**: Restricted administrative functions behind strict `current_user_can('manage_options')` checks.
    - **SQL Injection Prevention**: All dynamic database queries now utilize `$wpdb->prepare()`.

## Error & Vulnerability Log

### XSS in Bilibili Comment Metadata (Identified 2025-01-24)
- **Vulnerability**: Cross-Site Scripting (XSS) via unsanitized Bilibili-related comment metadata (`uid`, `photo`, `hang`, `level`).
- **Details**: Raw user input from `$_POST` was saved directly into comment metadata and rendered without escaping.
- **Fix**: Sanitize inputs with `sanitize_text_field()` and `esc_url_raw()`. Escape outputs with `esc_html()`, `esc_attr()`, and `esc_url()`.
- **Status**: Fixed in versions 2.3+.

### CSRF in "Love" AJAX Handler (Identified 2025-02-10)
- **Vulnerability**: Cross-Site Request Forgery (CSRF) in the `kratos_love` AJAX handler.
- **Details**: The handler lacked a nonce check, allowing unauthorized "likes" to be triggered.
- **Fix**: Added `wp_create_nonce` in `inc/core.php` and verified it using `check_ajax_referer` in `inc/post.php`.
- **Status**: Fixed in versions 2.3+.

---
*Note: This file is maintained to ensure a clear record of modifications since the repository was forked.*
