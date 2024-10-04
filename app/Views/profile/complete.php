<h2>Completa tu Información</h2>

<form action="/update-profile" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>" required><br>

    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apaterno" value="<?= $usuario['apaterno'] ?>" required>
    <input type="text" name="amaterno" value="<?= $usuario['amaterno'] ?>" required><br>

    <label for="username">Username:</label>
    <input type="text" name="username" value="<?= $usuario['username'] ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?= $usuario['email'] ?>" required><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" value="<?= $usuario['telefono'] ?>"><br>

    <button type="submit">Guardar Cambios</button>
</form>
