@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Estado</div>
                <div class="panel-body">

                    <form class="form-horizontal" id="fCreaEstado" data-route="{{route('estado.store')}}" data-method="POST">
                        
                        {{ csrf_field() }}                        

                        <div class="form-group">
                            <label for="nombre" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" autofocus>

                                <span class="msg-error hidden" id="err_nombre"></span>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" id="BtnCreaEstado" class="btn btn-primary btnAjax" data-form="fCreaEstado">
                                    Crear Estado
                                </button>
                                <a href="{{route('estado.index')}}">
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