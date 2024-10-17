<?= $this->include('templates/header') ?>
<div class="container">
    <h1>Crear Nuevo Usuario</h1>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <form action="/usuarios/store" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre_usuario">Nombre de Usuario:</label>
            <input type="text" name="nombre_usuario" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="habilitado">Habilitado:</label>
            <select name="habilitado" class="form-control" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="grupo_usuario">Grupo de Usuario:</label>
            <select name="grupo_usuario" class="form-control" required>
                <?php foreach ($grupos as $grupo): ?>
                    <option value="<?= $grupo['id'] ?>"><?= $grupo['descripcion'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
    </form>
</div>
<?= $this->include('templates/footer') ?>
