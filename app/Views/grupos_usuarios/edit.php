<?= $this->include('templates/header') ?>
<div class="container">
    <h1>Editar Grupo de Usuario</h1>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <form action="/grupos-usuarios/update/<?= $grupo['id'] ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" class="form-control" value="<?= $grupo['descripcion'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Grupo</button>
    </form>
</div>
<?= $this->include('templates/footer') ?>
