<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#{{'modal' . $id}}" title="Delete">
  <i class="fa-solid fa-trash-can"></i>
</button>

<div class="modal" tabindex="-1" id="{{'modal' . $id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Attenzione!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-start">
        <p>Vuoi eliminare il {{$type}}: "{{$name}}"?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <form
        action="{{$route}}"
        method="POST"
        class="d-inline">
        @csrf

        @method('DELETE')

        <button type="submit" class="btn btn-danger" title="Delete">Elimina</button>
      </form>
      </div>
    </div>
  </div>
</div>
