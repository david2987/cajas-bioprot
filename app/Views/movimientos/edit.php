<?= $this->include('templates/header') ?>
<div class="container">
    <h1>Editar Movimiento de Caja</h1>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <form action="/movimientos/update/<?= $movimiento['id'] ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="fecha_salida">Fecha de Salida:</label>
            <input type="date" name="fecha_salida" class="form-control" value="<?= $movimiento['fecha_salida'] ?>" required>
        </div>
        <div class="form-group">
            <label for="fecha_entrada">Fecha de Entrada:</label>
            <input type="date" name="fecha_entrada" class="form-control" value="<?= $movimiento['fecha_entrada'] ?>" required>
        </div>
        <div class="form-group">
            <label for="paciente">Paciente:</label>
            <input type="text" name="paciente" class="form-control" value="<?= $movimiento['paciente'] ?>" required>
        </div>
        <div class="form-group">
            <label for="medico">Médico:</label>
            <input type="text" name="medico" class="form-control" value="<?= $movimiento['medico'] ?>" required>
        </div>
        <div class="form-group">
            <label for="servicio">Servicio:</label>
            <input type="text" name="servicio" class="form-control" value="<?= $movimiento['servicio'] ?>" required>
        </div>
        <div class="form-group">
            <label for="tipo_entrada">Tipo de Entrada:</label>
            <select name="tipo_entrada" class="form-control" required>
                <option value="Entrada" <?= $movimiento['tipo_entrada'] == 'Entrada' ? 'selected' : '' ?>>Entrada</option>
                <option value="Salida" <?= $movimiento['tipo_entrada'] == 'Salida' ? 'selected' : '' ?>>Salida</option>
            </select>
        </div>
        <div class="form-group">
            <label for="momento_retiro">Momento de Retiro:</label>
            <input type="datetime-local" name="momento_retiro" class="form-control" value="<?= $movimiento['momento_retiro'] ?>" required>
        </div>
        <div class="form-group">
            <label for="usuario_despacho">Usuario Despacho:</label>
            <input type="text" name="usuario_despacho" class="form-control" value="<?= $movimiento['usuario_despacho'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Movimiento</button>
    </form>
</div>
<?= $this->include('templates/footer') ?>
