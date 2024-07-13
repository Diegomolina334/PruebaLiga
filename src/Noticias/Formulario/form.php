<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" type="image/jpeg" href="../IMG/BackgroundEraser_20240620_223100568.jpg">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Crear Noticia</title>
</head>
<body class="bg-gradient-to-r from-teal-500 to-blue-500 flex items-center justify-center min-h-screen">

    <form action="../Crear_Noticias.php" method="POST" enctype="multipart/form-data" class="bg-white bg-opacity-90 p-8 rounded-lg shadow-lg w-full max-w-lg text-center">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Crear Noticia</h2>
        <div class="form-group mb-6 text-left">
            <label for="titulo" class="block font-bold mb-2 text-gray-700">Título:</label>
            <input type="text" id="titulo" name="titulo" required class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
        </div>
        <div class="form-group mb-6 text-left">
            <label for="contenido" class="block font-bold mb-2 text-gray-700">Contenido:</label>
            <textarea id="contenido" name="contenido" rows="4" required class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"></textarea>
        </div>
        <div class="form-group mb-6 text-left">
            <label for="autor" class="block font-bold mb-2 text-gray-700">Autor:</label>
            <input type="text" id="autor" name="autor" required class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
        </div>
        <div class="form-group mb-6 text-left">
            <label for="archivo" class="block font-bold mb-2 text-gray-700">Adjuntar archivo:</label>
            <input type="file" id="archivo" name="archivo" class="mt-2">
        </div>
        <input type="submit" value="Publicar" class="w-full p-2 bg-green-500 text-white font-bold rounded-md cursor-pointer hover:bg-green-600 transition duration-300 ease-in-out">
    </form>

</body>
</html>
