<?= $header ?>

      <?php if (session()->has('errors')): ?>
                  <div class="alert alert-danger">
                  <ul>
                      <?php foreach (session('errors') as $error): ?>
                      <li><?= esc($error) ?></li>
                      <?php endforeach; ?>
                  </ul>
                  </div>
      <?php endif; ?>

<?= form_open_multipart(base_url('guardarAmoMascota')) ?>

<div class="row">
  <!-- Columna del Amo -->
  <div class="col-md-6">
    <h5>Datos del Amo</h5>

    <div class="mb-3">
      <?= form_label('Nombre', 'a_nombre', ['class' => 'form-label']) ?>
      <?= form_input([
        'name' => 'a_nombre',
        'id' => 'a_nombre',
        'class' => 'form-control inputFormulario'
      ]) ?>
    </div>

    <div class="mb-3">
      <?= form_label('Apellido', 'a_apellido', ['class' => 'form-label']) ?>
      <?= form_input([
        'name' => 'a_apellido',
        'id' => 'a_apellido',
        'class' => 'form-control inputFormulario'
      ]) ?>
    </div>

    <div class="mb-3">
      <?= form_label('Dirección', 'a_dir', ['class' => 'form-label']) ?>
      <?= form_input([
        'name' => 'a_dir',
        'id' => 'a_dir',
        'class' => 'form-control inputFormulario'
      ]) ?>
    </div>

    <div class="mb-3">
      <?= form_label('Teléfono', 'a_tel', ['class' => 'form-label']) ?>
      <?= form_input([
        'name' => 'a_tel',
        'id' => 'a_tel',
        'type' => 'tel',
        'class' => 'form-control inputFormulario'
      ]) ?>
    </div>
  </div>

  <!-- Columna de la Mascota -->
  <div class="col-md-6">
    <h5>Datos de la Mascota</h5>

    <div class="mb-3">
      <?= form_label('Nombre', 'nombre', ['class' => 'form-label']) ?>
      <?= form_input([
        'name' => 'nombre',
        'id' => 'nombre',
        'class' => 'form-control inputFormulario',
        'placeholder' => 'Nombre'
      ]) ?>
    </div>

    <div class="mb-3">
      <?= form_label('Especie', 'especie', ['class' => 'form-label']) ?>
      <?= form_dropdown('especie', [
        '1' => 'Gato',
        '2' => 'Perro',
        '3' => 'Equino',
        '4' => 'Ave'
      ], '', ['class' => 'form-select']) ?>
    </div>

    <div class="mb-3">
      <?= form_label('Raza', 'raza', ['class' => 'form-label']) ?>
      <?= form_input([
        'name' => 'raza',
        'id' => 'raza',
        'class' => 'form-control inputFormulario',
        'placeholder' => 'Raza'
      ]) ?>
    </div>

    <div class="mb-3">
      <?= form_label('Fecha de Nacimiento', 'fechaN', ['class' => 'form-label']) ?>
      <?= form_input([
        'type' => 'date',
        'name' => 'fechaN',
        'id' => 'fechaN',
        'class' => 'form-control inputFormulario'
      ]) ?>
    </div>
  </div>
</div>

<!-- Botones -->
<div class="row mt-4">
  <div class="col-md-6">
    <?= form_submit('enviar', 'Guardar', ['class' => 'btn botonFormulario w-100']) ?>
  </div>
  <div class="col-md-6">
    <?= form_reset('reset', 'Limpiar Formulario', ['class' => 'btn botonFormulario w-100']) ?>
  </div>
</div>

<?= form_close() ?>

<?= $footer ?>