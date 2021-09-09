@extends('admin.layout.principal')

@section('title', '| '.trans('strings.crud.restore').' '.$word)

@section('styles')
@endsection

@section('page-header', trans('strings.crud.restore').' '.$word)

@section("card-breadcrumb")
	<ol class="breadcrumb my-4">
			<li class="breadcrumb-item"><a href="{{ URL::to("admin") }}">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="{{ URL::to("admin/".$active) }}">{{ $word }}</a></li>
			<li class="breadcrumb-item active">{{ trans('strings.crud.restore') }} {{ $word1 }}</li>
	</ol>
@endsection

@section('card-title')
	<i class="fa fa-list fa-fw"></i> {{ trans('strings.crud.restore') }} {{ $word1 }}
@endsection

@section('card-body')
	@include('admin.modules.datatable')
	@include('admin.restore_modal')
@endsection

@section('scripts')
	{{-- DataTables --}}
	@include('plugins.datatables.dataTables')
@endsection
