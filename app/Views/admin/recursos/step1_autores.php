<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h2>Seleccionar o Registrar Autores</h2>
<form action="<?= base_url('admin/recursos/step1') ?>" method="post">
    <label>Autores Existentes:</label><br>
    <?php foreach ($autores as $autor): ?>
        <input type="checkbox" name="autores[]" value="<?= $autor['id'] ?>"> <?= $autor['nombre'] ?><br>
    <?php endforeach; ?>

    <div class="form-group mt-3">
        <label>Agregar Nuevos Autores:</label>
        <div id="nuevos-autores">
            <input class="form-control" type="text" name="nuevos_autores[]" placeholder="Nombre del autor">
        </div>
    </div>

    <br>
    <button class="btn btn-secondary" type="button" onclick="agregarCampoAutor()">Agregar otro autor</button>
    <button class="btn btn-primary" type="submit">Continuar</button>
</form>

<script>
    function agregarCampoAutor() {
        const nuevosAutoresDiv = document.getElementById('nuevos-autores');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'nuevos_autores[]';
        input.placeholder = 'Nombre del autor';
        nuevosAutoresDiv.appendChild(input);
    }
</script>


<?= $this->endSection(); ?>