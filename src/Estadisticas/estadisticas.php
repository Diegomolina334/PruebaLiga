<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  </head>
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
        <a href="#">
          <li class="mt-4 mb-14 md:mt-4 md:mb-3 xl:mt-4 xl:mb-12 flex items-center"><span class="material-symbols-outlined">login</span>Iniciar Sesion</li>
        </a>
        <a href="../src/Estadisticas/estadisticas.php">
          <li class="mt-4 mb-12 md:mt-4 md:mb-3 xl:mt-4 xl:mb-12 flex items-center"><span class="material-symbols-outlined">view_timeline</span>Estadisticas</li>
        </a>
        <a href="../src/Equipos/Equipos.php">
          <li class="mt-4 mb-12 md:mt-4 md:mb-3 xl:mt-4 xl:mb-12 flex items-center"><span class="material-symbols-outlined">groups_2</span>Equipos</li>
        </a>
        <li class="menu-item mt-4 mb-12 md:mt-4 md:mb-3 xl:mt-4 xl:mb-12 flex items-center cursor-pointer">
          <span class="material-symbols-outlined">sports_soccer</span>Partidos
          <ul class="submenu pl-5">
            <a href="../src/Partidos/Calendario.php">
              <li class="mt-4">Calendario</li>
            </a>
            <a href="../src/Partidos/Posiciones.php">
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

  

  <main id="mainContent" class="flex-1 ml-0 p-3 content-shift">
              <?php
                    if (isset($_GET['equipo'])) {
                        $equipo = $_GET['equipo'];
                        echo "<h1>Estadísticas de: $equipo</h1>";
                    } else {
                        echo "<h1>Equipo no especificado</h1>";
                        exit;
                    }
                ?>
            
                <section class="tabla">
                  <div class="tabla md:block">
                    
                    <table class="table-auto mt-12 md:mt-32 w-full">
                      <thead>
                        <tr>
                          <th class="border border-gray-300 p-3">#</th>
                          <th class="border border-gray-300 p-3">Jugador</th>
                          <th class="border border-gray-300 p-3">2 Puntos</th>
                          <th class="border border-gray-300 p-3">3 Puntos</th>
                          <th class="border border-gray-300 p-3">TL</th>
                          <th class="border border-gray-300 p-3">Puntos</th>
                          <th class="border border-gray-300 p-3">Especial</th>
                          <th class="border border-gray-300 p-3">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            
                        <?php
            include '../PHP/conexion.php';

            $sql = "SELECT id, nombre, doble_puntos, triple_puntos, tl, puntos, activo FROM estadistica WHERE equipo = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("s", $equipo);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo("<tr>
                        <td class='border border-gray-300 p-2'>".$row['id']."</td>
                        <td class='border border-gray-300 p-2'>".$row['nombre']."</td>
                        <td class='border border-gray-300 p-2'>".$row['doble_puntos']."</td>
                        <td class='border border-gray-300 p-2'>".$row['triple_puntos']."</td>
                        <td class='border border-gray-300 p-2'>".$row['tl']."</td>
                        <td class='border border-gray-300 p-2'>".$row['puntos']."</td>
                        <td class='border border-gray-300 p-2'>".($row['activo'] ? 'Sí' : 'No')."</td>
                        <td>
                            <form action='../../src/Estadisticas/toogle-activo.php' method='post'>
                                <input type='hidden' name='id' value='".$row['id']."'>
                                <input type='hidden' name='equipo' value='".$equipo."'>
                                <button type='submit'>".($row['activo'] ? 'Desactivar' : 'Activar')."</button>
                            </form>
                        </td>
                    </tr>");
                }
            } else {
                echo "<tr><td colspan='8'>No hay jugadores para este equipo</td></tr>";
            }

            $stmt->close();
            $conexion->close();
            ?>
                  
                    </tr>
                      </tbody>
                    </table>

            <a href="../../src/Estadisticas/Jugadores/Agregar_Jugador.php?equipo=<?php echo urlencode($equipo); ?>">
                <button class="mt-12 border border-gray-950">Agregar Jugador</button>
            </a>
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