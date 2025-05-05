<?= $header ?>

<div class="container mt-4 listadoAmo">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="tituloFormulario m-0">Listado de Amos</h4>
        <a class="btn botonFormulario" href="<?= base_url('CargarMascota') ?>">+ Nueva Mascota</a>
    </div>

    <?php if (empty($mascotas)) { ?>            
        <div class="alert alert-info">No hay mascotas registradas.</div>
        <div class="text-center">
            ¿Quieres cargar una? 
            <a href="<?= base_url('index.php/CargarMascota') ?>" class="btn btn-outline-secondary">¡Haz click Aquí!</a>
        </div>
    <?php } else { ?>
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
                                <a href="<?= base_url('ModificarMascota/' . $mascota['m_nroRegistro']) ?>" class="btn btn-sm btn-outline-info me-2">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>

<?= $footer ?>