# Jaydr Brand's Readme

This README tracks the changes, additions, improvements, and hardening done to this forked repository. It also serves as a record for error logging and vulnerability management.

## Version and Commit History

| Commit Hash | Date | Author | Description |
| :--- | :--- | :--- | :--- |
| `d2f1a9c` | 2026-04-07 | google-labs-jules[bot] | Create comprehensive Theme Configuration document |
| `59e9a69` | 2026-04-06 | google-labs-jules[bot] | Update Kratos theme for WordPress 6.7 and PHP 8.4 compatibility |
| `3969085` | 2026-04-05 | Jaydr Brand | Merge pull request #5 from BrandJaydr/security-hardening-patch |

## Improvements & Hardening

### Documentation
- **Theme Configuration Guide (2026-04-07)**:
    - **Action**: Created `THEME_CONFIGURATION.md`, providing a detailed reference for every theme setting, mapping configuration IDs to their functional impact in core files.

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
