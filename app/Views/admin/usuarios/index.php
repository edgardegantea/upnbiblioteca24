<h2>Lista de Usuarios</h2>
<a href="/admin/usuarios/create">Crear Usuario</a>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Username</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($usuarios as $usuario): ?>
    <tr>
        <td><?= $usuario['id'] ?></td>
        <td><?= $usuario['nombre'] . ' ' . $usuario['apaterno'] . ' ' . $usuario['amaterno'] ?></td>
        <td><?= $usuario['username'] ?></td>
        <td><?= $usuario['email'] ?></td>
        <td><?= $usuario['telefono'] ?></td>
        <td>
            <a href="/admin/usuarios/edit/<?= $usuario['id'] ?>">Editar</a>
            <form action="/admin/usuarios/delete/<?= $usuario['id'] ?>" method="post" style="display:inline;">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit">Eliminar</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
