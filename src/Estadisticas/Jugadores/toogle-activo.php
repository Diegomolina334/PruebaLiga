<?php
include '../../PHP/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $doble = $_POST['doble_punto'];
    $triple = $_POST['triple_puntos'];
    $tl = $_POST['tl'];
    $puntos = $_POST['puntos'];
    $activo = isset($_POST['activo']) ? 1 : 0; // Obtener el valor del checkbox
    $equipo = $_POST['equipo'];

    $sql = "INSERT INTO estadistica (id, nombre, doble_puntos, triple_puntos, tl, puntos, equipo, activo) VALUES ('$id', '$nombre','$doble','$triple','$tl', '$puntos', '$equipo', '$activo')";

    if ($conexion->query($sql) === TRUE) {
        header('Location: ../estadisticas.php?equipo=' . urlencode($equipo));
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../Estadisticas/agregar.css">
    <title>Agregar Jugador</title>
</head>
<body>
<div class="container animate__animated animate__fadeIn">
    <h1>Agregar Jugador</h1>

    <?php
        if (isset($_GET['equipo'])) {
            $equipo = $_GET['equipo'];
        } else {
            echo "<h2>Error: Equipo no especificado</h2>";
            exit;
        }
    ?>
    
    <form action="agregar_jugador.php" method="post">
        <div class="form-group">
            <label for="id"><span class="material-symbols-outlined">tag</span>ID</label>
            <input type="text" id="id" name="id" required>
        </div>

        <div class="form-group">
            <label for="nombre"><span class="material-symbols-outlined">person</span>Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="doble_punto"><span class="material-symbols-outlined">looks_two</span>2 Puntos</label>
            <input type="number" id="doble_punto" name="doble_punto" required>
        </div>

        <div class="form-group">
            <label for="triple_puntos"><span class="material-symbols-outlined">looks_3</span>3 Puntos</label>
            <input type="number" id="triple_puntos" name="triple_puntos" required>
        </div>

        <div class="form-group">
            <label for="tl"><span class="material-symbols-outlined">panorama_wide_angle</span>TL</label>
            <input type="number" id="tl" name="tl" required>
        </div>

        <div class="form-group">
            <label for="puntos"><span class="material-symbols-outlined">score</span>Puntos</label>
            <input type="number" id="puntos" name="puntos" required>
        </div>

        <div class="form-group">
            <label for="activo"><span class="material-symbols-outlined">check_circle</span>Activo</label>
            <input type="checkbox" id="activo" name="activo" value="1" checked>
        </div>

        <input type="hidden" name="equipo" value="<?php echo htmlspecialchars($equipo); ?>">

        <div class="form-group">
            <button type="submit">Agregar Jugador</button>
        </div>
    </form>
</div>
</body>
</html>

