<script>
	rowsArray = $('#datatables tbody').attr("data-rows").split(',');
	final = [];
	$.each(rowsArray, function(i, val){ final.push({data:val, name:val}); });
	final.push({ data:'actions',name:'actions',orderable:false,searchable:false});
	active = $('#datatables tbody').attr("data-active");
	model = $('#datatables tbody').attr("data-model");
	view = $('#datatables tbody').attr("data-view");
	actions = $('#datatables tbody').attr("data-actions");
	ajaxDirection = direction+'/admin/data?model='+model+'&active='+active+'&view='+view+'&actions='+actions;
	@if(\App::getLocale() == 'es')
		language = 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json';
	@else
		language = 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/English.json';
	@endif
	dt = $('#datatables').DataTable({
	  processing: true,
	  serverSide: true,
	  deferRender: true,
	  ajax: {
	    url: ajaxDirection,
	    type: 'POST',
	    headers: {
	        'X-CSRF-TOKEN': "{{ csrf_token() }}",
	    }
	  },
	  columns: final,
	  language: { "url": language },
	  order: [[ 0, "desc" ]],
	  dom: "lftir"
	});
</script>
