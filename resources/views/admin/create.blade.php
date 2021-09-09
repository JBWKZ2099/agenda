@extends('admin.layout.principal')

@section('title', '| '.trans('strings.crud.add').' '.$word)

@section('styles')
@endsection

@section('page-header', trans('strings.crud.add').' '.$word)

@section('card-breadcrumb')
	<ol class="breadcrumb my-4">
			<li class="breadcrumb-item"><a href="{{ URL::to("admin") }}">Dashboard</a></li>
			<li class="breadcrumb-item active"><a href="{{ URL::to("admin/".$active) }}">{{ $word }}</a></li>
			<li class="breadcrumb-item active">{{ trans('strings.crud.add') }} {{ $word1 }}</li>
	</ol>
@endsection

@section('card-title')
	<i class="fa fa-plus fa-fw"></i> {{ trans('strings.crud.add') }} {{ $word1 }}
@endsection

@section('card-body')
	<div class="row">
		<div class="col-sm-12">
			{!! Form::open(['route' => $active.'.store', 'method' => 'post', 'id' => 'formValidation', 'class' => 'form-horizontal', 'files' => true]) !!}
				<div id="rootwizard">
					<ul>
				        @include('admin.modules.'.$active.'.tabs')
				    </ul>
				    <br>
				    <div class="tab-content">
				        @include('admin.modules.'.$active.'.panels')

								<nav>
					        <ul class="pagination pager wizard">
					            <li class="page-item previous">
					                {!! link_to('#', trans('strings.wizard.previous'), ["class"=>"page-link"]) !!}
					            </li>
					            <li class="page-item next ms-auto">
					                {!! link_to('#', trans('strings.wizard.next'), ["class"=>"page-link"]) !!}
					            </li>
					            <li class="page-item next finish ms-auto" style="display:none;">
					                {!! link_to('#', trans('strings.wizard.finish'), ["class"=>"page-link"]) !!}
					            </li>
					        </ul>
								</nav>
				    </div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection

@section('scripts')
	@include('admin.modules.'.$active.'.formvalidation.create')
	{{ Html::script('assets/plugins/bootstrap-wizard/wizard.call.js') }}

  {{-- Dynamic Select --}}
  {{ Html::script("js/dynamic_select_init.js") }}
  {{ Html::script("js/dynamic_select.js") }}
  {{-- Dynamic Checkbox --}}
  {{ Html::script("js/dynamic_checkbox_init.js") }}
  {{ Html::script("js/dynamic_checkbox.js") }}
@endsection
