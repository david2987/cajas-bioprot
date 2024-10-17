<?= $this->include('templates/header') ?>
<div class="container">
    <h1>Detalle de la Caja</h1>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td><?= $caja['id'] ?></td>
        </tr>
        <tr>
            <th>Nombre de la Caja</th>
            <td><?= $caja['nombre_caja'] ?></td>
        </tr>
        <tr>
            <th>Estado de la Caja</th>
            <td><?= $caja['estado_caja'] ?></td>
        </tr>
        <tr>
            <th>Contenido</th>
            <td><?= $caja['contenido'] ?></td>
        </tr>
        <tr>
            <th>Imagen</th>
            <td><img src="/uploads/<?= $caja['imagen'] ?>" alt="Imagen de la caja" width="200"></td>
        </tr>
    </table>
    <a href="/cajas" class="btn btn-secondary">Volver</a>
</div>
<?= $this->include('templates/footer') ?>
