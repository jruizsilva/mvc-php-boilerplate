<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear contacto</title>
</head>

<body>
  <h1>Crear contacto</h1>

  <form action="/contacts" method="post">
    <div>
      <label>Nombre
        <input type="text" name="name">
      </label>
    </div>
    <div>
      <label>Email
        <input type="text" name="email">
      </label>
    </div>
    <div>
      <label>Teléfono
        <input type="text" name="phone">
      </label>
    </div>
    <input type="submit" value="Crear contacto">
  </form>
</body>

</html>