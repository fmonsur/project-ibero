<div class="modal fade" id="editar-porcentaje" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar porcentaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="hidden" id="id_perfil">
          <input type="hidden" id="id_especialidad">
          <input type="hidden" id="id_usuario_proyecto">
          <input type="hidden" id="id_usuario">
          <input type="hidden" id="es_direccion">
          <input type="number" id="nuevo_porcentaje" min="0" max="100">
        </div>
        <div id="contenedor_mensaje_error">
          <p id="mensaje_error" class="text-danger"></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="editarPorcentaje()">Guardar porcentaje</button>
      </div>
    </div>
  </div>
</div>