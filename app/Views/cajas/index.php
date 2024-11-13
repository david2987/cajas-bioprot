<?= $this->include('templates/header') ?>
<script src="<?= JS ?>cajas/cajas.js"></script>

<div class="gallery" id="galleryContainer"></div>

<div id="carouselModal" class="modal">
    <span class="close" id="closeCarousel">&times;</span>
    <div class="modal-content">
        <button class="prev" onclick="changeSlide(-1)">❮</button>
        <img id="carouselImage" src="" alt="Carousel Image">
        <button class="next" onclick="changeSlide(1)">❯</button>
    </div>
</div>

<!-- Modal Disponibilizacion  -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Disponibilizar Caja</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="formDisponibilizar">
                    <?= csrf_field() ?>
                    <input type="hidden" name="cajaId" id="cajaIdModal" />
                    Va disponibilizar esta caja para ser tomada posteriormente.¿ Desea disponibilizar esta caja ?
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</a>
                <a id="aceptarDisponibilizar" data-bs-dismiss="modal" class="btn btn-success text-white">Aceptar</a>
            </div>
        </div>
    </div>
</div>
<!-- **** -->


<!-- Modal Imagenes  -->
<div class="modal fade" id="ModalImagenes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Imágenes Caja</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Carrousel   -->
                <div id="carouselExample" class="carousel slide text-center">
                    <div class="carousel-inner imagenesCarrousel ">
                        <!-- <div class="carousel-item active"> -->
                            <!-- Hardcode Arreglar -->
                            <!-- <img src="http://localhost:8080/uploads/AP%20246%20-%202.jpg" class="w-75" alt="Image 2"> -->
                        <!-- </div>                         -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" style="background-color: #000;" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" style="background-color: #000;" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!--  -->
            </div>
        </div>
    </div>
</div>
<!-- **** -->


<div class=" mt-3">

    <?php

    if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <div class="container">
        <h1>Cajas</h1>
        <div class="p-2 ">
            <form method="get" class="form-inline mb-3">
                <div class="form-group mr-2">
                    <input type="text" name="descripcion" class="form-control" placeholder="Descripción" value="<?= $filters['descripcion'] ?? '' ?>">
                </div>
                <div class="form-group mr-2">
                    <select name="estado" class="form-select">
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
                <a href='<?= base_url('index.php/cajas') ?>' class="btn btn-dark ms-2">
                    <i class="fas fa-ban"></i>
                    Limpiar
                </a>
                <a href="/cajas/create" class="btn btn-success ms-2">
                    <i class="fas fa-plus"></i>
                    Agregar Caja
                </a>
            </form>
        </div>
        <div class="w-100 text-right mb-2 ">

        </div>
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
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cajas as $caja) : ?>
                <tr>
                    <td>
                        <a href="#" class="verImagen" data-bs-toggle="modal" data-bs-target="#ModalImagenes" data-id="<?= $caja['id'] ?>">
                            <img src="<?= $caja['imagen'] ? IMG_UPLOAD . '/' . $caja['imagen'] : IMG_URL . '/default.png' ?>" height="50" width="70">
                        </a>
                    </td>
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
                        <?php if (isset($caja['qr_code'])) {  ?>
                            <img src='<?= $caja['qr_code'] ?>' width="60" height="60">
                        <?php } ?>
                    </td>
                    <td><a href="<?= base_url('index.php/movimientos/create/' . $caja['id']) . '/I' ?>" class="btn btn-success"> <i class="fas fa-arrow-up"></i> INGRESO</a></td>
                    <td><a href="<?= base_url('index.php/movimientos/create/' . $caja['id'] . '/E') ?>" class="btn btn-danger"> <i class="fas fa-arrow-down"></i> EGRESO</a></td>
                    <td>
                        <?php
                        if ($caja['estado_caja'] != 'DISPONIBLE') {
                        ?>
                            <a data-url="<?= base_url('cajas/disponibilizar') ?>" data-id="<?= $caja['id'] ?>" class="btn btn-primary buttonDisponibilizar text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-check-square text-white " title="Disponibilizar Caja"></i> DISPONIBILIZAR </a>
                        <?php } else { ?>
                            <span class="btn btn-secondary text-white "><i class="fas fa-check-square text-white " title="Disponibilizar Caja"></i> DISPONIBILIZAR </span>
                        <?php } ?>
                    </td>
                    <td><a href="<?= base_url('index.php/movimientos/show/' . $caja['id']) ?>" class="btn btn-light"><i class="fas fa-truck-moving"></i></a></td>
                    <td><a href="<?= !empty($caja['contenido']) ? base_url('uploads/contenidos/' . $caja['contenido']) : '#'; ?>" class="btn btn-light" target="<?= !empty($caja['contenido']) ? '_blank' : '' ?> "><i class="fas fa-box-open text-secondary"></i></a></td>
                    <td><a href="<?= base_url('cajas/edit/' . $caja['id']) ?>" class="btn btn-light"><i class="fas fa-pen text-info "></i></a></td>
                    <!-- <a href="<?= base_url('cajas/view/' . $caja['id']) ?>" data-bs-toggle="modal" data-bs-target="#modalMostrar" class="btn btn-light"><i class="fas fa-eye text-primary "></i></a> -->
                    <td><a href="<?= base_url('cajas/delete/' . $caja['id']) ?>" class="btn btn-light"><i class="fas fa-trash text-danger "></i></a></td>


                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <div class="w-100 mw-100 d-inline ml-4">
        Páginas
        <div class="ml-4">
            <?= $pager->only(['search', 'order'])->links(); ?>
        </div>
    </div>
</div>
<?= $this->include('templates/footer') ?>