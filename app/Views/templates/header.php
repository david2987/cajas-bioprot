<!DOCTYPE html>
<html>

<head>
    <title>Sistema de Cajas</title>    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="<?= CSS . 'sistema.css' ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link type="text/css" href="<?= JS ?>library/toast/resources/css/jquery.toastmessage.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>    
</head>

<body>
    <header>

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e5e5e5; border-bottom: 0.5px solid #ccc;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"> <img src="<?= IMG_URL . 'Logo-Bioprot-001.jpg' ?>" style="width:211px ;filter: brightness(1.1); mix-blend-mode:multiply "> </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">                    
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link  <?= uri_string() === 'cajas'?'active':'' ; ?>" aria-current="page" href="<?= base_url('index.php/cajas'); ?>">
                                <B><i class="fas fa-box"></i>
                              
                                CAJAS</B></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link   <?= uri_string() === 'categorias'?'active':'' ; ?> " aria-current="page" href="<?= base_url('index.php/categorias'); ?>">
                                <B><i class="fas fa-tags"></i> CATEGORIAS</B></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= uri_string() === 'movimientos'?'active':'' ; ?> " href="<?= base_url('index.php/movimientos'); ?>"><b> <i class="fas fa-sync-alt"></i> MOVIMIENTOS</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= uri_string() === 'usuarios'?'active':'' ; ?>  " aria-current="page" href="<?= base_url('index.php/usuarios'); ?>">
                                <B><i class="fas fa-user"></i> USUARIOS</B></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= uri_string() === 'grupos-usuarios'?'active':'' ; ?>  " aria-current="page" href="<?= base_url('index.php/grupos-usuarios'); ?>">
                                <B><i class="fas fa-users"></i> GRUPOS USUARIOS</B></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= uri_string() === 'permisos'?'active':'' ; ?>  " aria-current="page" href="<?= base_url('index.php/permisos'); ?>">
                                <B><i class="fas fa-key"></i> PERMISOS</B></a>
                        </li>
                        
                    </ul>
                        <div class="btn-danger">
                            <a class="nav-link  " aria-current="page" href="<?= base_url('index.php/auth/logout'); ?>">
                                <B class="text-white">
                                <i class="fas fa-sign-out-alt"></i>
                                     SALIR
                                    </B>
                            </a>
                        </li>
                </div>
            </div>
        </nav>
    </header>
    <div>
        <div class="p-2 " style="background-color: #ccc;color:black" >
            <b class="ml-4">Usuario : <?= session('user_name') ?></b> 
        </div>
        <div class="w-100 "  style="position: fixed; text-align: -webkit-right;" >
            <?php include('message.php'); ?>
        </div>