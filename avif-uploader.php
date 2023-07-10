<?php
/*
Plugin Name: MT AVIF Uploader
Description: This plugin allows users to upload AVIF files.
Author: Marta Torre
Author URI: https://martatorre.dev
Text Domain: avif-uploader
*/

// Register AVIF as a supported image format
function avif_add_mime_types($mimes) {
    $mimes['avif'] = 'image/avif';
    $mimes['avifs'] = 'image/avif-sequence';
    return $mimes;
}
add_filter('upload_mimes', 'avif_add_mime_types');

// Handle AVIF uploads and convert them if necessary
function avif_handle_upload($metadata, $file) {
    if ($file['type'] === 'image/avif' || $file['type'] === 'image/avif-sequence') {
        // Perform necessary conversions here if needed
        // You can use libraries or external tools to convert the AVIF file to other formats

        // Update the metadata and return
        return $metadata;
    }

    return $metadata;
}
add_filter('wp_generate_attachment_metadata', 'avif_handle_upload', 10, 2);
