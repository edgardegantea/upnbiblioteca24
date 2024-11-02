<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <h2>Lista de Usuarios</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <a href="<?= base_url('admin/usuarios/create') ?>" class="btn btn-primary mb-3">Crear Usuario</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= esc($usuario['id']) ?></td>
                <td><a href="<?= base_url('admin/usuarios/show/' . $usuario['id']) ?>">
                        <?= esc($usuario['nombre']) ?> <?= esc($usuario['apaterno']) ?> </a>

                </td>
                <td><?= esc($usuario['email']) ?></td>

                <td>
                    <form action="<?= base_url('admin/usuarios/delete/' . $usuario['id']) ?>" method="post" style="display:inline;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>
