<?php /* <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mi Veterinaria</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/integrador_veterinaria/estilo.css">
</head>
<body class="d-flex flex-column min-vh-100">


<!-- Encabezado de Mi Veterinaria -->
<nav class="navbar navbar-expand-lg navbar-dark py-3 fondoVerde">
  <div class="container-fluid">
    <a class="navbar-brand navbar-brand-personalizada" href="#">
      Mi Veterinaria
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVet"
      aria-controls="navbarVet" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarVet">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <!-- Dar de Alta con submenu -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="altaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dar de Alta
          </a>
          <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-custom" aria-labelledby="altaDropdown">
            <li><a class="dropdown-item" href="#">Dar de Alta Mascota</a></li>
            <li><a class="dropdown-item" href="<?=base_url('cargar_amo')?>">Dar de Alta Amo</a></li>
            <li><a class="dropdown-item" href="#">Dar de Alta Veterinario</a></li>
          </ul>
        </li>

        <!-- Mostrar con submenu -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="mostrarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Mostrar
          </a>
          <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-custom" aria-labelledby="mostrarDropdown">
            <li><a class="dropdown-item" href="<?=base_url('mostrar_amo')?>">Mostrar Amos</a></li>
            <li><a class="dropdown-item" href="<?=base_url('ver_mascotas')?>">Mostrar Mascotas</a></li>
            <li><a class="dropdown-item" href="<?=base_url('mostrar_veterinario')?>">Mostrar Veterinarios</a></li>
            <li><a class="dropdown-item" href="#">Mostrar Todo</a></li>
          </ul>
        </li>

        <!-- Agendar -->
        <li class="nav-item">
          <a class="nav-link" href="#">Agendar</a>
        </li>

      </ul>
    </div>
  </div>
</nav>

<div class="container cajaBase content-wrapper flex-grow-1">
 */?>

 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/integrador_veterinaria/estilo.css">
</head>
<body>

<!-- Encabezado de Mi Veterinaria -->
<nav class="navbar navbar-expand-lg navbar-dark py-3 fondoVerde">
  <div class="container-fluid">
    <a class="navbar-brand navbar-brand-personalizada" href="<?=base_url('Principal')?>">
      Mi Veterinaria
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVet"
      aria-controls="navbarVet" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarVet">
      <ul class="navbar-nav  ms-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="<?=base_url('mostrar_amo')?>"><i class="fa-solid fa-user me-2"></i></i>Amos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?=base_url('VerMascotas')?>"><i class="fa-solid fa-paw me-2"></i></i>Mascotas</a>
        </li>
         <li class="nav-item">
          <li><a class="nav-link" href="<?=base_url('mostrar_veterinario')?>"><i class="fa-solid fa-user-doctor me-2"></i>Veterinarios</a></li>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container cajaBase">

