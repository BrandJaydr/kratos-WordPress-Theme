## 2025-01-24 - XSS in Bilibili Comment Metadata
**Vulnerability:** Cross-Site Scripting (XSS) via unsanitized Bilibili-related comment metadata (`uid`, `photo`, `hang`, `level`).
**Learning:** The theme allowed saving raw user input from `$_POST` and `$_REQUEST` directly into comment metadata. This data was then rendered in the frontend (avatar generation) and the WordPress admin dashboard (comment columns) without any escaping, allowing for potential malicious script injection.
**Prevention:** Always sanitize user input before saving to the database using WordPress functions like `sanitize_text_field()` and `esc_url_raw()`. When displaying stored data, use appropriate escaping functions such as `esc_html()`, `esc_attr()`, and `esc_url()` depending on the context.

## 2025-01-24 - CSRF in Administrative Settings
**Vulnerability:** Cross-Site Request Forgery (CSRF) in multiple theme options pages (Live2D, QPlayer, and External Media Import).
**Learning:** Several administrative forms and AJAX/POST handlers lacked nonce verification, allowing an attacker to potentially trick an logged-in administrator into making unintended configuration changes or executing actions.
**Prevention:** Use `wp_nonce_field()` in all administrative forms and verify the nonce on the processing side using `check_admin_referer()` for standard POST requests or `check_ajax_referer()` for AJAX requests.

## 2025-01-24 - Admin XSS in Live2D Settings
**Vulnerability:** XSS in the WordPress admin dashboard via unescaped output of stored application data in a dropdown menu.
**Learning:** Stored data, even if sanitized on input (which it wasn't previously), should always be escaped on output. Echoing data directly inside HTML attributes or as text content is a common source of XSS.
**Prevention:** Use `esc_attr()` for data inside HTML attributes and `esc_html()` for text content.
