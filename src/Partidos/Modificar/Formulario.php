<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Duelo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Formulario.css">
</head>
<body>
    <div class="form-container animate__animated animate__fadeIn">
        <div class="icon"><i class="fas fa-edit"></i></div>
        <h1>Modificar Duelo</h1>
        <form action="Modificar_Duelo.php" method="post">
            <input type="number" name="id" required placeholder="ID del Duelo"><br>
            <input type="text" name="resultado" required placeholder="Resultado (X-Y)"><br>
            <input type="submit" value="Modificar Resultado">
        </form>
    </div>
</body>
</html>
