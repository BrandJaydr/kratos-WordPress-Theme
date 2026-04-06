# Kratos Theme Translation Log (Chinese to English)

The following areas of the Kratos WordPress theme have been translated from Chinese to English, with refined grammar and localized formatting.

## 1. Core Theme Templates
- **index.php**: Translated Bilibili status indicators, navigation labels, and UI section titles.
- **header.php**: Translated SEO metadata descriptions, Bilibili redirect logic comments, and mobile menu accessibility labels.
- **footer.php**: Translated site uptime counter ("Site has been running cute..."), RSS/social labels, and Live2D model UI toolbar tooltips.
- **404.php**: Translated the 404 error message.
- **comments.php**: Translated form labels (UID, Nickname, Email, Website), placeholder text, and instructional tips for commenters.
- **single.php**: Translated post metadata, navigation links, and internal code comments for TOC logic.
- **page.php**: Translated post metadata, license information, and share/donate button labels.

## 2. Theme Configuration
- **options.php**: Fully translated the Kratos Theme Options panel. This includes section headings (Site Config, SEO, Components), option names, detailed descriptions, and default values for interactive elements.

## 3. Core Logic & Helper Functions (`inc/` directory)
- **inc/core.php**: Translated admin menu titles, sitemap titles, and search result strings.
- **inc/myfunction.php**: Translated word count labels, table of contents headers, and the subjects/bodies of automated email notifications.
- **inc/widgets.php**: Translated all custom widget titles (Advertisement, Profile, Tag Cloud, Post Tab, Comments) and their respective administrative configuration fields. Fixed date formatting logic to use standard PHP directives.
- **inc/post.php**: Translated password-protected post form strings and pagination titles.
- **inc/smtp.php**: Translated email subjects and HTML message templates for comment approvals, reply notifications, and user welcomes.
- **inc/shortcode.php**: Translated labels for custom shortcodes (e.g., Cloud Download, Reply to View) and added English labels to the TinyMCE editor integration.
- **inc/logincfg.php**: Translated all login and registration form labels, error messages, and human verification (CAPTCHA) instructions.
- **inc/imgcfg.php**: Translated the "Add from URL" media library extension and its associated validation error messages.
- **inc/avatars.php**: Translated the local avatar upload interface and troubleshooting messages.

## 4. Components & Interactive Elements
- **inc/live2d/live2d.php**: Translated the administrative interface for managing the Live2D model, including character/emoji download options and success messages.
- **inc/live2d/waifu-tips.json**: Fully translated all interactions for the Live2D model, including greetings, time-based tips, and element-specific hover messages. Refined seasonal greetings for a global audience.
- **inc/QPlayer/**: Translated all settings and UI strings for the floating music player, including Netease Music integration.
- **inc/OwO.json**: Translated the names and descriptions of all emoji categories and individual emoticons.

## 5. Page Templates (`pages/` directory)
- **pages/page-archives.php**: Translated the archive listing UI, statistics counter, and date formatting.
- **pages/page-bibo.php**: Translated the Bilibili Dynamics feed UI, including stats (Following, Fans, Plays) and video interaction buttons.
- **pages/page-link.php**: Translated the friend link application form, modal dialogs, and admin email notification templates.
- **pages/page-bilibili.php**: Translated the anime tracking progress UI.
- **pages/page-notitle.php**: Translated license declarations and interaction buttons.

## 6. CSS & JavaScript Assets
- **static/js/kratos.js**: Translated all user-facing JavaScript alerts, donation popup content, submission status bars, and the site uptime timer formatting.
- **static/css/kratos.min.css**: Translated comments and internal labels within the minified CSS.
- **pages/bilibililive/style/**: Translated comments and font-family declarations in component-specific stylesheets.

## 7. Documentation
- **README.md**: Fully translated the theme documentation, feature list, and historical update logs from Chinese to English.
- **WORDPRESS_UPDATE.md**: Updated documentation regarding WordPress 6.x and PHP 8.x compatibility.

## 8. Quality Improvements
- Fixed date formatting bugs where literal translations broke PHP `date()` logic.
- Preserved Chinese logic markers in `pages/bilibili/bilibiliAnime.php` to maintain compatibility with the Chinese Bilibili API.
- Standardized all full-width Chinese punctuation to English half-width equivalents.
- Resolved numerous grammatical errors and spacing issues (e.g., merging words without spaces).
- Standardized terminology across the theme (e.g., "Bilibili Dynamics").
