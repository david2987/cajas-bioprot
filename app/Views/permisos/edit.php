<!DOCTYPE html>
<html>
<head>
    <title>Editar Permiso</title>
</head>
<body>
    <h1>Editar Permiso</h1>
    <?php if (session()->getFlashdata('error')): ?>
        <p><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>
    <form action="/permisos/update/<?= $permiso['id'] ?>" method="post">
        <?= csrf_field() ?>
        <label for="grupo_usuario_id">Grupo de Usuario:</label>
        <select name="grupo_usuario_id">
            <?php foreach ($grupos as $grupo): ?>
                <option value="<?= $grupo['id'] ?>" <?= $permiso['grupo_usuario_id'] == $grupo['id'] ? 'selected' : '' ?>><?= $grupo['descripcion'] ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="permiso">Permiso:</label>
        <input type="text" name="permiso" value="<?= $permiso['permiso'] ?>" required>
        <br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
