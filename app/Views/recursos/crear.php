<?= $header; ?>
<style>
  .form-control:focus, .form-select:focus {
    background-color: aliceblue;
  }
</style>

<div class="container mt-2">
  <div class="my-2">
    <h4>Registro de Recursos</h4>
    <a href="<?= base_url("recursos"); ?>" class="btn btn-sm btn-secondary">Volver</a>
  </div>

  <form action="<?= base_url('recursos/store'); ?>" method="POST" enctype="multipart/form-data" id="form-recurso">
    <div class="card">
      <div class="card-body">

        <!-- Título y Tipo -->
        <div class="row g-2">
          <div class="col-md-8 mb-2">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
          </div>
          <div class="col-md-4 mb-2">
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo" class="form-select" required>
              <option value="">Seleccione...</option>
              <option value="FISICO">Físico</option>
              <option value="DIGITAL">Digital</option>
            </select>
          </div>
        </div>

        <!-- Año, ISBN, Páginas -->
        <div class="row g-2">
          <div class="col-md-4 mb-2">
            <label for="apublicacion">Año</label>
            <input type="number" class="form-control" id="apublicacion" name="apublicacion" min="1900" max="2099" required>
          </div>
          <div class="col-md-4 mb-2">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn">
          </div>
          <div class="col-md-4 mb-2">
            <label for="numpaginas">Páginas</label>
            <input type="number" class="form-control" id="numpaginas" name="numpaginas">
          </div>
        </div>

        <!-- Estado -->
        <div class="row g-2">
          <div class="col-md-4 mb-2">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
              <option value="">Seleccione...</option>
              <option value="BUENO">Bueno</option>
              <option value="REGULAR">Regular</option>
              <option value="MALO">Malo</option>
            </select>
          </div>
          <!-- Categoría (solo informativa) -->
          <div class="col-md-4 mb-2">
            <label for="categoria">Categoría</label>
            <input type="text" class="form-control" id="categoria" disabled placeholder="Se asigna según Subcategoría">
          </div>
          <!-- Nacionalidad (solo informativa) -->
          <div class="col-md-4 mb-2">
            <label for="nacionalidad">Nacionalidad</label>
            <input type="text" class="form-control" id="nacionalidad" disabled placeholder="Se asigna según Editorial">
          </div>
        </div>

        <!-- Subcategoría y Editorial -->
        <div class="row g-2">
          <div class="col-md-6 mb-2">
            <label for="idsubcategoria">Subcategoría</label>
            <select name="idsubcategoria" id="idsubcategoria" class="form-select" required>
              <option value="">Seleccione...</option>
              <?php foreach($subcategorias as $s): ?>
                <option value="<?= $s['idsubcategoria']; ?>" data-categoria="<?= $s['categoria']; ?>">
                  <?= $s['nombre']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6 mb-2">
            <label for="ideditorial">Editorial</label>
            <select name="ideditorial" id="ideditorial" class="form-select" required>
              <option value="">Seleccione...</option>
              <?php foreach($editoriales as $e): ?>
                <option value="<?= $e['ideditorial']; ?>" data-nacionalidad="<?= $e['nacionalidad']; ?>">
                  <?= $e['empresa']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <!-- Archivos -->
        <div class="row g-2">
          <div class="col-md-6 mb-2">
            <label for="rutaportada">Portada</label>
            <input type="file" class="form-control" id="rutaportada" name="rutaportada" accept="image/*">
          </div>
          <div class="col-md-6 mb-2">
            <label for="rutarecurso">Archivo (si es digital)</label>
            <input type="file" class="form-control" id="rutarecurso" name="rutarecurso" accept=".pdf,.epub,.doc,.docx">
          </div>
        </div>

      </div>

      <div class="card-footer text-end">
        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location.href='<?= base_url('recursos'); ?>'">Cancelar</button>
        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
      </div>
    </div>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const form = document.querySelector("#form-recurso");
  const categoria = document.querySelector("#categoria");
  const nacionalidad = document.querySelector("#nacionalidad");

  // Mostrar categoría automática según subcategoría
  document.querySelector("#idsubcategoria").addEventListener("change", function() {
    let selected = this.options[this.selectedIndex];
    categoria.value = selected.dataset.categoria || '';
  });

  // Mostrar nacionalidad automática según editorial
  document.querySelector("#ideditorial").addEventListener("change", function() {
    let selected = this.options[this.selectedIndex];
    nacionalidad.value = selected.dataset.nacionalidad || '';
  });

  form.addEventListener("submit", function(event) {
    event.preventDefault();

    if (!form.checkValidity()) {
      Swal.fire({
        icon: 'warning',
        title: 'Campos incompletos',
        text: 'Por favor, complete todos los campos obligatorios.'
      });
      return;
    }

    Swal.fire({
      title: "Recursos",
      text: "¿Deseas guardar este recurso?",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí, guardar!",
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  });
});
</script>

<?= $footer; ?>

