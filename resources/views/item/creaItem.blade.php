@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Item</div>
                <div class="panel-body">

                    <form class="form-horizontal" id="fCreaItem" data-route="{{route('item.store')}}" data-method="POST">
                        
                        {{ csrf_field() }}                        

                        <div class="form-group">
                            <label for="nombre" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" autofocus>

                                <span class="msg-error hidden" id="err_nombre"></span>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="icono" class="col-md-4 control-label">Icono</label>

                            <div class="col-md-6">
                                <input id="icono" type="text" class="form-control" name="icono" autofocus>

                                <span class="msg-error hidden" id="err_icono"></span>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ruta" class="col-md-4 control-label">Ruta</label>

                            <div class="col-md-6">
                            <select name="ruta" class="form-control options_select"  id="ruta">
                            </select>
                                
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
                            <!-- <label for="estado_id" class="col-md-4 control-label">Estado</label> -->

                            <div class="col-md-6">
                                <input id="item_id" type="hidden" value="null" class="form-control" name="item_id" autofocus>

                                <span class="msg-error hidden" id="err_icono"></span>
                                
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" id="BtnCreaItem" class="btn btn-primary btnAjax" data-form="fCreaItem">
                                    Crear Item
                                </button>
                                <a href="{{route('item.index')}}">
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