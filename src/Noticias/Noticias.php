<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Noticias</title>
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
<body class="flex bg-gray-100">

    <!-- Botón para mostrar/ocultar el menú -->
    <button id="menuButton" class="fixed top-2 left-2 text-black p-2 rounded-md z-50">
        <span class="material-symbols-outlined">menu</span>
    </button>

    <div id="menu"
        class="menu bg-blue-500 w-48 md:w-60 xl:w-64 h-screen font-extrabold text-white md:text-black p-2 fixed top-0 left-0 transform -translate-x-full">
        <div class="toolbar">
        </div>

        <nav class="mt-16 xl:mt-28">
            <ul>
                <a href="#">
                    <li
                        class="mt-4 mb-14 md:mt-4 md:mb-3 xl:mt-4 xl:mb-12 flex items-center"><span
                            class="material-symbols-outlined">login</span>Iniciar Sesion</li>
                </a>
                <a href="../src/Equipos/Equipos.php">
                    <li
                        class="mt-4 mb-12 md:mt-4 md:mb-3 xl:mt-4 xl:mb-12 flex items-center"><span
                            class="material-symbols-outlined">groups_2</span>Equipos</li>
                </a>
                <li
                    class="menu-item mt-4 mb-12 md:mt-4 md:mb-3 xl:mt-4 xl:mb-12 flex items-center cursor-pointer">
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
                    <li
                        class="mt-2 mb- md:mt-4 md:mb-3 xl:mt-4 xl:mb-12 flex items-center"><span
                            class="material-symbols-outlined">newspaper</span>Noticias</li>
                </a>
            </ul>
        </nav>
    </div>

    <main class="ml-0 md:ml-64 p-4 w-full">
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10 xl:mt-12">
            <!------Codigo PHP-------->
            <?php
            include '../PHP/conexion.php';

            // Consultar las noticias
            $sql = "SELECT * FROM noticia";
            $resultado = $conexion->query($sql);

            // Mostrar las noticias
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<div class='noticia bg-white rounded-lg shadow-md p-4'>";
                    echo "<h2 class='titulo xl:mt-18s text-xl font-bold mb-2 text-center'>" . $fila['titulo'] . "</h2>";
                    if (!empty($fila['imagen'])) {
                        echo "<img class='w-full h-60 xl:h-96 object-cover mb-2 rounded' src='../uploads/" . $fila['imagen'] . "' alt='Imagen adjunta'>";
                    }
                    echo "<p class='contenido text-gray-700 text-center'>" . $fila['contenido'] . "</p>";
                    echo "<p class='autor text-sm text-gray-500 mt-4 text-center'>Autor: " . $fila['autor'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No se encontraron noticias.</p>";
            }

            // Cerrar la conexión
            $conexion->close();
            ?>
        </section>

        <div class="button-container animate__animated animate__fadeInUp mt-8">
            <a href="../Noticias/Formulario/form.php">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Agregar Publicacion</button>
            </a>
        </div>

        <form method="post" action="../../src/Noticias/Eliminar/eliminar_noticias.php"
            onsubmit="return confirm('¿Estás seguro de que deseas eliminar todas las noticias?');">
            <button type="submit"
                class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar todas las noticias</button>
        </form>
    </main>

    <script>
        const menuButton = document.getElementById('menuButton');
        const menu = document.getElementById('menu');
        const mainContent = document.querySelector('main');

        menuButton.addEventListener('click', () => {
            menu.classList.toggle('-translate-x-full');
            mainContent.classList.toggle('ml-0');
            mainContent.classList.toggle('ml-64');
        });
    </script>

</body>

</html>
