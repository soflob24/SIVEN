<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Panel Adminstrativo</title>
    <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>Assets/DataTables/datatables.min.css"/>
    <link href="<?php echo base_url; ?>Assets/css/estilos.css" rel="stylesheet" />
    <script src="<?php echo base_url; ?>Assets/js/all.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?php echo base_url; ?>Administracion/home">SIVEN</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#cambiarPass">Perfil</a></li>
                    <li>
                        <hr class="dropdown-divider"/>
                    </li>
                    <li><a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir">Cerrar Sesión</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-cogs fa-2x text-primary"></i></div>
                            Administración
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Usuarios"><i class="fa-solid fa-user text-primary"></i>&nbsp; Usuarios</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Administracion"><i class="fa-solid fa-screwdriver-wrench text-primary"></i>&nbsp; Configuración</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCaja" aria-expanded="false" aria-controls="collapseCaja">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-box fa-2x text-primary"></i></div>
                            Cajas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseCaja" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Cajas"><i class="fa-solid fa-box text-primary"></i>&nbsp; Cajas</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Cajas/arqueo"><i class="fa-solid fa-screwdriver-wrench text-primary"></i>&nbsp; Arqueo Caja</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="<?php echo base_url; ?>Clientes">
                            <div class="sb-nav-link-icon"><i class="fas fa-users fa-2x text-primary"></i></div>
                            Clientes
                        </a>
                        <a class="nav-link" href="<?php echo base_url; ?>Proveedores">
                            <div class="sb-nav-link-icon"><i class="fas fa-building fa-2x text-primary"></i></div>
                            Proveedores
                        </a>
                        <a class="nav-link" href="<?php echo base_url; ?>Categorias">
                            <div class="sb-nav-link-icon"><i class="fas fa-tags fa-2x text-primary"></i></div>
                            Categorías
                        </a>
                        <a class="nav-link" href="<?php echo base_url; ?>Productos">
                            <div class="sb-nav-link-icon"><i class="fa-brands fa-product-hunt fa-2x text-primary"></i></div>
                            Productos
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCompras" aria-expanded="false" aria-controls="collapseCompras">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping fa-2x text-primary"></i></div>
                            Entradas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseCompras" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Compras"><i class="fa-solid fa-cart-plus text-primary"></i>&nbsp; Nueva Compra</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Compras/historial"><i class="fa-solid fa-list text-primary"></i>&nbsp; Historial Compras</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVenta" aria-expanded="false" aria-controls="collapseVenta">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-truck fa-2x text-primary"></i></div>
                            Salidas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseVenta" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Compras/ventas"><i class="fa-solid fa-truck-arrow-right text-primary"></i>&nbsp; Nueva Venta</a>
                                <a class="nav-link" href="<?php echo base_url; ?>Compras/historial_ventas"><i class="fa-solid fa-list text-primary"></i>&nbsp; Historial Ventas</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-4">