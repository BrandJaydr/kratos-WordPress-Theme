# WordPress and PHP Compatibility Update

This document provides information about the compatibility of the Kratos theme with the latest versions of WordPress and PHP.

## Latest Versions (as of March 2026)

- **WordPress:** 6.9.4 (Stable)
- **PHP:** 8.5.4 (Stable)

## Compatibility Status

The Kratos theme has been checked for compatibility with WordPress 6.9.x and PHP 8.5.x.

## Improvements and Fixes

To ensure full compatibility with the latest versions, the following changes were made:

- **Deprecated Function Replacement:** Replaced the deprecated WordPress function `get_userdatabylogin()` with the modern `get_user_by('login', $login)`.
  - Affected files:
    - `inc/core.php`
    - `inc/logincfg.php`

These updates improve stability and ensure the theme continues to function correctly on modern WordPress installations running on recent PHP versions.
