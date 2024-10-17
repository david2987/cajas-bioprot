<?= $this->include('templates/header') ?>
<div class="container">
    <h1>Editar Caja</h1>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <form action="/cajas/update/<?= $caja['id'] ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre_caja">Nombre de la Caja:</label>
            <input type="text" name="nombre_caja" class="form-control" value="<?= $caja['nombre_caja'] ?>" required>
        </div>
        <div class="form-group">
            <label for="estado_caja">Estado de la Caja:</label>
            <select name="estado_caja" class="form-control" required>
                <option value="PENDIENTE" <?= $caja['estado_caja'] == 'PENDIENTE' ? 'selected' : '' ?>>PENDIENTE</option>
                <option value="DISPONIBLE" <?= $caja['estado_caja'] == 'DISPONIBLE' ? 'selected' : '' ?>>DISPONIBLE</option>
                <option value="PARA CONSUMO" <?= $caja['estado_caja'] == 'PARA CONSUMO' ? 'selected' : '' ?>>PARA CONSUMO</option>
            </select>
        </div>
        <div class="form-group">
            <label for="contenido">Contenido:</label>
                <span class="fw-bolder" for="contenido"><?= $caja['contenido'] ?></span>
                <input type="hidden" name="existing_imagen" value="<?= $caja['contenido'] ?>"  class="form-control" />
            <input type="file" name="contenido"  class="form-control" />
        </div>
        <div class="form-group">
            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" class="form-control" required>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id'] ?>" <?= isset($caja) && $caja['categoria_id'] == $categoria['id'] ? 'selected' : '' ?>>
                        <?= $categoria['nombre_categoria'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" class="form-control">
            <small class="form-text text-muted">Deja en blanco si no deseas cambiar la imagen.</small>
        </div>
        <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i>    
        Actualizar Caja</button>
        <a href="/index.php/cajas" class="btn btn-secondary" >
        <i class="fas fa-arrow-left"></i>     
        Regresar </a>
    </form>
</div>
<?= $this->include('templates/footer') ?>
