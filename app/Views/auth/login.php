<?= $this->include('templates/header_login') ?>
<div class="container " style="margin-top: 15vh;">
    <div class="row justify-content-center ">
        <div class="col-md-6">
            <h1 class="text-center">Iniciar Sesión</h1>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <form action="/auth/authenticate" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="contrasena" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</div>
<?= $this->include('templates/footer_login') ?>
