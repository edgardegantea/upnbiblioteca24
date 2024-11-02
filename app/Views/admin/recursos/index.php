<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="mt-3">

    <div class="row">
        <div class="col-md-8">
            <h2>Recursos bibliográficos</h2>
        </div>
        <div class="col-md-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary" href="<?= base_url('admin/recursos/step1') ?>">Registrar recurso</a>
            </div>
        </div>
    </div>

    <?php if (session()->has('success')): ?>
        <div class="alert alert-success">
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <table id="example" class="table table-striped table-hover table-responsive mt-3">
        <thead>
        <tr>
            <th>Título</th>
            <th>Autor (es)</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($recursos as $recurso): ?>
            <tr>
                <td>
                    <a href="<?= base_url('admin/recursos/show/' . $recurso['id']) ?>" class="text-decoration-none">
                        <?= esc($recurso['titulo']) ?>
                    </a><br>
                    <?= esc($recurso['genero_nombre']) ?> - <?= esc($recurso['isbn']) ?> - <?= esc($recurso['editorial_nombre']) ?> - <?= esc($recurso['anio_publicacion']) ?>
                </td>
                <td>
                    <?php
                    $autores = $recurso['autores'];
                    if (!empty($autores)) {
                        $nombresAutores = array_column($autores, 'nombre');
                        echo implode(", ", $nombresAutores);
                    } else {
                        echo "Sin autores";
                    }
                    ?>
                </td>
                <td>
                    <a href="/admin/recursos/edit/<?= $recurso['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <form action="/admin/recursos/delete/<?= $recurso['id'] ?>" method="post" style="display: inline;">
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

<script>
    $(document).ready(function () {
        $('#example').DataTable({
            dom: 'Bftip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            colReorder: true,
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
            }
        });
    });
</script>

<?= $this->endSection(); ?>
