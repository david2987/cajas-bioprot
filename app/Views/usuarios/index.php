<?= $this->include('templates/header') ?>
<div class="container">
    <h1>Usuarios</h1>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <form method="get" class="form-inline mb-3">
        <div class="form-group mr-2">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?= $filters['nombre'] ?? '' ?>">
        </div>
        <div class="form-group mr-2">
            <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $filters['email'] ?? '' ?>">
        </div>
        <div class="form-group mr-2">
            <select name="habilitado" class="form-control">
                <option value="">Habilitado</option>
                <option value="1" <?= (isset($filters['habilitado']) && $filters['habilitado'] == '1') ? 'selected' : '' ?>>Sí</option>
                <option value="0" <?= (isset($filters['habilitado']) && $filters['habilitado'] == '0') ? 'selected' : '' ?>>No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>
    <a href="/usuarios/create" class="btn btn-primary mb-3">Crear Nuevo Usuario</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de Usuario</th>
                <th>Email</th>
                <th>Habilitado</th>
                <th>Grupo de Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= $usuario['nombre_usuario'] ?></td>
                    <td><?= $usuario['email'] ?></td>
                    <td><?= $usuario['habilitado'] ? 'Sí' : 'No' ?></td>
                    <td><?= $usuario['grupo_usuario_id'] ?></td>
                    <td>
                        <a href="/usuarios/edit/<?= $usuario['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="/usuarios/delete/<?= $usuario['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar este usuario?')" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links() ?>
</div>
<?= $this->include('templates/footer') ?>
