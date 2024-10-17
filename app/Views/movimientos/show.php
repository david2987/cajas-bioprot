<?= $this->include('templates/header') ?>
<div class="container">
    <a href="/index.php/cajas" class="btn btn-info text-white m-2  "  >
        Volver a cajas
    </a>

    <h1>Movimientos de Caja</h1>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
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