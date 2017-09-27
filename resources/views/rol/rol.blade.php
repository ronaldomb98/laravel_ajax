@extends('layouts.master')

@section('css')
<link href="{{asset('css/lib/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('contenido')
    <a href="{{route('rol.create')}}">
    <button type="button" class="btn btn-primary">Crear Rol</button></a>

    <br><br>
	
    <table class="table table-striped dataTables-example" id="tablaAjax">
	    <thead>
	      <tr>
	        <th>ID</th>
	        <th>NOMBRE</th>
            <th>Estado</th>
            <th>ACCION</th>
	      </tr>
	    </thead>
	</table>
@endsection

@section('js')
<script src="{{asset('js/lib/dataTables/datatables.min.js')}}"></script>
<script>
$(function() {
    
    $('#tablaAjax').DataTable({
        processing: true,
        serverSide: true,
        bAutoWidth: false,
        aaSorting: [],
        language:{"url": window.Laravel.url+"/js/lib/dataTables/data-table-spanish.json"},
        ajax: {
                url: '{!! route('rol.showTable') !!}',
                type: "POST",
                data: {"_token":"{{ csrf_token() }}"}
                },
        columns: [                    
                { data: 'id', name: 'id', className:'center' },
                { data: 'nombre', name: 'nombre' },
                { data: 'estado_id', name: 'estado_id' },
                { data: 'id', name: 'id', className:'center'}
            ],
        columnDefs: [
        {
            targets: 3,
            createdCell: function (td, cellData, rowData, row, col) {
                show="{!!URL::to('rol/"+cellData+"')!!}";
                edit="{!!URL::to('rol/"+cellData+"/edit')!!}";
                deleted="{!!URL::to('rol/"+cellData+"')!!}";
                $(td).html(buttonsTable(show,edit,deleted,true));
            }
        }
        ]
    });
    
});
 </script>
@endsection