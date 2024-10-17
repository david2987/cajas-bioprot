<?= $this->include('templates/header') ?>
<div class="container mt-3">
    <h1>Categorías</h1>
    <div class="w-100 container text-right mb-3 ">
        <a href="/categorias/create" class="btn btn-success ms-2">
            <i class="fas fa-plus"></i>
            Agregar Categoría</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr class="bg-light" >
                <th>ID</th>
                <th>Nombre de la Categoría</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <td><?= $categoria['id'] ?></td>
                    <td><?= $categoria['nombre_categoria'] ?></td>
                    <td>
                        <a href="<?= base_url('categorias/edit/' . $categoria['id']) ?>" class="btn btn-light"><i class="fas fa-pen text-primary "></i></a>
                        <a href="<?= base_url('categorias/delete/' . $categoria['id']) ?>"  onclick="return confirm('¿Estás seguro de eliminar esta categoría?')" class="btn btn-light"><i class="fas fa-trash text-danger "></i></a>
                        
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->include('templates/footer') ?>