<?php
include '../../PHP/conexion.php';

$id = $_POST['id'];
$resultado = $_POST['resultado'];

// Obtener el resultado anterior para restar victorias y derrotas
$sql_duelo = "SELECT equipo_local, equipo_visitante, resultado FROM duelos WHERE id=$id";
$result = $conexion->query($sql_duelo);
$duelo = $result->fetch_assoc();

$equipo_local = $duelo['equipo_local'];
$equipo_visitante = $duelo['equipo_visitante'];
$resultado_anterior = $duelo['resultado'];

// Restar victorias y derrotas del resultado anterior si existe
if (!empty($resultado_anterior)) {
    list($goles_local_ant, $goles_visitante_ant) = explode("-", $resultado_anterior);

    if ($goles_local_ant > $goles_visitante_ant) {
        $ganador_ant = $equipo_local;
        $perdedor_ant = $equipo_visitante;
    } else {
        $ganador_ant = $equipo_visitante;
        $perdedor_ant = $equipo_local;
    }

    $sql_update_ganador_ant = "UPDATE posiciones SET victorias = victorias - 1 WHERE equipo='$ganador_ant'";
    $sql_update_perdedor_ant = "UPDATE posiciones SET derrotas = derrotas - 1 WHERE equipo='$perdedor_ant'";

    $conexion
    ->query($sql_update_ganador_ant);
    $conexion
    ->query($sql_update_perdedor_ant);
}

// Actualizar el resultado en la tabla de duelos
$sql = "UPDATE duelos SET resultado='$resultado' WHERE id=$id";

if ($conexion
->query($sql) === TRUE) {
    echo "Resultado modificado exitosamente";

    list($goles_local, $goles_visitante) = explode("-", $resultado);

    if ($goles_local > $goles_visitante) {
        $ganador = $equipo_local;
        $perdedor = $equipo_visitante;
    } else {
        $ganador = $equipo_visitante;
        $perdedor = $equipo_local;
    }

    $sql_update_ganador = "UPDATE posiciones SET victorias = victorias + 1 WHERE equipo='$ganador'";
    $sql_update_perdedor = "UPDATE posiciones SET derrotas = derrotas + 1 WHERE equipo='$perdedor'";

    $conexion
    ->query($sql_update_ganador);
    $conexion
    ->query($sql_update_perdedor);

} else {
    echo "Error: " . $sql . "<br>" . $conexion
    ->error;
}
header('Location: ../Calendario.php');

$conexion->close();

?>
