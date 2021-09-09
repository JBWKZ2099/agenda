<div id="restore_modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="user_restore_confirm_title">{{ trans('strings.crud.restore') }} {{ substr($word, 0, -1) }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ trans('strings.crud.restore_question') }}
      </div>
      <div class="modal-footer">
          {!! Form::open(['route' => $active.'.restore', 'method' => 'patch']) !!}
              <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('strings.crud.cancel') }}</button>
              {!! Form::hidden('id', null, ['id' => 'id_restore']) !!}
              {!! Form::submit(trans('strings.crud.restore'), ['class' => 'btn btn-warning']) !!}
          {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
<script>
    function restoreModal(id){
        $('#id_restore').val(id);
    }
</script>
