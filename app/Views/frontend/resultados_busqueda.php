<?= $this->extend('frontend/layout/main'); ?>
<?= $this->section('content'); ?>

    <div class="container mt-5">

        <h1>Resultados de la búsqueda</h1>

        <?php if ($resultados): ?>
            <div class="row">
                <?php foreach ($resultados as $resultado): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($resultado['nombre']) ?></h5>
                                <?php if ($resultado['tipo'] === 'application/pdf'): ?>
                                    <a href="/archivos/visualizar/<?= $resultado['id'] ?>" class="text-decoration-none" target="_self"><?= $resultado['nombre'] ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No se encontraron resultados.</p>
        <?php endif; ?>

    </div>

<?= $this->endSection() ?>