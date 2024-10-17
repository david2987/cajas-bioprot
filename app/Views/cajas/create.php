<?= $this->include('templates/header') ?>

<div>
    <dialog id="modalImagenes">
        <div class="header">
            <div class="row">
                <div class="col-11">
                    Agregar Imágenes a Caja
                </div>
                <div class="col-1">
                    <i class="fas fa-times cerrar"></i>
                </div>
            </div>
        </div>
        <div class="body">         
               <h2>Agregar Imágenes :</h2> 
                <form action="/cajas/agregarImagenesCaja" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" value=""
                    <div class="form-group">
                        <label>Puede seleccionar varias Imágenes</label>
                        <input type="file" name="images[]" multiple class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">
                    <i class="fas fa-check"></i>    
                    Agregar</button>
                    <a href="#" class="btn btn-danger cerrar"> <i class="fas fa-times"></i> Cerrar</a>
                </form>            
        </div>
        <!-- <a href="#" class="btn btn-success">
            <i class="fas fa-check"></i> Aceptar</a> -->

    </dialog>
</div>

<div class="container">
    <h1>Agregar Caja</h1>
    <br>
    <form action="/cajas/store" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nombre_caja">Nombre de la Caja</label>
            <input type="text" class="form-control" name="nombre_caja" required>
        </div>

        <div class="form-group">
            <label for="estado_caja">Estado de la Caja</label>
            <select name="estado_caja" class="form-control" required readonly>
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="DISPONIBLE" selected>DISPONIBLE</option>
                <option value="PARA CONSUMO">PARA CONSUMO</option>
            </select>
        </div>

        <div class="form-group">
            <label for="contenido">Contenido</label>
            <input type="file" name="contenido" class="form-control" />
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" class="form-control" required>
                <option value="" selected>Seleccione categoria</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id'] ?>" <?= isset($caja) && $caja['categoria_id'] == $categoria['id'] ? 'selected' : '' ?>>
                        <?= $categoria['nombre_categoria'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="imagen">Imagen Principal</label>
            <input type="file" class="form-control" name="imagen">
            <br>
        </div>

        <div class="form-group mb-5">
            <a href="#" id="addImagenes" class="btn btn-primary">
                <i class="fas fa-image"></i>
                Agregar Imágenes
            </a>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i>
            Guardar </button>
        <a href="/index.php/cajas" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Regresar </a>

    </form>
</div>
<script src="<?= JS ?>/cajas/cajasCreate.js"></script>

<?= $this->include('templates/footer') ?>