<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalle de contactos</title>
</head>

<body>
  <h1>Detalle de contactos</h1>
  <a href="/contacts">Volver</a> |
  <a href="/contacts/<?= $contact['id'] ?>/edit">Editar</a>
  <p>Nombre
    <?= $contact['name'] ?>
  </p>
  <p>Email
    <?= $contact['email'] ?>
  </p>
  <p>Telefono
    <?= $contact['phone'] ?>
  </p>

  <form action="/contacts/<?= $contact['id'] ?>/delete" method="post">
    <input type="submit" value="Eliminar">
  </form>
</body>

</html>