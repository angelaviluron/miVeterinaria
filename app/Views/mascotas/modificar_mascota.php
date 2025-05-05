<?= $header ?>
      <!--Este codigo agrega un Div que muestra los errores de validacion-->
      <?php if (session()->has('errors')): ?>
                  <div class="alert alert-danger">
                  <ul>
                      <?php foreach (session('errors') as $error): ?>
                      <li><?= esc($error) ?></li>
                      <?php endforeach; ?>
                  </ul>
                  </div>
      <?php endif; ?>
    <div class="card formularioAmo shadow-lg">
      <div class = "card-body">
        <h5 class="card-title mb.4 tituloFormulario">Cargar Mascota</h5>
      <?php
      
        echo form_open(base_url('form/modificarMascota'));
        echo form_hidden('id_mascota',$mascota['m_nroRegistro']);
        echo '<div class="mb-3">';
        echo form_label('Nombre', 'nombre',['class'=>'form-label']);
        echo form_input(array('name'=>'nombre',
                        'id'=>'nombre',
                        'class'=>'form-control inputFormulario',
                        'value'=>$mascota['m_nombre']
                        ));
        echo '</div>';
        echo '<div class="mb-3">';
        echo form_label('Especie: ', 'especie',['class'=>'form-label']);
        echo form_dropdown('especie',[
                            '1'=>'Gato',
                            '2'=>'Perro',
                            '3'=>'Equino',
                            '4'=>'Ave'
                          ],
                          $mascota['m_especie'], // valor por defecto
                          ['class' => 'form-select'],);
        echo '</div>';
        echo '<div class="mb-3">';
        echo form_label('Raza: ', 'raza',['class'=>'form-label']);
        echo form_input(array('name'=>'raza',
                        'id'=>'raza',
                        'class'=>'form-control inputFormulario',
                        'value'=>$mascota['m_raza']
                        ));
        echo '</div>';
        echo '<div class="mb-3">';
        echo form_label('Fecha de Nacimiento: ','fechaN',['class'=>'form-label']);
        echo form_input([
                        'type'=>'date',
                        'name'=>'fechaN',
                        'id'=>'fechaN',
                        'class'=>'form-control inputFormulario',
                        'value'=>$mascota['m_nacimiento']
        ]);
        echo '</div>';
        echo '<div class="mb-3">';
        echo form_submit('enviar','Actualizar',['class'=>'btn botonFormulario w-100']);
        echo form_reset('reset','Limpiar Formulario',['class'=>'btn botonFormulario w-100']);
        echo '</div>';
        echo form_close();
      ?>
      </div>
    </div>

    <?= $footer ?>
