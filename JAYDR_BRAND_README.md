# Jaydr Brand's Readme

This README tracks the changes, additions, improvements, and hardening done to this forked repository. It also serves as a record for error logging and vulnerability management.

## Version and Commit History

| Commit Hash | Date | Author | Description |
| :--- | :--- | :--- | :--- |
| `afc3a6a` | 2026-04-08 | google-labs-jules[bot] | Update JAYDR_BRAND_README.md and sync theme version to 2.3 |
| `bc3a010` | 2026-04-07 | google-labs-jules[bot] | Overhaul documentation and bump theme version to 2.3 |
| `bd05411` | 2026-04-06 | Jaydr Brand | Create FUNDING.yml |
| `8de0284` | 2026-04-06 | google-labs-jules[bot] | Add Jaydr Brand's Readme to track fork changes and security logs |

## Improvements & Hardening

### Documentation
- **Repository Map (2026-04-08)**:
    - Created `REPO_MAP.md`, providing a comprehensive overview of the theme's directory structure and explaining the purpose of each directory and file.
- **Theme Configuration Guide (2026-04-07)**:
    - Created `THEME_CONFIGURATION.md`, providing a detailed reference for every theme setting and mapping configuration IDs to their functional impact.
- **Translation Log (2026-04-07)**:
    - Created `TRANSLATION_LOG.md`, documenting localization from Chinese to English across templates, logic, and assets.
- **Funding Configuration (2026-04-06)**:
    - Created `.github/FUNDING.yml` to facilitate community support and sponsorship.
- **WordPress/PHP Compatibility Update (2026-04-06)**:
    - Documented modernization for WordPress 6.7+ and PHP 8.3/8.4 in `WORDPRESS_UPDATE.md`.

### Compatibility & Modernization
- **WordPress 6.7 & PHP 8.4 Support**:
    - Replaced deprecated functions:
        - `wp_title()` → `wp_get_document_title()` / `get_the_title()`
        - `image_resize()` → `WP_Image_Editor`
    - Refactored:
        - `count_words()` and related logic with null-safe handling

### Performance Improvements
- **Snow Animation Optimization**:
    - Eliminated repetitive DOM lookups
    - Replaced `Math.sqrt` with squared distance comparison
    - Converted string-based `setInterval` to function references

### Security Hardening
- **Modernization & Standards**:
    - Removed deprecated functions across core files
    - Migrated image handling to `WP_Image_Editor`
    - Hardened PHP 8.x compatibility with null-safe logic

- **Vulnerability Neutralization**:
    - **CSRF Protection**:
        - Added `check_ajax_referer` to `kratos_love`
    - **Input Sanitization**:
        - Applied `sanitize_text_field()` to metadata inputs
    - **Output Escaping**:
        - Used `esc_html()`, `esc_attr()`, `esc_url()`
    - **Access Control**:
        - Enforced `current_user_can('manage_options')`
    - **SQL Injection Prevention**:
        - Standardized `$wpdb->prepare()` for queries

## Error & Vulnerability Log

### XSS in Bilibili Comment Metadata (Identified 2025-01-24)
- **Vulnerability**: XSS via unsanitized metadata (`uid`, `photo`, `hang`, `level`)
- **Fix**:
    - Input: `sanitize_text_field()`, `esc_url_raw()`
    - Output: `esc_html()`, `esc_attr()`, `esc_url()`
- **Status**: Fixed in versions 2.3+

### CSRF in "Love" AJAX Handler (Identified 2025-02-10)
- **Vulnerability**: Missing nonce validation
- **Fix**:
    - `wp_create_nonce` + `check_ajax_referer`
- **Status**: Fixed in versions 2.3+

---

*Note: This file is maintained to ensure a clear record of modifications since the repository was forked.*