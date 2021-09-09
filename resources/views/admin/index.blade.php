@extends('admin.layout.principal')

@section('title', '| '.$word)

@section('styles')
@endsection

@section('page-header', $word)

@section('card-breadcrumb')
	<ol class="breadcrumb my-4">
			<li class="breadcrumb-item"><a href="{{ URL::to("admin") }}">Dashboard</a></li>
			<li class="breadcrumb-item active">{{ $word }}</li>
	</ol>
@endsection

@section('card-title')
	<i class="fa fa-list fa-fw"></i> {{ $word }}
@endsection

@section('card-body')
	{{ Form::token() }}
	@include('admin.modules.datatable')
	@if($actions == 1 || $actions == 3 || $actions == 4 || $actions == 7)
		@include('admin.delete_modal')
	@endif

	@if( Request::is("admin/schedules") )
		<div class="mt-3">
			{!! Form::button(trans('strings.crud.add')." ".trans('module_schedules.module_title_s'), ["id"=>"toggle-schedules-form", "class"=>"btn btn-success"]) !!}

			<div id="create-container" class="my-3" style="display:none">
				{!! Form::open(['route' => $active.'.store', 'method' => 'post', 'id' => 'formValidation', 'class' => 'form-horizontal', 'files' => true]) !!}
					@include("admin.modules.schedules.form.index")

					<div class="row">
						<div class="col-md-12">
							{!! Form::button(trans("validation.attributes.save"), ["id"=>"schedules-ajax", "class"=>"btn btn-primary float-end"]) !!}
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	@endif
@endsection

@section('scripts')
	{{-- DataTables --}}
	@include('plugins.datatables.dataTables')

	{{-- Schedule Form Validation --}}
	@if( Request::is("admin/schedules") )
		@include('admin.modules.'.$active.'.formvalidation.create')
	@endif
@endsection
