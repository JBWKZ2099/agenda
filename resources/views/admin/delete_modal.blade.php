<div id="delete_modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="user_delete_confirm_title">{{ trans('strings.crud.delete') }} {{ substr($word, 0, -1) }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ trans('strings.crud.delete_question') }}
      </div>
      <div class="modal-footer">
          {!! Form::open(['route' => $active.'.delete', 'method' => 'delete']) !!}
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('strings.crud.cancel') }}</button>
              {!! Form::hidden('id', null, ['id' => 'id_delete']) !!}
              {!! Form::submit(trans('strings.crud.delete'), ['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
<script>
    function deleteModal(id){
        $('#id_delete').val(id);
    }
</script>
