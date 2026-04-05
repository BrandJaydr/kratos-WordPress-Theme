## 2025-01-24 - XSS in Bilibili Comment Metadata
**Vulnerability:** Cross-Site Scripting (XSS) via unsanitized Bilibili-related comment metadata (`uid`, `photo`, `hang`, `level`).
**Learning:** The theme allowed saving raw user input from `$_POST` and `$_REQUEST` directly into comment metadata. This data was then rendered in the frontend (avatar generation) and the WordPress admin dashboard (comment columns) without any escaping, allowing for potential malicious script injection.
**Prevention:** Always sanitize user input before saving to the database using WordPress functions like `sanitize_text_field()` and `esc_url_raw()`. When displaying stored data, use appropriate escaping functions such as `esc_html()`, `esc_attr()`, and `esc_url()` depending on the context.
