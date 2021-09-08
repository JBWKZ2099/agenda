@if ($errors->any())
    <!-- Modal -->
    <div class="modal fade" id="myModalAlertErrors" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="h4">Por favor revisa el formulario en busca de errores.</p>
            <ul>
              @foreach($errors->all() as $error)
                <li><p class="h5">{{ $error }}</p></li>
              @endforeach
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <script>
        $(function() {
            $('#myModalAlertErrors').modal('show');
        });
    </script>
@endif

@if ($message = Session::get('success'))
    <!-- Modal -->
    <div class="modal fade" id="myModalAlertSuccess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-success">
            <p class="h4">{{ $message }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <script>
        $(function() {
            $('#myModalAlertSuccess').modal('show');
        });
    </script>
@endif

@if ($message = Session::get('error'))
    <!-- Modal -->
    <div class="modal fade" id="myModalAlertError" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-danger">
            <p class="h4">{{ $message }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <script>
        $(function() {
            $('#myModalAlertError').modal('show');
        });
    </script>
@endif

@if ($message = Session::get('warning'))
    <!-- Modal -->
    <div class="modal fade" id="myModalAlertWarning" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-warning">
            <p class="h4">{{ $message }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <script>
        $(function() {
            $('#myModalAlertWarning').modal('show');
        });
    </script>
@endif

@if ($message = Session::get('info'))
    <!-- Modal -->
    <div class="modal fade" id="myModalAlertInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-info">
            <p class="h4">{{ $message }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <script>
        $(function() {
            $('#myModalAlertInfo').modal('show');
        });
    </script>
@endif
