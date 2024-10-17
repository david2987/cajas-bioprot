<?= $this->include('templates/header') ?>
<div class="container">
    <h1>Grupos de Usuarios</h1>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <a href="/grupos-usuarios/create" class="btn btn-primary mb-3">Crear Nuevo Grupo</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grupos as $grupo): ?>
                <tr>
                    <td><?= $grupo['id'] ?></td>
                    <td><?= $grupo['descripcion'] ?></td>
                    <td>
                        <a href="/grupos-usuarios/edit/<?= $grupo['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="/grupos-usuarios/delete/<?= $grupo['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar este grupo?')" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->include('templates/footer') ?>
