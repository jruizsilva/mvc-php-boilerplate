<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contactos</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="max-w-[80%] mx-auto pt-5 bg-gray-50">
  <h1 class="text-2xl font-bold mb-5">Listado de contactos</h1>

  <a href="/contacts/create"
    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded inline-block mb-5">Crear
    contacto</a>
  <ul>
    <?php foreach ($contacts['data'] as $contact): ?>
      <li class="list-disc list-inside">
        <a href="/contacts/<?= $contact['id'] ?>" class="text-blue-500 hover:underline opacity-90">
          <?= $contact['name'] ?>
        </a>
      </li>
    <?php endforeach ?>
  </ul>

  <?php
  $paginate = 'contacts';
  require_once '../resources/views/assets/pagination.php' ?>

</body>

</html>