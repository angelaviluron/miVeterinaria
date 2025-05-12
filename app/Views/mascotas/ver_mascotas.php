<?= $header ?>

<div class="container mt-4 listadoAmo">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="tituloFormulario m-0">Listado de mascotas</h4>
        <a class="btn botonFormulario" href="<?= base_url('CargarMascota') ?>">+ Nueva Mascota</a>
    </div>

    <?php if (empty($mascotas)) { ?>            
        <div class="alert alert-info">No hay mascotas registradas.</div>
        <div class="text-center">
            ¿Quieres cargar una? 
            <a href="<?= base_url('index.php/CargarMascota') ?>" class="btn btn-outline-secondary">¡Haz click Aquí!</a>
        </div>
    <?php } else { ?>

              <?php if (session()->has('errors')): ?>
                  <div class="alert alert-danger">
                  <ul>
                      <?php foreach (session('errors') as $error): ?>
                      <li><?= esc($error) ?></li>
                      <?php endforeach; ?>
                  </ul>
                  </div>
      <?php endif; ?>
        <div class="table-responsive shadow-sm border rounded">
            <table class="table table-striped table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nº Registro</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Especie</th>
                        <th scope="col">Raza</th>
                        <th scope="col">Fecha de Nacimiento</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mascotas as $mascota): ?>
                        <tr>
                            <th scope="row"><?= $mascota['m_nroRegistro'] ?></th>
                            <td><?= $mascota['m_nombre'] ?></td>
                            <td>
                                <?php 
                                    switch ($mascota['m_especie']) {
                                        case '1': echo 'Gato'; break;
                                        case '2': echo 'Perro'; break;
                                        case '3': echo 'Equino'; break;
                                        case '4': echo 'Ave'; break;
                                        default: echo 'Otro'; break;
                                    }
                                ?>
                            </td>
                            <td><?= $mascota['m_raza'] ?></td>
                            <td><?= $mascota['m_nacimiento'] ?></td>
                            <td>
                                <a class="btn btn-sm btn-outline-info me-2">Ver Amos</a>
                                <?php if($mascota['m_fechaBaja'] == '0000-00-00'){ ?>

                                <a href="<?= base_url('ModificarMascota/' . $mascota['m_nroRegistro']) ?>" class="btn btn-sm btn-outline-info me-2">Editar</a>
                                <button type="button" class="btn btn-sm btn-outline-info me-2" data-bs-toggle="modal" data-bs-target="#adoptarModal" onclick="setMascotaId('<?php echo $mascota['m_nroRegistro']; ?>')">
                                    Adoptar
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger me-2" data-bs-toggle="modal" data-bs-target="#darBajaModal" onclick="setMascotaBajaId('<?php echo $mascota['m_nroRegistro']; ?>')">
                                    Dar de baja
                                </button>

                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>
                                <!--Modal adopcion-->
<div class="modal fade" id="adoptarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Adoptar Mascota</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <div class="modal-body">
        <?php
            foreach ($amos as $amo) {
                $options[$amo['a_id']] = $amo['a_nombre'] .' '. $amo['a_apellido'];
            }
            echo form_open(base_url('form/adoptarMascota'));
            echo '<input type="hidden" name="idMascota" id="idInputMascota" value="">';
            echo form_label('Futuro dueño', 'idAmo', ['class' => 'form-label']);
            echo form_dropdown('idAmo', $options, '', [
                'id' => 'idAmo',
                'class' => 'form-select inputFormulario',
            ]);
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-info me-2" data-bs-dismiss="modal">Cerrar</button>
        <?php 
            echo form_submit('enviar','Adoptar',['class'=>'btn btn-sm btn-outline-info me-2']);
            echo form_close(); 
        ?>
      </div>
    </div>
  </div>
</div>
                    <!--fin modal adopcion-->
                    <!--modal baja-->
<div class="modal fade" id="darBajaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Dar de baja la relacion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <div class="modal-body">
        <?php
            echo form_open(base_url('form/darBaja'));
            echo '<input type="hidden" name="idMascota" id="idInputMascotaBaja" value="">';
            echo form_label('Motivo');
            echo form_dropdown(
                'motivo',[
                    '1'=>'Fallecio',
                    '2'=>'Abandono',
                    '3'=>'Venta'
                ],'',
                ['class'=>'form-control mb2']
            );
        
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-info me-2" data-bs-dismiss="modal">Cerrar</button>
        <?php 
            echo form_submit('enviar','Confirmar',['class'=>'btn btn-sm btn-outline-info me-2']);
            echo form_close(); 
        ?>
      </div>
    </div>
  </div>
</div>

<script>
    function setMascotaId(id) {
        document.getElementById('idInputMascota').value = id;
      }
    function setMascotaBajaId(id) {
        document.getElementById('idInputMascotaBaja').value = id;
    }
</script>
<?= $footer ?>
