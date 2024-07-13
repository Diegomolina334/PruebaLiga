<?php
    include '../../../src/PHP/conexion.php';
    $sql = "TRUNCATE TABLE noticia";

    if($conexion ->query($sql) === TRUE)
    {
        echo "Todas las noticias han sido eliminadas correctamente.";
    } else {
        echo "Error al eliminar noticias: " . $conexion->error;
    }

    $conexion->close();


header("Location: ../Noticias.php");
exit;

?>