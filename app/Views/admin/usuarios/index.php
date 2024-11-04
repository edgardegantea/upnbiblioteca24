<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<!-- Incluir CSS de DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<div class="">
    <h2>Usuarios del sistema</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <a href="<?= base_url('admin/usuarios/create') ?>" class="btn btn-primary mb-3">Crear Usuario</a>

    <table id="usuariosTable" class="table table-striped" style="width:100%">
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
                        <?= esc($usuario['nombre']) ?> <?= esc($usuario['apaterno']) ?></a>
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


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        // Inicializar DataTables en la tabla de usuarios
        $('#usuariosTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            }
        });

        setTimeout(function () {
            $('.alert-success').fadeOut('slow');
        }, 5000);
    });
</script>

<?= $this->endSection(); ?>
