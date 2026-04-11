# International Services Integration Guide

This guide provides instructions on how to configure and use the new international services integrated into the Kratos theme. These features are designed to replace or complement the original Bilibili and Netease-centric services.

---

## 1. Video Embedding (`[video]` shortcode)

The `[video]` shortcode is a universal tool for embedding videos from YouTube, Vimeo, and Bilibili.

### How to Use
Insert the following shortcode into your post or page:
`[video site="auto"]URL_OR_ID[/video]`

- **`site`**: (Optional) Set to `youtube`, `vimeo`, `bilibili`, or `auto` (default). If set to `auto`, the theme will try to detect the service from the content.
- **`width`**: (Optional) CSS width (default: `100%`).
- **`height`**: (Optional) CSS height (default: `498`).

### Examples
- **YouTube**: `[video]https://www.youtube.com/watch?v=dQw4w9WgXcQ[/video]`
- **Vimeo**: `[video]https://vimeo.com/12345678[/video]`
- **Bilibili**: `[video]av123456[/video]`

---

## 2. SoundCloud Tracks (`[soundcloud]` shortcode)

Embed any SoundCloud track directly into your content.

### How to Use
`[soundcloud]SOUNDCLOUD_TRACK_URL[/soundcloud]`

### Parameters (Optional)
- **`auto_play`**: `true` or `false` (default).
- **`color`**: Hex color code for the player (default: `#ff5500`).
- **`show_user`**: `true` (default) or `false`.

---

## 3. Anime Tracking (AniList Integration)

Replace the Bilibili anime list with your AniList profile.

### Configuration
1. Go to **Appearance > Theme Options > Other Settings**.
2. Find the **AniList Username** field.
3. Enter your AniList username.
4. **Note**: If this field is filled, the theme will automatically use AniList for the "My Anime List" page template.

### Display
Create a page and select the **Bilibili Anime Tracking Template**. The theme will now pull data from your AniList profile instead of Bilibili.

---

## 4. Social Dynamics (Mastodon, YouTube, Bluesky)

The "Dynamics" (Bibo) layout can now pull from various international social platforms.

### General Configuration
1. Create a page and select the **Bilibili Dynamics Template**.
2. Configure your preferred service in **Theme Options > Social Dynamics Settings**.

### Service-Specific Setup

#### Mastodon
- **Mastodon Instance URL**: e.g., `mastodon.social` or `fosstodon.org`.
- **Mastodon User ID**: This is a numeric ID. You can find it by viewing your profile JSON (e.g., `https://instance.com/api/v1/accounts/lookup?acct=your_username`).

#### YouTube
- **YouTube API Key**: Obtain this from the [Google Cloud Console](https://console.cloud.google.com/).
- **YouTube Channel ID**: Your unique channel ID (looks like `UC...`).
- **Function**: Shows your 10 latest video uploads with embedded players.

#### Bluesky
- **Bluesky Handle**: Your full handle, e.g., `user.bsky.social`.
- **Function**: Shows your latest posts and images.

---

## 5. Music Player (Audius, Jamendo, SoundCloud)

Add decentralized and international music to the site-wide QPlayer.

### Configuration
1. Go to **Appearance > QPlayer Settings**.
2. Select the Source from the radio list (**Audius Track**, **Jamendo Track**, or **SoundCloud URL**).
3. **ID/URL Input**:
   - **Audius**: Enter the Track ID (found in the track URL or share data).
   - **Jamendo**: Enter the Jamendo Track ID.
   - **SoundCloud**: Enter the **full track URL** (e.g., `https://soundcloud.com/user/track-name`).
4. Click **Add to songList**.
