<?php
include '../../PHP/conexion.php';

if (isset($_POST['equipo_local']) && isset($_POST['equipo_visitante']) && isset($_POST['fecha']) && isset($_POST['hora']) && isset($_POST['categoria'])) {
    $equipo_local = $_POST['equipo_local'];
    $equipo_visitante = $_POST['equipo_visitante'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $categoria = $_POST['categoria'];

    $sql = "INSERT INTO duelos (equipo_local, equipo_visitante, fecha, hora, categoria) VALUES ('$equipo_local', '$equipo_visitante', '$fecha', '$hora', '$categoria')";

    if ($conexion->query($sql) === TRUE) {
        header('Location: ../Calendario.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    $sql_pos_local = "INSERT INTO posiciones (equipo, categoria) VALUES ('$equipo_local', '$categoria') ON DUPLICATE KEY UPDATE equipo=equipo";
    $sql_pos_visitante = "INSERT INTO posiciones (equipo, categoria) VALUES ('$equipo_visitante', '$categoria') ON DUPLICATE KEY UPDATE equipo=equipo";
    $conexion->query($sql_pos_local);
    $conexion->query($sql_pos_visitante);
    
    $conexion->close();
} else {
    
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../../CSS/Formulario2.css">
    <link rel="icon" type="image/jpeg" href="../../IMG/BackgroundEraser_20240620_223100568.jpg">

    <title>Agregar Duelo</title>
</head>
<body>
<div class="container animate__animated animate__fadeIn">
    <h1>Agregar Equipos Al Calendario</h1>
    <form action="crear_duelo.php" method="post">
        <div class="form-group">
            <span class="material-symbols-outlined">groups</span><label for="equipo_local">Equipo Local</label>
            <input type="text" name="equipo_local" id="equipo_local" required>
        </div>
        <div class="form-group">
            <span class="material-symbols-outlined">groups</span><label for="equipo_visitante">Equipo Visitante</label>
            <input type="text" name="equipo_visitante" id="equipo_visitante" required>
        </div>
        <div class="form-group">
            <span class="material-symbols-outlined">category</span><label for="categoria">Categoría</label>
            <select name="categoria" id="categoria" required>
                <option value="Primera División">Primera División</option>
                <option value="2DA B">2DA B</option>
                <option value="Veteranos">Veteranos</option>
                <option value="Femenil">Femenil</option>
            </select>
        </div>
        <div class="form-group">
            <span class="material-symbols-outlined">calendar_today</span><label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" required>
        </div>
        <div class="form-group">
            <span class="material-symbols-outlined">schedule</span><label for="hora">Hora</label>
            <input type="time" name="hora" id="hora" required>
        </div>
        <input type="submit" value="Agregar Duelo">
    </form>
</div>
</body>
</html>



