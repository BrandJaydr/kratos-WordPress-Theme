# Repository Map

This document provides an overview of the directory structure and file purposes for the Kratos {English Version} theme.

## Directory Structure

- `inc/`: Contains core theme logic, custom functions, and bundled components.
  - `content-templates/`: PHP templates for different post formats in the loop.
  - `single-templates/`: PHP templates for single post/page displays.
  - `theme-options/`: The Options Framework used for theme settings.
  - `live2d/`: Assets and logic for the Live2D Waifu component.
  - `QPlayer/`: Integrated music player component.
  - `tinymce-advanced/`: TinyMCE editor enhancements.
  - `enlighter/`: Code syntax highlighting component.
- `pages/`: Custom WordPress page templates.
  - `bilibili/`: Logic for Bilibili integrations.
  - `bilibililive/`: Frontend assets and HTML for Bilibili-style pages.
- `static/`: Static assets for the theme.
  - `css/`: Stylesheets (Bootstrap, Font Awesome, theme-specific).
  - `js/`: JavaScript files (theme logic, PJAX, vendors).
  - `images/`: Theme images, icons, and default avatars.
  - `fonts/`: Web fonts.

## Key Files

- `functions.php`: Theme initialization and inclusion of core logic.
- `header.php`: Theme header template, SEO metadata, and style inclusions.
- `footer.php`: Theme footer template, site timer, and script inclusions.
- `index.php`: Main template file for the post loop and Bilibili profile.
- `options.php`: Defines all theme settings and their default values.
- `style.css`: Theme metadata and primary CSS.
- `comments.php`: Comments template.
- `static/js/kratos.js`: Primary theme JavaScript, including animations and the site timer.
