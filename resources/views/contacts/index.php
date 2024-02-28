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

  <div class="flex justify-between">
    <form action="/contacts" method="get" class="max-w-md flex-1">
      <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
      <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
          </svg>
        </div>
        <input type="search" id="default-search"
          class="block w-full p-4 ps-10 text-sm text-gray-900 border rounded-lg bg-gray-50 outline-gray-500"
          placeholder="Escriba el contacto que desea buscar" name="search" value="<?= $search ?>" />
        <button type="submit"
          class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ">Search</button>
      </div>
    </form>
    <a href="/contacts/create"
      class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded inline-block mb-5">Crear
      contacto</a>
  </div>



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
  require_once '../resources/views/assets/pagination.php'
    ?>

</body>

</html>