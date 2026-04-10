# Kratos Theme Configuration Document

This document provides a comprehensive guide to the Kratos theme settings. It outlines each configuration tab, the purpose of every field, and where these changes take effect within the theme.

---

## 1. Site Configuration (站点配置)
This tab governs the foundational settings and global appearance of your website.

| Field Name | ID | Type | Purpose & Function | Implementation Details | Suggestions |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Site Icon** | `site_ico` | Upload | Sets the favicon (browser tab icon). | Applied in `header.php` via `<link rel="icon">`. | Use a 32x32px or 64x64px PNG/ICO. |
| **Gravatar Server** | `gravatar_url` | Text | Sets a custom Gravatar mirror. | Used in `inc/avatars.php` to replace standard Gravatar URLs. | Useful for users in China where Gravatar is often slow. |
| **PJAX** | `page_pjax` | Checkbox | Enables fast page loading without full refreshes. | Loads `static/js/pjax.js` and handles AJAX page swaps. | Enable if using the background music player to prevent audio gaps. |
| **Sitemap** | `sitemap` | Checkbox | Generates XML and HTML sitemaps for SEO. | Triggers `kratos_sitemap_refresh()` on post publish/edit. | Requires write permissions for the WordPress root directory. |
| **Background Type** | `background_mode` | Select | Choose the site's background style. | Swaps between CSS color/image logic in `header.php`. | 'Image' provides a more immersive Anime-style look. |
| **Background Color** | `background_index_color`| Color | Site background color for 'Pure Color' mode. | Applied via inline style on `#kratos-blog-post`. | Use a subtle color like `#f5f5f5`. |
| **Background Image** | `background_index_image`| Upload | Site background image for 'Image' mode. | Applied as a fixed background on `.theme-bg`. | Use a high-quality 1920x1080px image. |
| **Mobile Background** | `openphoneimg` | Checkbox | Toggle a separate mobile background. | Activates a `@media` query in `header.php`. | Keep disabled unless you have a portrait-specific image. |
| **Mobile Background Image**| `phone_img` | Upload | Background image for mobile devices. | Applied on mobile screens when `openphoneimg` is active. | Use a vertical/portrait image for best fit. |
| **Homepage Layout** | `home_side_bar` | Images | Choose the sidebar position for the home. | Changes grid classes in `index.php`. | 'Right Sidebar' is the most common for blogs. |
| **Post List Layout** | `list_layout` | Images | Choose the style of the post archive. | Influences `inc/content-templates/content.php`. | 'New Layout' uses large images and a modern card style. |
| **Excerpt Length** | `w_num` | Text | Number of characters in post summaries. | Used by `showSummary()` in `inc/myfunction.php`. | 110 is standard for Chinese; use 40-60 for English. |
| **Category/Tag Info** | `show_head_cat/tag`| Checkbox | Show titles at top of archive pages. | Injected into `index.php` archive headers. | Good for UX; helps users know where they are. |
| **Local Avatar** | `lo_ava` | Checkbox | Let users upload avatars to your server. | Adds an upload field to the User Profile page. | Disable if you want to save server disk space. |
| **Gutenberg** | `use_gutenberg` | Checkbox | Toggle the new Block Editor. | If disabled, removes block styles and forces Classic Editor. | Enable if you prefer the modern block-based writing. |
| **Sticky Sidebar** | `site_sa` | Checkbox | Fixes sidebar position during scroll. | Managed by `sidebaraffix` in `static/js/kratos.js`. | Highly recommended for long pages to keep widgets visible. |
| **Comment UA** | `comment_ua` | Checkbox | Display commenter's browser/OS. | Injected into comments via `inc/ua.php`. | Adds a techy feel to the comment section. |
| **Copy Notice** | `copy_notice` | Checkbox | Alert on text copy. | Handled by a listener in `static/js/kratos.js`. | Can be annoying; use only if content protection is vital. |
| **Page Pseudo-static** | `page_html` | Checkbox | Adds `.html` to Page URLs. | Modifies rewrite rules in `inc/core.php`. | Optional; purely for URL aesthetics. |

---

## 2. Component Configuration (组件配置)
Manage external resources and custom code snippets.

| Field Name | ID | Purpose & Function | Implementation |
| :--- | :--- | :--- | :--- |
| **Custom Font Awesome**| `fa_url` | Use a specific CDN for icons. | Replaces local FA link in `inc/core.php`. |
| **Custom jQuery** | `jq_url` | Use a specific CDN for jQuery. | Replaces local jQuery link in `inc/core.php`. |
| **Additional JS** | `add_script`| Inject custom JavaScript into footer. | Printed at the bottom of `footer.php`. **Caution:** Don't include `<script>` tags. |
| **Additional CSS** | `add_css` | Inject custom CSS into header. | Printed in the `<style>` block in `header.php`. |
| **Featured Image** | `default_image` | Fallback image for post lists. | Used when a post has no featured image in 'New Layout'. |
| **WeChat Button** | `cd_weixin` | Show/Hide WeChat QR toggle. | Injected into the floating tool menu in `footer.php`. |
| **QR Codes** | `weixin_image`, `alipayqr_url`, `wechatpayqr_url` | Assets for social/donations. | Displayed in modals/pop-ups when clicking Donate/WeChat. |

---

## 3. SEO Configuration (SEO配置)
Basic SEO metadata for the homepage.

- **Keywords** (`site_keywords`): Meta keywords for the index page. Used in `header.php`.
- **Description** (`site_description`): Meta description for search engines. Used in `header.php`.
- **Statistics** (`script_tongji`): Analytics code (Baidu/Google). Injected in `footer.php`. **Note:** Script tags are added automatically by the theme.

