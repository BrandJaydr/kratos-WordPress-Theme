<?php
/**
 * Avatar Picker for Kratos Theme
 */

// Add custom option type to Options Framework
add_filter('optionsframework_avatar_picker', 'kratos_avatar_picker_field', 10, 3);

function kratos_avatar_picker_field($option_name, $value, $val) {
    $id = 'section-' . $value['id'];
    $output = '<div id="' . esc_attr($id) . '" class="avatar-picker-wrapper">';
    $output .= '<div class="mobile-scaffold">';
    $output .= '<div class="mobile-screen" id="avatar-picker-browser" data-source="'.esc_url('https://alphacoders.com/anime-pfp').'">';
    $output .= '<div class="mobile-header">';
    $output .= '<span>Anime Avatars</span>';
    $output .= '</div>';
    $output .= '<div class="mobile-content">';
    $output .= '<div class="search-bar">';
    $output .= '<input type="text" id="avatar-picker-search" placeholder="Search anime..." />';
    $output .= '<button type="button" id="avatar-picker-load" class="button">Go</button>';
    $output .= '</div>';
    $output .= '<div class="avatar-picker-grid" id="avatar-picker-grid">';
    $output .= '<div style="grid-column: span 2; text-align:center; padding:20px;">';
    $output .= '<p>Browse anime profile pictures from Alpha Coders.</p>';
    $output .= '<button type="button" id="avatar-picker-start" class="button button-primary">Start Browsing</button>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="mobile-footer" id="picker-pagination" style="display:none;">';
    $output .= '<button type="button" id="avatar-picker-prev" class="button">Prev</button>';
    $output .= '<span id="current-page">Page 1</span>';
    $output .= '<button type="button" id="avatar-picker-next" class="button">Next</button>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    $output .= '<style>
        .avatar-picker-wrapper { display: flex; justify-content: center; padding: 20px 0; background: #eee; border-radius: 8px; }
        .mobile-scaffold { width: 320px; height: 568px; background: #333; border-radius: 36px; padding: 12px; box-shadow: 0 20px 50px rgba(0,0,0,0.3); position: relative; border: 4px solid #444; }
        .mobile-screen { width: 100%; height: 100%; background: #fff; border-radius: 24px; overflow: hidden; display: flex; flex-direction: column; position: relative; }
        .mobile-header { background: #0073aa; color: #fff; padding: 10px; text-align: center; font-weight: bold; font-size: 14px; flex-shrink: 0; }
        .mobile-content { flex-grow: 1; overflow-y: auto; display: flex; flex-direction: column; }
        .search-bar { display: flex; gap: 5px; padding: 10px; background: #f1f1f1; border-bottom: 1px solid #ddd; flex-shrink: 0; }
        #avatar-picker-search { flex-grow: 1; font-size: 12px; height: 30px; }
        #avatar-picker-load { height: 30px; line-height: 28px; padding: 0 10px; }
        .avatar-picker-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; padding: 8px; }
        .avatar-picker-item { cursor: pointer; border: 2px solid #eee; border-radius: 8px; overflow: hidden; transition: 0.2s; position: relative; aspect-ratio: 1/1; background: #f9f9f9; }
        .avatar-picker-item:hover { border-color: #0073aa; transform: scale(0.98); }
        .avatar-picker-item img { width: 100%; height: 100%; object-fit: cover; }
        .avatar-picker-item.selected { border-color: #0073aa; }
        .avatar-picker-item.loading::after { content: "Installing..."; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.6); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 10px; }
        .mobile-footer { background: #f1f1f1; padding: 10px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #ddd; font-size: 12px; flex-shrink: 0; }
        .mobile-content::-webkit-scrollbar { width: 4px; }
        .mobile-content::-webkit-scrollbar-thumb { background: #ccc; border-radius: 2px; }
    </style>';

    $output .= '<script type="text/javascript">
    jQuery(document).ready(function($) {
        var page = 1;
        var source = "https://alphacoders.com/anime-pfp";

        $("#avatar-picker-start, #avatar-picker-load").on("click", function() {
            page = 1;
            loadAvatars();
        });

        $("#avatar-picker-next").on("click", function() {
            page++;
            loadAvatars();
        });

        $("#avatar-picker-prev").on("click", function() {
            if (page > 1) {
                page--;
                loadAvatars();
            }
        });

        function loadAvatars() {
            var search = $("#avatar-picker-search").val();
            $("#avatar-picker-grid").html("<div style=\'grid-column: span 2; text-align:center; padding:50px;\'><i class=\'fa fa-spinner fa-spin fa-2x\'></i><p>Fetching images...</p></div>");
            $("#picker-pagination").hide();

            $.ajax({
                url: ajaxurl,
                type: "POST",
                data: {
                    action: "kratos_fetch_avatars",
                    source: source,
                    search: search,
                    page: page,
                    nonce: "'.wp_create_nonce('kratos_avatar_picker_nonce').'"
                },
                success: function(response) {
                    if (response.success) {
                        var html = "";
                        if (response.data.length === 0) {
                            html = "<p style=\'grid-column: span 2; text-align:center; padding:20px;\'>No images found.</p>";
                        } else {
                            response.data.forEach(function(img) {
                                html += "<div class=\'avatar-picker-item\' data-full=\'" + img.full + "\'><img src=\'" + img.thumb + "\' /></div>";
                            });
                            $("#picker-pagination").show();
                            $("#current-page").text("Page " + page);
                        }
                        $("#avatar-picker-grid").html(html);
                        $(".mobile-content").scrollTop(0);
                    } else {
                        $("#avatar-picker-grid").html("<p style=\'grid-column: span 2; text-align:center; padding:20px; color:red;\'>Error: " + response.data + "</p>");
                    }
                }
            });
        }

        $(document).on("click", ".avatar-picker-item", function() {
            var $item = $(this);
            var imgUrl = $item.data("full");
            if ($item.hasClass("loading")) return;

            $(".avatar-picker-item").removeClass("selected");
            $item.addClass("selected loading");

            $.ajax({
                url: ajaxurl,
                type: "POST",
                data: {
                    action: "kratos_set_avatar_from_url",
                    img_url: imgUrl,
                    nonce: "'.wp_create_nonce('kratos_avatar_picker_nonce').'"
                },
                success: function(response) {
                    $item.removeClass("loading");
                    if (response.success) {
                        alert("Profile picture updated successfully!");
                        location.reload();
                    } else {
                        alert("Error: " + response.data);
                        $item.removeClass("selected");
                    }
                },
                error: function() {
                    $item.removeClass("loading selected");
                    alert("A server error occurred.");
                }
            });
        });
    });
    </script>';

    $output .= '</div>';
    return $output;
}

// AJAX Handler for fetching avatars
add_action('wp_ajax_kratos_fetch_avatars', 'kratos_fetch_avatars_callback');
function kratos_fetch_avatars_callback() {
    check_ajax_referer('kratos_avatar_picker_nonce', 'nonce');

    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $url = 'https://alphacoders.com/anime-pfp';
    if ($page > 1) {
        $url .= '?page=' . $page;
    }

    if (!empty($search)) {
        // Alpha Coders search URL often follows this pattern
        $url = 'https://avatars.alphacoders.com/avatars/search/' . urlencode($search);
        if ($page > 1) {
            $url .= '?page=' . $page;
        }
    }

    $args = array(
        'timeout' => 15,
        'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
    );

    $response = wp_remote_get($url, $args);
    if (is_wp_error($response)) {
        wp_send_json_error('Failed to connect to Alpha Coders. ' . $response->get_error_message());
    }

    $html = wp_remote_retrieve_body($response);

    $images = array();

    // Improved regex to catch Alpha Coders thumb patterns
    preg_match_all('/(https:\/\/avatarfiles\.alphacoders\.com\/\d+\/thumb-[^"\']+)/', $html, $matches);

    if (!empty($matches[1])) {
        foreach ($matches[1] as $thumb_url) {
            // Derive full URL by removing 'thumb-' or 'thumb-350-' etc.
            // Thumb: https://avatarfiles.alphacoders.com/375/thumb-350-375112.webp
            // Full: https://avatarfiles.alphacoders.com/375/375112.png (or webp)

            $full_url = $thumb_url;
            $full_url = preg_replace('/thumb-\d+-/', '', $full_url);
            $full_url = preg_replace('/thumb-/', '', $full_url);

            $images[] = array(
                'thumb' => $thumb_url,
                'full'  => $full_url
            );
        }
    }

    // Deduplicate
    $unique_images = array();
    foreach ($images as $img) {
        $unique_images[$img['full']] = $img;
    }

    wp_send_json_success(array_values($unique_images));
}

// AJAX Handler for setting avatar from URL
add_action('wp_ajax_kratos_set_avatar_from_url', 'kratos_set_avatar_from_url_callback');
function kratos_set_avatar_from_url_callback() {
    check_ajax_referer('kratos_avatar_picker_nonce', 'nonce');

    $img_url = isset($_POST['img_url']) ? esc_url_raw($_POST['img_url']) : '';
    if (!$img_url) wp_send_json_error('Invalid image URL.');

    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    // Download file to temp location
    $tmp = download_url($img_url);
    if (is_wp_error($tmp)) {
        // Retry with another common extension if it failed?
        // Alpha Coders sometimes serves .webp but we might want .png
        wp_send_json_error('Failed to download image: ' . $tmp->get_error_message());
    }

    $file_array = array(
        'name'     => basename($img_url),
        'tmp_name' => $tmp
    );

    // Check file type
    $file_type = wp_check_filetype($file_array['name'], null);
    if (!$file_type['type']) {
        $file_array['name'] .= '.jpg';
    }

    // Sideload image into Media Library
    $attachment_id = media_handle_sideload($file_array, 0, 'Avatar downloaded via Kratos Avatar Picker from Alpha Coders');

    if (is_wp_error($attachment_id)) {
        @unlink($tmp);
        wp_send_json_error('Failed to save to Media Library: ' . $attachment_id->get_error_message());
    }

    $full_url = wp_get_attachment_url($attachment_id);
    $user_id = get_current_user_id();

    // Set as kratos local avatar
    update_user_meta($user_id, 'kratos_local_avatar', array('full' => $full_url));

    wp_send_json_success('Avatar updated and saved to Media Library.');
}
