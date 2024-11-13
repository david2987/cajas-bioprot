<?= $this->include('templates/header') ?>
<div class="container">
    <h1>Editar Categoría</h1>
    <form action="/categorias/update/<?= $categoria['id'] ?>" method="post">
    <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre_categoria">Nombre de la Categoría</label>
            <input type="text" name="nombre_categoria" class="form-control" value="<?= $categoria['nombre_categoria'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="/index.php/categorias" class="btn btn-secondary" >Regresar </a>
    </form>
</div>
<?= $this->include('templates/footer') ?>
