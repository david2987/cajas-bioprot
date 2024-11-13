<?= $this->include('templates/header_external') ?>
<style>
    .surgery-box-card {

        display: flex;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .surgery-box-image {
        width: 40%;
        object-fit: cover;
    }

    .surgery-box-content {
        padding: 20px;
        flex: 1;
    }

    .btn-group-custom {
        display: flex;
        width: 70%;
        gap: 10px;
    }
</style>
</head>

<body>
    <div class="container-fluid mt-5 p-5">
        <div class="surgery-box-card">
            <!-- Imagen de la caja de cirugía -->
            
            <div id="carouselExample" class="carousel slide w-25 mt-5">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?= $caja['imagen'] ? IMG_UPLOAD . '/' . $caja['imagen'] : IMG_URL . '/default.png' ?>" class="surgery-box-image d-block w-100" alt="Caja de cirugía">
                    </div>
                    <div class="carousel-item">
                    <img src="<?= $caja['imagen'] ? IMG_UPLOAD . '/' . $caja['imagen'] : IMG_URL . '/default.png' ?>" class="surgery-box-image d-block w-100" alt="Caja de cirugía">
                    </div>
                    <div class="carousel-item">
                    <img src="<?= $caja['imagen'] ? IMG_UPLOAD . '/' . $caja['imagen'] : IMG_URL . '/default.png' ?>" class="surgery-box-image d-block w-100" alt="Caja de cirugía">
                    </div>
                </div>
                <button class="carousel-control-prev" style="color: #000;" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon "  aria-hidden="true"></span>
                    <span class="visually-hidden" >Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- Contenido de la caja -->
            <div class="surgery-box-content ">
                <h3 class="mb-3 text-center " > <?= $caja['nombre_caja'] ?></h3>

                <p class="text-muted">
                <ul class="list-group">
                    <li class="list-group-item"><b>ID</b> : <?= $caja['id'] ?> </li>
                    <li class="list-group-item"><b>Categoria</b> : <?= $caja['nombre_categoria'] ?> </li>
                    <li class="list-group-item"><b>Estado</b> :
                        <?php
                        switch ($caja['estado_caja']) {
                            case 'DISPONIBLE':
                                echo "<i class='fas fa-circle text-success '></i> <span class='text-success'> " . $caja['estado_caja'] . "</span>";
                                break;
                            case 'PENDIENTE':
                                echo "<i class='fas fa-circle text-warning '></i> <span class='text-warning'>" . $caja['estado_caja'] . "</span>";
                                break;
                            default:
                                echo "<i class='fas fa-circle text-danger'></i> <span class='text-danger'> " . $caja['estado_caja'] . "</span>";
                                break;
                        }
                        ?>
                    </li>
                </ul>
                <div class="w-100">
                    <br>
                    <h2 class="ml-1" style="font-weight: bold; font-size: medium; ">Código QR</h2>
                    <img src="<?= base_url('uploads/qr_codes/' . $caja['id'] . '.png') ?>" style="width: 200px;height: 200px;margin-top: 16px;">
                </div>
                </p>

                <!-- Botones de acción -->
                <div class="btn-group-custom mt-4 text-center d-grid ">
                    <a class="btn btn-primary w-100 text-white" href="<?= !empty($caja['contenido']) ? base_url('uploads/contenidos/' . $caja['contenido']) : '#'; ?>" class="btn btn-light" target="<?= !empty($caja['contenido']) ? '_blank' : '' ?>" >
                        <i class="fa fa-file-pdf" aria-hidden="true"></i> Ver PDF
                    </a>
                    <button class="btn btn-warning w-100">
                        <i class="fa fa-wrench" aria-hidden="true"></i> Actualizar
                    </button>
                    <button class="btn btn-danger w-100">
                        <i class="fa fa-flag" aria-hidden="true"></i> Reportar Caja
                    </button>
                </div>
                <!-- Detalle de Caja -->
                <!-- <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Detalle de Caja
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>                     
                    </div> -->
            </div>
        </div>
    </div>
    </div>