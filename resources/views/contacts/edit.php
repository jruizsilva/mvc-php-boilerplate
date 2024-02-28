<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar contacto</title>
</head>

<body>
  <h1>Editar contacto</h1>

  <form action="/contacts/<?= $contact['id'] ?>/edit" method="post">
    <div>
      <label>Nombre
        <input value="<?= $contact['name'] ?>" type="text" name="name">
      </label>
    </div>
    <div>
      <label>Email
        <input value="<?= $contact['email'] ?>" type="text" name="email">
      </label>
    </div>
    <div>
      <label>Teléfono
        <input value="<?= $contact['phone'] ?>" type="text" name="phone">
      </label>
    </div>
    <input type="submit" value="Actualizar contacto">
  </form>
</body>

</html>