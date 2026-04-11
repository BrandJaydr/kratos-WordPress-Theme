# Service Alternatives & Internationalization Guide

This document analyzes the original intent of the Chinese-specific services integrated into the Kratos theme and provides recommendations for US/International alternatives with open APIs.

---

## 1. Synopsis: Original Intent of Bilibili & Netease

The theme was originally designed to serve as a **Personal Creator Hub** for individuals in the ACG (Anime, Comic, Games) community, specifically within the Chinese internet ecosystem.

### Bilibili Integration (`pages/page-bilibili.php`, `pages/page-bibo.php`)
*   **Social Synchronization:** The "Bibo" (Dynamics) layout mimics a social media wall. Its goal is to allow creators to showcase their latest social activity, video uploads, and community interactions directly on their blog.
*   **Engagement & Transparency:** The Anime Tracking feature communicates the author's personality and shared interests with their audience by showing real-time watching progress.
*   **Status Indicators:** Platform-specific badges (VIP, Level, Authentication) serve as "social proof" for content creators on Bilibili.

### Netease Music Integration (`inc/QPlayer/`)
*   **Atmospheric Experience:** Designed to pull music metadata and streaming URLs to provide an immersive background audio experience.
*   **Ease of Management:** Creators can manage their site's playlist simply by adding song or album IDs in the WordPress dashboard.

---

## 2. Recommended Regionally Friendly Alternatives

To improve the theme for US/International audiences, we recommend transitioning to services that prioritize developer openness and have strong presence in Western tech/anime communities.

### 🎵 Music Streaming (QPlayer Replacement)
| Service | Recommended For | API Type | Reason |
| :--- | :--- | :--- | :--- |
| **Audius** | **Primary Choice** | Open REST | **Completely decentralized & open.** No API key required for public data. Provides direct streamable MP3 URLs. |
| **Jamendo** | CC Background Music | REST | Massive catalog of royalty-free music. Very stable and well-documented API. |
| **SoundCloud** | Indie Creators | OAuth | Large international community, though API access for new developers can be restrictive. |

### 📺 Anime Tracking (Anime List Replacement)
| Service | Recommended For | API Type | Reason |
| :--- | :--- | :--- | :--- |
| **AniList** | **Primary Choice** | **GraphQL** | Modern, fast, and extremely developer-friendly. Provides structured numeric progress (e.g., `5/12`) without needing brittle string parsing. |
| **Simkl** | Cross-Media Tracking | REST | Tracks Anime, TV, and Movies. Useful if the creator's interests extend beyond Japanese animation. |
| **MyAnimeList** | Community Size | REST | Largest database, but the API is historically more difficult to work with than AniList. |

### 🌐 Social Dynamics (Bibo Replacement)
| Service | Recommended For | API Type | Reason |
| :--- | :--- | :--- | :--- |
| **Mastodon** | Tech/Anime Social | REST | **Privacy-focused and open.** You can fetch a public account's status feed via JSON without complex OAuth. |
| **YouTube** | Video Content | REST | Native support for US/International video creators. The "Latest Uploads" can be fetched to populate the Dynamics layout. |
| **Bluesky** | New Social Trends | AT Protocol | Rapidly growing open-social alternative with a very modern developer ecosystem. |

---

## 3. Implementation Status (Updated April 2026)

The recommendations outlined in this document have been **fully implemented**.

### Technical Strategy & Status
1.  **Transition to Structured Data:** ✅ **Complete.** The AniList integration (`inc/anilist.php`) uses GraphQL to fetch numeric progress data, bypassing the need for Chinese string parsing.
2.  **Public API Access:** ✅ **Complete.** Integrations for Mastodon, YouTube, Bluesky, Audius, and Jamendo utilize public API endpoints to ensure seamless data fetching without complex OAuth requirements for end-users.
3.  **Shortcode Generalization:** ✅ **Complete.** The `[video]` shortcode in `inc/shortcode.php` now automatically detects and embeds content from YouTube, Vimeo, and Bilibili.

### UI Improvements & Status
*   **Service-Specific Metadata:** ✅ **Complete.** Templates for Mastodon, YouTube, and Bluesky now display relevant metrics (Followers, Subscribers, Post Counts) instead of Bilibili-specific badges.
*   **English Localization:** ✅ **Complete.** All hardcoded Chinese strings in the dynamics and anime tracking layouts have been translated to English.
*   **Expanded Cloud Music:** ✅ **Added.** SoundCloud support has been integrated both as a shortcode and as a source for the QPlayer.
