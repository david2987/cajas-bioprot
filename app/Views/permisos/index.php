<!DOCTYPE html>
<html>
<head>
    <title>Permisos</title>
</head>
<body>
    <h1>Permisos</h1>
    <?php if (session()->getFlashdata('success')): ?>
        <p><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>
    <a href="/permisos/create">Crear Nuevo Permiso</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Grupo de Usuario</th>
                <th>Permiso</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($permisos as $permiso): ?>
                <tr>
                    <td><?= $permiso['id'] ?></td>
                    <td><?= $permiso['grupo_usuario_id'] ?></td>
                    <td><?= $permiso['permiso'] ?></td>
                    <td>
                        <a href="/permisos/edit/<?= $permiso['id'] ?>">Editar</a>
                        <a href="/permisos/delete/<?= $permiso['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar este permiso?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
