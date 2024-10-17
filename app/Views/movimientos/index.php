<?= $this->include('templates/header') ?>
<div class="container">
    <h1>Movimientos de Cajas</h1>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <form method="get" class="form-inline mb-3">
        <div class="form-group mr-2">
            <input type="date" name="fecha_salida" class="form-control" placeholder="Fecha de Salida" value="<?= $filters['fecha_salida'] ?? '' ?>">
        </div>
        <div class="form-group mr-2">
            <input type="date" name="fecha_entrada" class="form-control" placeholder="Fecha de Entrada" value="<?= $filters['fecha_entrada'] ?? '' ?>">
        </div>
        <div class="form-group mr-2">
            <input type="text" name="paciente" class="form-control" placeholder="Paciente" value="<?= $filters['paciente'] ?? '' ?>">
        </div>
        <div class="form-group mr-2">
            <input type="text" name="medico" class="form-control" placeholder="Médico" value="<?= $filters['medico'] ?? '' ?>">
        </div>
        <div class="form-group mr-2">
            <input type="text" name="servicio" class="form-control" placeholder="Servicio" value="<?= $filters['servicio'] ?? '' ?>">
        </div>
        <div class="form-group mr-2">
            <select name="tipo_entrada" class="form-control">
                <option value="">Tipo de Entrada</option>
                <option value="Entrada" <?= (isset($filters['tipo_entrada']) && $filters['tipo_entrada'] == 'Entrada') ? 'selected' : '' ?>>Entrada</option>
                <option value="Salida" <?= (isset($filters['tipo_entrada']) && $filters['tipo_entrada'] == 'Salida') ? 'selected' : '' ?>>Salida</option>
            </select>
        </div>
        <div class="form-group mr-2">
            <input type="text" name="momento_retiro" class="form-control" placeholder="Momento de Retiro" value="<?= $filters['momento_retiro'] ?? '' ?>">
        </div>
        <div class="form-group mr-2">
            <input type="text" name="usuario_despacho" class="form-control" placeholder="Usuario Despacho" value="<?= $filters['usuario_despacho'] ?? '' ?>">
        </div>
        <button class="btn btn-primary ms-2" type="submit">
            <i class="fas fa-filter"></i>
            Buscar
        </button>
        <a href='<?= base_url('caja') ?>' class="btn btn-secondary ms-2">
            <i class="far fa-eye-slash"></i>
            Limpiar
        </a>
    </form>
    <!-- <a href="/movimientos/create" class="btn btn-primary mb-3">Crear Nuevo Movimiento</a> -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha de Salida</th>
                <th>Fecha de Entrada</th>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Servicio</th>
                <th>Tipo de Entrada</th>
                <th>Momento de Retiro</th>
                <th>Usuario Despacho</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movimientos as $movimiento) : ?>
                <tr>
                    <td><?= $movimiento['id'] ?></td>
                    <td><?= $movimiento['fecha_salida'] ?></td>
                    <td><?= $movimiento['fecha_entrada'] ?></td>
                    <td><?= $movimiento['paciente'] ?></td>
                    <td><?= $movimiento['medico'] ?></td>
                    <td><?= $movimiento['servicio'] ?></td>
                    <td><?= $movimiento['tipo_entrada'] ?></td>
                    <td><?= $movimiento['momento_retiro'] ?></td>
                    <td><?= $movimiento['usuario_despacho'] ?></td>                   
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links() ?>
</div>
<?= $this->include('templates/footer') ?>