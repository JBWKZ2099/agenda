<div class="form-group row mb-3 {{ $errors->first('name') ? 'has-error' : '' }}">
    {!! Form::label('name', trans('validation.attributes.name').' *', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name'), ['id' => 'name', 'class' => 'form-control', 'placeholder' => trans('validation.attributes.name')]) !!}
        <span class="help-block">{{ $errors->first('name', ':message') }}</span>
    </div>
</div>

<div class="form-group row mb-3 {{ $errors->first('email') ? 'has-error' : '' }}">
    {!! Form::label('email', trans('validation.attributes.email').' *', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('email', old('email'), ['id' => 'email', 'class' => 'form-control', 'placeholder' => trans('validation.attributes.email')]) !!}
        <span class="help-block">{{ $errors->first('email', ':message') }}</span>
    </div>
</div>

<div class="form-group row mb-3 {{ $errors->first('phone') ? 'has-error' : '' }}">
    {!! Form::label('phone', trans('validation.attributes.phone').' *', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('phone', old('phone'), ['id' => 'phone', 'class' => 'form-control', 'placeholder' => trans('validation.attributes.phone')]) !!}
        <span class="help-block">{{ $errors->first('phone', ':message') }}</span>
    </div>
</div>

<div class="form-group text-center mb-3">
    <button id="add-phone" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
    {!! Form::hidden("counter", $item ? count($phones) : 1, ["id"=>"phones_counter"]) !!}
</div>

<div id="phones-container" style="{{ count($phones)>0 ? "" : "display:none;" }}">
    @foreach( $phones as $phone )
        <div id="{{ (($loop->index)+1) }}" class="form-group row mb-3 {{ $errors->first('phone') ? 'has-error' : '' }}">
            {!! Form::label('phone', trans('validation.attributes.phone').' *', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('phones['.(($loop->index)+1).']', $phone->phone, ['id' => 'phone_'.(($loop->index)+1), 'class' => 'form-control', 'placeholder' => trans('validation.attributes.phone')]) !!}
                <span class="help-block">{{ $errors->first('phone', ':message') }}</span>
            </div>
            <div class="col-sm-1 text-center">
                <button onClick="removePhone({{ (($loop->index)+1) }})" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            </div>
        </div>
    @endforeach
</div>

<div class="form-group row mb-3 {{ $errors->first('address') ? 'has-error' : '' }}">
    {!! Form::label('address', trans('validation.attributes.address').' *', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('address', old('address'), ['id' => 'address', 'class' => 'form-control', 'placeholder' => trans('validation.attributes.address')]) !!}
        <span class="help-block">{{ $errors->first('address', ':message') }}</span>
    </div>
</div>