---

## 4. Header Configuration (顶部配置)
Customize the navigation area and the hero banner.

- **Display Mode** (`head_mode`): Switch between a full-width **Image** (pic) banner or a simple **Pure Color** (color) nav bar.
- **Header Image** (`background_image`): Background for the hero section in 'Image' mode.
- **Header Text** (`background_image_text1/2`): Main title and subtitle displayed over the hero image.
- **Mobile Menu** (`mobi_mode`): Choose if the mobile menu appears at the 'Top' or slides in from the 'Side'.
- **Nav Color** (`banner_color`): Background color of the nav bar in RGBA (default: `22,23,26,.9`).
- **Logo Image** (`banner_logo`): Replaces site name with an image logo (Max 40px height).

---

## 5. Footer Configuration (底部配置)
Site info and social media presence.

- **Creation Time** (`createtime`): Format `MM/DD/YYYY hh:mm:ss`. Used for the "Running time" counter in `footer.php`.
- **Social IDs**: Links to GitHub, Weibo, Twitter, Bilibili, etc. Displayed as icons in the footer.
- **Registration Info**: ICP (`icp_num`) and Public Security (`gov_num`) IDs for legal compliance in China.

---

## 6. Article & Page Settings (文章/页面设置)
Layout and feature toggles for individual posts and static pages.

- **Layout** (`side_bar` / `page_side_bar`): Choose sidebar position (Left, Center, Right) independently.
- **Copyright** (`post_cc`/`page_cc`): Toggles the "CC BY-SA 4.0" license box below content.
- **Share/Donate**: Toggles social sharing buttons and the donation modal.

---

## 7. Carousel Settings (轮播设置)
Manage the homepage slideshow.

- **Switch** (`kratos_banner`): Must be enabled for the carousel to appear.
- **Slides (1-5)**: Upload images (750px+ width recommended) and optional destination URLs.
- **Function**: Implemented in `inc/imgcfg.php` using Bootstrap Carousel. Clears cache on save.

---

## 8. Email Settings (邮件设置)
Configure SMTP for outgoing system emails.

- **Function**: Custom SMTP implementation in `inc/smtp.php`. Ensures emails (notifications, registration) are delivered reliably.
- **Secure Setting**: Use `ssl` for standard encrypted SMTP or `STARTTLS` for Office 365.

---

## 9. Snowflake Settings (雪花设置)
Adds a visual "falling snow" effect to the background.

- **Interactivity**: You can control the count, size, speed, and "repulsion" distance from the mouse pointer (`snow_xb2016_mindist`).
- **Implementation**: Canvas-based animation in `static/js/kratos.js`.
- **Suggestion**: Keep flake count around 150 to maintain performance.

---

## 10. Registration & Login (注册登录设置)
Hardens and brands the WordPress login experience.

- **Branding**: Custom background (`login_bak`) and logo (`login_logo`) for the login page via `inc/logincfg.php`.
- **Security**:
    - **Login Limit**: Brute-force protection. Locks IPs after `allowed_retries` failures.
    - **Email Restrictions**: Whitelist or Blacklist specific email domains for registration.

---

## 11. Other Settings (其他设置)
Toggles for functional extensions and interactive features.

- **Plugins**: Enable/Disable bundled QPlayer (Music), TinyMCE (Editor), and Enlighter (Code Highlight).
- **Live2D**:
    - **Toggle** (`openlive2d`): Show the animated "Waifu" character.
    - **Position** (`wifuside`): CSS-like positioning (e.g., `left:30`).
    - **Side Switch** (`wifuchange`): If enabled, flips the Live2D character to the opposite side on post pages.
- **Interactivity**:
    - **Entrance Animation** (`animal_load`): Enables WOW.js/Animate.css effects as elements enter the viewport.
    - **Tab Title**: Changes browser tab title when user leaves (`title_change`) and returns (`title_back`).
    - **Click Content**: Comma-separated quoted strings (e.g., `"Wow", "Cool"`) that pop up on mouse clicks.
- **International Service Integration**:
    - `anilist_username`: Used for international anime tracking (overrides Bilibili settings).
- **Bilibili Integration**:
    - `bilibili_uid`: Used in Bibo layout to show follower/play stats.
    - `bilibili_cookie`: Required for fetching advanced Bilibili data.
- **Homepage Filter** (`filter`): Use category IDs with minus signs to exclude (e.g., `-1,-5`).

---

## 12. Social Dynamics Settings (动态界面设置)
A specialized layout mode that supports Bilibili, Mastodon, YouTube, and Bluesky.

- **Enable Social Dynamics**: Toggles the overall style switch button in the footer.
- **Mastodon Instance URL** (`mastodon_instance`): e.g., `mastodon.social`. Used for the Mastodon dynamics feed.
- **Mastodon User ID** (`mastodon_user_id`): Numeric ID of your Mastodon account.
- **YouTube API Key** (`youtube_api_key`): Required for YouTube Dynamics.
- **YouTube Channel ID** (`youtube_channel_id`): Your unique YouTube Channel ID.
- **Bluesky Handle** (`bluesky_handle`): e.g., `user.bsky.social`. Used for the Bluesky dynamics feed.
- **Dynamics Page URL** (`bibo_pagelink`): Link to the page using the Dynamics template.
- **Direct Jump** (`bibo_gotobibo`): Automatically defaults the homepage to the Dynamics layout if a link is provided.
- **Implementation**: Managed via a `goto_bibo` cookie and polymorphic template logic in `pages/page-bibo.php`.
