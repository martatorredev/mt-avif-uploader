<?php
/*
Plugin Name: MT AVIF Uploader
Description: This plugin allows users to upload AVIF files.
Author: Marta Torre
Author URI: https://martatorre.dev
Text Domain: avif-uploader
*/

// Add the form to the admin area
function avif_uploader_form() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('AVIF Uploader', 'avif-uploader'); ?></h1>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="avif_file" accept=".avif">
            <input type="submit" value="<?php esc_attr_e('Upload AVIF', 'avif-uploader'); ?>">
        </form>
    </div>
    <?php
}

// Process the form and upload the AVIF file
function avif_upload_file() {
    if (isset($_FILES['avif_file'])) {
        $file = $_FILES['avif_file'];

        // Check if the file was uploaded without errors
        if ($file['error'] === UPLOAD_ERR_OK) {
            $file_name = sanitize_file_name($file['name']);
            $file_tmp = $file['tmp_name'];

            // Perform necessary conversions here
            // You can use libraries or external tools to convert the AVIF file to other formats

            // Save the converted file to a specific location on the server
            $upload_dir = wp_upload_dir();
            $target_path = $upload_dir['path'] . '/' . $file_name;

            if (move_uploaded_file($file_tmp, $target_path)) {
                // The AVIF file was uploaded successfully
                echo esc_html__('The AVIF file has been uploaded successfully!', 'avif-uploader');
            } else {
                // An error occurred while moving the file
                echo esc_html__('An error occurred while uploading the AVIF file.', 'avif-uploader');
            }
        } else {
            // An error occurred during the file upload
            echo esc_html__('An error occurred during the AVIF file upload.', 'avif-uploader');
        }
    }
}

// Add WordPress hooks and actions
add_action('admin_menu', 'avif_uploader_menu');
add_action('admin_init', 'avif_upload_file');

// Add the menu in the admin panel
function avif_uploader_menu() {
    add_menu_page(
        esc_html__('AVIF Uploader', 'avif-uploader'),
        esc_html__('AVIF Uploader', 'avif-uploader'),
        'manage_options',
        'avif-uploader',
        'avif_uploader_form'
    );
}