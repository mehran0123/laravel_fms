@extends('layouts.app')

@section('content')
    <h3 class="page-title">Sku</h3>
    
    {!! Form::model($sku, ['method' => 'PUT', 'route' => ['admin.sku.update', $sku->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
           Edit
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('sku', 'SKU'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('sku', old('sku'), ['class' => 'form-control', 'placeholder' => 'sku', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('sku'))
                        <p class="help-block">
                            {{ $errors->first('sku') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Name'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('sales_person', 'Product Sales Person'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('sales_person', old('sales_person'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('sales_person'))
                        <p class="help-block">
                            {{ $errors->first('sales_person') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-12 form-group">
                    {!! Form::label('description', 'Product Description', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-12 form-group">
                    {!! Form::label('seller_name', 'Seller Name', ['class' => 'control-label']) !!}
                    {!! Form::text('seller_name', old('seller_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('seller_name'))
                        <p class="help-block">
                            {{ $errors->first('seller_name') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-12 form-group">
                    {!! Form::label('seller_phone', 'Seller Phone', ['class' => 'control-label']) !!}
                    {!! Form::text('seller_phone', old('seller_phone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('seller_phone'))
                        <p class="help-block">
                            {{ $errors->first('seller_phone') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-12 form-group">
                    {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                    {!! Form::text('address', old('address'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('address'))
                        <p class="help-block">
                            {{ $errors->first('address') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

