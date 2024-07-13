<?php
include '../../src/PHP/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = htmlspecialchars($_POST['titulo']);
    $contenido = htmlspecialchars($_POST['contenido']);
    $autor = htmlspecialchars($_POST['autor']);

    // Manejo de la imagen
    $target_dir = "../../src/uploads";
    $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen real
    $check = getimagesize($_FILES["archivo"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
            // Insertar los datos en la base de datos
            $imagen_url = $target_file; // Ruta de la imagen
            $sql = "INSERT INTO noticia (titulo, contenido, autor, imagen) VALUES ('$titulo', '$contenido', '$autor', '$imagen_url')";
            if ($conexion->query($sql) === TRUE) {
                echo "Noticia creada exitosamente.";
            } else {
                echo "Error: " . $sql . "<br>" . $conexion->error;
            }
        } else {
            echo "Hubo un error subiendo tu archivo.";
        }
    } else {
        echo "El archivo no es una imagen.";
    }
    
    // Cerrar la conexión
    $conexion->close();
}
?>
