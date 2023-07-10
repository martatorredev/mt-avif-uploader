<?php
/*
Plugin Name: AVIF Uploader
*/

// Agrega el formulario al área de administración
function avif_uploader_form() {
    ?>
    <div class="wrap">
        <h1>AVIF Uploader</h1>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="avif_file" accept=".avif">
            <input type="submit" value="Subir AVIF">
        </form>
    </div>
    <?php
}

// Procesa el formulario y sube el archivo AVIF
function avif_upload_file() {
    if (isset($_FILES['avif_file'])) {
        $file = $_FILES['avif_file'];

        // Verifica si se subió el archivo sin errores
        if ($file['error'] === UPLOAD_ERR_OK) {
            $file_name = sanitize_file_name($file['name']);
            $file_tmp = $file['tmp_name'];

            // Realiza las conversiones necesarias aquí
            // Puedes usar bibliotecas o herramientas externas para convertir el archivo AVIF a otros formatos

            // Guarda el archivo convertido en una ubicación específica en el servidor
            $upload_dir = wp_upload_dir();
            $target_path = $upload_dir['path'] . '/' . $file_name;

            if (move_uploaded_file($file_tmp, $target_path)) {
                // El archivo se subió correctamente
                echo '¡El archivo AVIF se ha subido con éxito!';
            } else {
                // Ocurrió un error al mover el archivo
                echo 'Ha ocurrido un error al subir el archivo AVIF.';
            }
        } else {
            // Ocurrió un error durante la subida del archivo
            echo 'Ha ocurrido un error durante la subida del archivo AVIF.';
        }
    }
}

// Agrega los ganchos y acciones de WordPress
add_action('admin_menu', 'avif_uploader_menu');
add_action('admin_init', 'avif_upload_file');

// Agrega el menú en el panel de administración
function avif_uploader_menu() {
    add_menu_page('AVIF Uploader', 'AVIF Uploader', 'manage_options', 'avif-uploader', 'avif_uploader_form');
}
