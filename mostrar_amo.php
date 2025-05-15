<?=$header;?>

<div class="container mt-4 listadoAmo">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="tituloFormulario m-0">Listado de Amos</h4>

    <div class="d-flex gap-2">
      <!-- Botón agregar amo -->
      <a class="btn botonFormulario" href="<?= base_url('cargar_amo') ?>">+ Nuevo amo</a>

      <!-- Dropdown de orden -->
      <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Ordenar por
        </button>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="<?= base_url('mostrar_amo?orden=apellido_asc') ?>">Apellido A-Z</a></li>
    <li><a class="dropdown-item" href="<?= base_url('mostrar_amo?orden=apellido_desc') ?>">Apellido Z-A</a></li>
    <li><a class="dropdown-item" href="<?= base_url('mostrar_amo?orden=mascotas') ?>">Cantidad de Mascotas</a></li>
    <li><a class="dropdown-item" href="<?= base_url('mostrar_amo?orden=fecha_asc') ?>">Fecha de Alta (Asc)</a></li>
    <li><a class="dropdown-item" href="<?= base_url('mostrar_amo?orden=fecha_desc') ?>">Fecha de Alta (Desc)</a></li>
 
        </ul>
      </div>
    </div>
  </div>

  <?php if (!empty($amos)): ?>
    <?php foreach ($amos as $amo): ?>
      <div class="card mb-3 shadow-sm border-left border-success">
        <div class="card-body">
          <h5 class="card-title mb-3">
            <?= esc($amo['a_apellido']) ?>, <?= esc($amo['a_nombre']) ?>
          </h5>
          <div class="row">
            <div class="col-md-6 mb-2">
              <strong>Nº Cliente:</strong> <?= esc($amo['a_id']) ?>
            </div>
            <div class="col-md-6 mb-2">
              <strong>Teléfono:</strong> <?= esc($amo['a_tel']) ?>
            </div>
            <div class="col-md-12 mb-2">
              <strong>Dirección:</strong> <?= esc($amo['a_dir']) ?>
            </div>
            <?php if (isset($amo['cantidad_mascotas'])): ?>
              <div class="col-md-12 mb-2">
                <strong>Mascotas registradas:</strong> <?= esc($amo['cantidad_mascotas']) ?>
              </div>
            <?php endif; ?>
            <?php if (isset($amo['a_fechaAlta'])): ?>
              <div class="col-md-12 mb-2">
                <strong>Fecha de alta:</strong> <?= esc($amo['a_fechaAlta']) ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="d-flex justify-content-between mt-3">
            <a class="btn btn-outline-primary btn-sm" href="<?= base_url('mascota_de_amo/'.$amo['a_id']) ?>">
              Ver mascotas
            </a>
            <div>
              <a class="btn btn-outline-info btn-sm me-2" href="<?= base_url('editar/'.$amo['a_id']) ?>">Editar</a>
              <a class="btn btn-outline-danger btn-sm" href="<?= base_url('borrar/'.$amo['a_id']) ?>">Borrar</a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="alert alert-info">No hay amos registrados actualmente.</div>
  <?php endif; ?>
</div>

<?=$footer;?>
