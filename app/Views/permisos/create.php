<!DOCTYPE html>
<html>
<head>
    <title>Crear Permiso</title>
</head>
<body>
    <h1>Crear Permiso</h1>
    <?php if (session()->getFlashdata('error')): ?>
        <p><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>
    <form action="/permisos/store" method="post">
        <?= csrf_field() ?>
        <label for="grupo_usuario_id">Grupo de Usuario:</label>
        <select name="grupo_usuario_id">
            <?php foreach ($grupos as $grupo): ?>
                <option value="<?= $grupo['id'] ?>"><?= $grupo['descripcion'] ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="permiso">Permiso:</label>
        <input type="text" name="permiso" required>
        <br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
