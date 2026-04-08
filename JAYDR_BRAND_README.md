# Jaydr Brand's Readme

This README tracks the changes, additions, improvements, and hardening done to this forked repository. It also serves as a record for error logging and vulnerability management.

## Version and Commit History

| Commit Hash | Date | Author | Description |
| :--- | :--- | :--- | :--- |
| `afc3a6a` | 2026-04-08 | google-labs-jules[bot] | Update JAYDR_BRAND_README.md and sync theme version to 2.3 |
| `bd05411` | 2026-04-06 | Jaydr Brand | Create FUNDING.yml |
| `bc3a010` | 2026-04-06 | google-labs-jules[bot] | Overhaul documentation and bump theme version to 2.3 |
| `8de0284` | 2026-04-05 | google-labs-jules[bot] | Add Jaydr Brand's Readme to track fork changes and security logs |

## Improvements & Hardening

### Documentation
- **Repository Map (2026-04-08)**:
    - **Action**: Created `REPO_MAP.md`, providing a comprehensive overview of the theme's directory structure and explains the purpose of each directory and file.
- **Theme Configuration Guide (2026-04-07)**:
    - **Action**: Created `THEME_CONFIGURATION.md`, providing a detailed reference for every theme setting, mapping configuration IDs to their functional impact in core files.
- **Funding Configuration (2026-04-06)**:
    - **Action**: Created `.github/FUNDING.yml` to facilitate community support and sponsorship.

### Compatibility & Modernization
- **WordPress 6.7 & PHP 8.4 Support (2026-04-06)**:
    - **Action**: Modernized deprecated functions and refactored logic for modern environments.
    - **Details**:
        - Replaced `wp_title()` with `wp_get_document_title()` or `get_the_title()`.
        - Replaced `image_resize()` with `WP_Image_Editor`.
        - Refactored `count_words()` and added null-safe checks in `inc/myfunction.php`.
    - **Reference**: See `WORDPRESS_UPDATE.md` for full details.

### Performance Improvements
- **Inefficient Snow Animation and Timer (2025-05-14)**:
    - **Issue**: The snow animation in `static/js/kratos.js` had multiple performance issues: repetitive DOM/attribute lookups in a high-frequency animation loop, expensive `Math.sqrt` calculations for every particle, and use of string-based `setInterval`.
    - **Action**: Hoisted DOM lookups, used squared distance comparison for distance checks, pre-calculated constant strings, and used function references for timers.

### Security Hardening
- **Neutralized Vulnerabilities**:
    - Addressed publicly accessible AJAX handlers and frontend templates lacking nonce verification and input sanitization.
    - Replaced deprecated WordPress and PHP functions with modern, secure alternatives.
    - Implemented `$wpdb->prepare()` for all dynamic database queries to prevent SQL injection.
    - Restricted sensitive PHP file operations behind capability and nonce checks.

## Error & Vulnerability Log

### XSS in Bilibili Comment Metadata (2025-01-24)
- **Vulnerability**: Cross-Site Scripting (XSS) via unsanitized Bilibili-related comment metadata (`uid`, `photo`, `hang`, `level`).
- **Details**: The theme allowed saving raw user input from `$_POST` and `$_REQUEST` directly into comment metadata. This data was then rendered in the frontend and admin dashboard without escaping.
- **Fix**: Always sanitize user input before saving to the database using `sanitize_text_field()` and `esc_url_raw()`. When displaying stored data, use `esc_html()`, `esc_attr()`, and `esc_url()`.
- **Prevention**: Enforce input sanitization and output escaping across all metadata handling functions.

---
*Note: This file is maintained to ensure a clear record of modifications since the repository was forked.*
