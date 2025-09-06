<?= $header; ?>

<div class="container mt-2">
  <div class="my-2">
    <h4>Lista de Recursos</h4>
    <a href="<?= base_url("recursos/crear"); ?>" class="btn btn-sm btn-info">Registrar</a>
  </div>

  <div class="table-responsive">
    <table class="table table-sm table-bordered">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Tipo</th>
          <th>Año</th>
          <th>ISBN</th>
          <th>Páginas</th>
          <th>Portada</th>
          <th>Archivo</th>
          <th>Estado</th>
          <th>Categoría</th>
          <th>Subcategoría</th>
          <th>Editorial</th>
          <th>Nacionalidad</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($recursos as $recurso): ?>
        <tr>
          <td><?= $recurso['idrecurso']; ?></td>
          <td><?= $recurso['titulo']; ?></td>
          <td><?= $recurso['tipo']; ?></td>
          <td><?= $recurso['apublicacion']; ?></td>
          <td><?= $recurso['isbn']; ?></td>
          <td><?= $recurso['numpaginas']; ?></td>
          <td>
            <?php if($recurso['rutaportada']): ?>
              <img src="<?= base_url($recurso['rutaportada']); ?>" 
                   alt="Portada" class="img-thumbnail" style="width: 100px;">
            <?php endif; ?>
          </td>
          <td>
            <?php if($recurso['rutarecurso']): ?>
              <a href="<?= base_url($recurso['rutarecurso']); ?>" target="_blank" class="btn btn-sm btn-primary">Ver</a>
            <?php endif; ?>
          </td>
          <td><?= $recurso['estado']; ?></td>
          <td><?= $recurso['categoria']; ?></td>
          <td><?= $recurso['subcategoria']; ?></td>
          <td><?= $recurso['editorial']; ?></td>
          <td><?= $recurso['nacionalidad']; ?></td>
          <td>
            <a href="<?= base_url('recursos/eliminar/'.$recurso['idrecurso']); ?>" 
               class="btn btn-sm btn-danger"
               onclick="return confirm('¿Seguro que deseas eliminar este recurso?');">
              Borrar
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $footer; ?>



