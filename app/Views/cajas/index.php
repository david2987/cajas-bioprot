<?= $this->include('templates/header') ?>
<div class="container mt-3">
    <h1>Cajas</h1>
    <?php

    use function PHPUnit\Framework\isEmpty;

    if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <form method="get" class="form-inline mb-3">
        <div class="form-group mr-2">
            <input type="text" name="descripcion" class="form-control" placeholder="Descripción" value="<?= $filters['descripcion'] ?? '' ?>">
        </div>
        <div class="form-group mr-2">
            <select name="estado" class="form-control">
                <option value="">Estado de la Caja</option>
                <option value="PENDIENTE" <?= (isset($filters['estado']) && $filters['estado'] == 'PENDIENTE') ? 'selected' : '' ?>>PENDIENTE</option>
                <option value="DISPONIBLE" <?= (isset($filters['estado']) && $filters['estado'] == 'DISPONIBLE') ? 'selected' : '' ?>>DISPONIBLE</option>
                <option value="PARA CONSUMO" <?= (isset($filters['estado']) && $filters['estado'] == 'PARA CONSUMO') ? 'selected' : '' ?>>PARA CONSUMO</option>
            </select>
        </div>
        <button class="btn btn-primary ms-2" type="submit">
            <i class="fas fa-filter"></i>
            Buscar
        </button>
        <a href='<?= base_url('index.php/cajas') ?>' class="btn btn-secondary ms-2">
            <i class="far fa-eye-slash"></i>
            Limpiar
        </a>
        <a href="/cajas/create" class="btn btn-success ms-2">
            <i class="fas fa-plus"></i>
            Agregar Caja</a>

    </form>
    <div class="w-100 mw-100 d-inline">        
        <?= $pager->only(['search', 'order'])->links(); ?>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Nombre de la Caja</th>
                <th>Categoría</th>
                <th>Estado de la Caja</th>
                <th>QR</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cajas as $caja) : ?>
                <tr>
                    <td><img src="<?= $caja['imagen'] ? IMG_UPLOAD . '/' . $caja['imagen'] : IMG_URL . '/default.png' ?>" height="50" width="70"></td>
                    <td><?= $caja['id'] ?></td>
                    <td><?= $caja['nombre_caja'] ?></td>
                    <td><?= $caja['nombre_categoria']  ?></td>
                    <td><?php
                        ?>
                        <?php

                        switch ($caja['estado_caja']) {
                            case 'DISPONIBLE':
                                echo "<i class='fas fa-circle text-success '></i>" . $caja['estado_caja'];
                                break;
                            case 'PENDIENTE':
                                echo "<i class='fas fa-circle text-warning '></i>" . $caja['estado_caja'];
                                break;
                            default:
                                echo "<i class='fas fa-circle text-danger'></i>" . $caja['estado_caja'];
                                break;
                        }
                        ?>
                    </td>
                    <td>
                        <?php if (isset($caja['qr_code'])) {  ?>'
                        <img src='\<?= $caja['qr_code'] ?>' width="60" height="60">
                    <?php } ?>
                    </td>
                    <td><a href="<?= base_url('index.php/movimientos/create/' . $caja['id']) . '/I' ?>" class="btn btn-success"> <i class="fas fa-arrow-up"></i>INGRESO</a></td>
                    <td><a href="<?= base_url('index.php/movimientos/create/' . $caja['id'] . '/E') ?>" class="btn btn-danger"> <i class="fas fa-arrow-down"></i>EGRESO</a></td>
                    <td>
                        <a href="<?= base_url('index.php/movimientos/show/' . $caja['id']) ?>" class="btn btn-light"><i class="fas fa-truck-moving"></i></a>
                        <!-- <a href="<?= base_url('cajas/view/' . $caja['id']) ?>" data-bs-toggle="modal" data-bs-target="#modalMostrar" class="btn btn-light"><i class="fas fa-eye text-primary "></i></a> -->
                        <a href="<?= !empty($caja['contenido']) ? base_url('uploads/contenidos/' . $caja['contenido']) : '#'; ?>" class="btn btn-light" target="<?= !empty($caja['contenido']) ? '_blank' : '' ?> "><i class="fas fa-box-open text-secondary"></i></a>
                        <a href="<?= base_url('cajas/edit/' . $caja['id']) ?>" class="btn btn-light"><i class="fas fa-pen text-info "></i></a>
                        <a href="<?= base_url('cajas/delete/' . $caja['id']) ?>" class="btn btn-light"><i class="fas fa-trash text-danger "></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <div class="w-100 mw-100 d-inline">
        Página
        <?= $pager->only(['search', 'order'])->links(); ?>
    </div>
</div>
<?= $this->include('templates/footer') ?>