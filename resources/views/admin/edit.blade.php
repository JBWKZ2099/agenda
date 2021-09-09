@extends('admin.layout.principal')

@section('title', '| '.trans('strings.crud.edit').' '.$word)

@section('styles')
@endsection

@section('page-header', trans('strings.crud.edit').' '.$word)

@section('card-breadcrumb')
	<ol class="breadcrumb my-4">
			<li class="breadcrumb-item"><a href="{{ URL::to("admin") }}">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="{{ URL::to("admin/".$active) }}">{{ $word }}</a></li>
			<li class="breadcrumb-item active">{{ trans('strings.crud.edit') }} {{ substr($word, 0, -1) }}</li>
	</ol>
@endsection

@section('card-title')
	<i class="far fa-edit fa-fw"></i> {{ trans('strings.crud.edit') }} {{ substr($word, 0, -1) }}
@endsection

@section('card-body')
	<div class="row">
		<div class="col-md-12">
			{!! Form::model($item, ['route' => [$active.'.update', $item], 'method' => 'put', 'id' => 'formValidation', 'class' => 'form-horizontal', 'files' => true]) !!}
				<div id="rootwizard">
					<ul>
						@if($active == 'sales' && Sentinel::getUser()->role_id == 4)
							@include('admin.modules.'.$active.'.tabs-status')
						@else
							@include('admin.modules.'.$active.'.tabs')
						@endif
				    </ul>
				    <br>
				    <div class="tab-content">
						@if($active == 'sales' && Sentinel::getUser()->role_id == 4)
							@include('admin.modules.'.$active.'.panels-status')
						@else
							@include('admin.modules.'.$active.'.panels')
						@endif

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
	@include('admin.modules.'.$active.'.formvalidation.edit')
	{{ Html::script('assets/plugins/bootstrap-wizard/wizard.call.js') }}

    {{-- Dynamic Select --}}
    {{ Html::script("js/dynamic_select.js") }}
    {{-- Dynamic Checkbox --}}
    {{ Html::script("js/dynamic_checkbox.js") }}
@endsection
