<?=$header;?>

<div class="container mt-4 listadoAmo">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="tituloFormulario m-0">Mascotas del amo</h4>
  </div>

  <?php if (!empty($mascotas)): ?>
    <?php foreach ($mascotas as $mascota): ?>
  <?php 
    $esInactiva = isset($mascota['v_estado']) && $mascota['v_estado'] === '0';
    $claseDeshabilitada = $esInactiva ? 'bg-light text-muted border-secondary opacity-75' : 'border-primary';
  ?>
  <div class="card mb-3 shadow-sm border-left <?= $claseDeshabilitada ?>">
    <div class="card-body">
      <h5 class="card-title mb-3">
        <?= esc($mascota['m_nombre']) ?> (<?= esc($mascota['m_especie']) ?>)
        <?php if ($esInactiva): ?>
          <span class="badge bg-secondary">Inactivo</span>
        <?php endif; ?>
      </h5>
      <div class="row">
        <div class="col-md-6 mb-2">
          <strong>Nro Registro:</strong> <?= esc($mascota['m_nroRegistro']) ?>
        </div>
        <div class="col-md-6 mb-2">
          <strong>Raza:</strong> <?= esc($mascota['m_raza']) ?>
        </div>
        <div class="col-md-6 mb-2">
          <strong>Fecha de Nacimiento:</strong> <?= esc($mascota['m_fechaAlta']) ?>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
  <?php else: ?>
    <div class="alert alert-info">Este amo aún no tiene mascotas registradas.</div>
  <?php endif; ?>
</div>

<?=$footer;?>
