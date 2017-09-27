@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear rol</div>
                <div class="panel-body">

                    <form class="form-horizontal" id="fCreaRol" data-route="{{route('rol.store')}}" data-method="POST">
                        
                        {{ csrf_field() }}                        

                        <div class="form-group">
                            <label for="nombre" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" autofocus>

                                <span class="msg-error hidden" id="err_nombre"></span>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="estado_id" class="col-md-4 control-label">Estado</label>

                            <div class="col-md-6">
                            <select name="estado_id" class="form-control options_select"  id="estado_id">
                            </select>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" id="BtnCreaRol" class="btn btn-primary btnAjax" data-form="fCreaRol">
                                    Crear rol
                                </button>
                                <a href="{{route('rol.index')}}">
                                    <button type="button" class="btn btn-info">Volver</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection