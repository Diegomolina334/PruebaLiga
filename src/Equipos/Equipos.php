<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Equipos</title>
    <style>
    .menu {
      transition: transform 0.3s ease-in-out;
    }
    .content-shift {
      transition: margin-left 0.3s ease-in-out;
    }
    #closeButton {
      display: none;
    }
    .submenu {
      display: none;
    }
    .menu-item:hover .submenu {
      display: block;
    }
  /* Para dispositivos móviles y tablets */
@media (max-width: 767px) {
  .menu-item:hover .submenu {
    display: none;
  }
}

/* Para escritorios y laptops */
@media (min-width: 768px) {
  .menu-item:hover .submenu {
    /* Aquí puedes ajustar el estilo según sea necesario */
    display: block; /* Por ejemplo, mostrar el submenu al hacer hover */
  }
}

   
  </style>
</head>
<body class="flex">
<!-- Botón para mostrar/ocultar el menú -->
<button id="menuButton" class="fixed top-2 left-2 text-black p-2 rounded-md z-50">
    <span class="material-symbols-outlined">menu</span>
  </button>
  
  <div id="menu" class="menu bg-blue-500 w-48 md:w-60 xl:w-64 h-screen font-extrabold text-white md:text-black p-2 fixed top-0 left-0 transform -translate-x-full">
    <div class="toolbar">
    </div>

    <nav class="mt-16 xl:mt-28">
      <ul>
      <a href="../../src/index.php">
          <li class="mt-4 mb-14 md:mt-4 md:mb-3 xl:mt-4 xl:mb-12 flex items-center"><span class="material-symbols-outlined">home</span>Inicio</li>
        </a>

        <a href="#">
          <li class="mt-4 mb-14 md:mt-4 md:mb-3 xl:mt-4 xl:mb-12 flex items-center"><span class="material-symbols-outlined">login</span>Iniciar Sesion</li>
        </a>
        <a href="../../src/Estadisticas/estadisticas.php">
          <li class="mt-4 mb-12 md:mt-4 md:mb-3 xl:mt-4 xl:mb-12 flex items-center"><span class="material-symbols-outlined">view_timeline</span>Estadisticas</li>
        </a>
        <li class="menu-item mt-4 mb-12 md:mt-4 md:mb-3 xl:mt-4 xl:mb-12 flex items-center cursor-pointer">
          <span class="material-symbols-outlined">sports_soccer</span>Partidos
          <ul class="submenu pl-5">
            <a href="../../src/Partidos/Calendario.php">
              <li class="mt-4">Calendario</li>
            </a>
            <a href="../../src/Partidos/Posiciones.php">
              <li class="mt-2">Posiciones</li>
            </a>
          </ul>
        </li>
        <a href="#">
          <li class="mt-2 mb- md:mt-4 md:mb-3 xl:mt-4 xl:mb-12 flex items-center"><span class="material-symbols-outlined">newspaper</span>Noticias</li>
        </a>
      </ul>
    </nav>
  </div>

     <?php
        include '../PHP/conexion.php';

        $categoria = $_GET['categoria'] ?? 'Primera División';  // Valor predeterminado
        $titulo = "Equipos de " . $categoria;
    ?>


    <main>
    <main id="mainContent" class="flex-1 ml-0 p-3 content-shift">
    <section class="tabla">
      <div class="tabla md:block">



      <?php
    include '../PHP/conexion.php';

    $categoria = $_GET['categoria'] ?? 'Primera División';  // Valor predeterminado
    $titulo = "Equipos de " . $categoria;
?>

<div class="text-center mb-24">
    <h1 class="text-2xl font-bold"><?php echo $titulo; ?></h1>
</div>

<div class="overflow-x-auto">
    <table class="table-auto mx-auto">
        <thead>
            <tr>
                <th class="border border-gray-300 p-3">Nombre</th>
                <th class="border border-gray-300 p-3">Entrenador</th>
                <th class="border border-gray-300 p-3">Ciudad</th>
                <th class="border border-gray-300 p-3">Victorias</th>
                <th class="border border-gray-300 p-3">Derrotas</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT nombre, entrenador, ciudad, victorias, derrotas FROM equipo WHERE categoria = '$categoria' ORDER BY victorias DESC, derrotas ASC";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='border border-gray-300'>";
                        echo "<td class='p-3'>" . $row['nombre'] . "</td>";
                        echo "<td class='p-3'>" . $row['entrenador'] . "</td>";
                        echo "<td class='p-3'>" . $row['ciudad'] . "</td>";
                        echo "<td class='p-3'>" . $row['victorias'] . "</td>";
                        echo "<td class='p-3'>" . $row['derrotas'] . "</td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
</div>

<div class="button-container animate__animated animate__fadeInUp text-center mt-4">
    <a href="../Equipo/Crear/Agregar_Equipo.php">
        <button class="btn">Agregar Equipos</button>
    </a>
</div>
      </div>
    </section>
    </main>

    <script>
  const menuButton = document.getElementById('menuButton');
const closeButton = document.getElementById('closeButton');
const menu = document.getElementById('menu');
const mainContent = document.getElementById('mainContent');

menuButton.addEventListener('click', () => {
  menu.classList.toggle('-translate-x-full');
  mainContent.classList.toggle('ml-0');
  mainContent.classList.toggle('ml-64');
  closeButton.style.display = closeButton.style.display === 'none' ? 'block' : 'none';
});

closeButton.addEventListener('click', () => {
  menu.classList.toggle('-translate-x-full');
  mainContent.classList.toggle('ml-0');
  mainContent.classList.toggle('ml-64');
  closeButton.style.display = closeButton.style.display === 'none' ? 'block' : 'none';
});

</script>

</body>
</html>