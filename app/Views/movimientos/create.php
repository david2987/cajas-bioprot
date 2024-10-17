<?= $this->include('templates/header') ?>
<?php $fcha = date("Y-m-d");?>
<div class="container w-75">
    <div class="d-flex">
        <div class="mt-3">
            <h2>Agregar Movimiento de <?= $tipoEntrada =='I'?"<span class='text-success' >INGRESO</span>":"<span class='text-danger' >SALIDA</span>" ?> de Caja: <?= $caja['nombre_caja'] ?></h2>            
            <br>
        </div>        
    </div>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <form action="/movimientos/store" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="caja_id" value="<?= $caja['id'] ?>">
        <?php if($tipoEntrada =='E'){ ?>            
            <div class="form-group">
                <label for="fecha_salida">Fecha de Salida:</label>
                <input type="date" name="fecha_salida" value="<?php echo $fcha;?>" class="form-control" required>
            </div>
         <?php }else{ ?>          
        <div class="form-group">
            <label for="fecha_entrada">Fecha de Ingreso:</label>
            <input type="date" name="fecha_entrada" value="<?php echo $fcha;?>" class="form-control" required>
        </div>
        <?php } ?>
        <div class="form-group">
            <label for="paciente">Paciente:</label>
            <input type="text" name="paciente" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="medico">Médico:</label>
            <input type="text" name="medico" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="servicio">Servicio:</label>
            <input type="text" name="servicio" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tipo_entrada">Tipo de Entrada:</label>
            <select name="tipo_entrada" class="form-control" required>
                <option  <?= $tipoEntrada==='I'?'selected':'' ?> value="Entrada">Entrada</option>
                <option  <?= $tipoEntrada==='E'?'selected':'' ?> value="Salida">Salida</option>
            </select>
        </div>
        <div class="form-group">
            <label for="momento_retiro">Momento de Retiro:</label>
            <input type="datetime-local" name="momento_retiro" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="usuario_despacho">Usuario Despacho:</label>
            <input type="text" name="usuario_despacho" value="<?= session('user_name') ?>" readonly class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Movimiento</button>
        <a href="/index.php/cajas" class="btn btn-secondary" >Regresar </a>
    </form>
</div>
<?= $this->include('templates/footer') ?>
