@extends('layouts.master')

@section('css')
<link href="{{asset('css/lib/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('contenido')
    <a href="{{route('estado.create')}}">
    <button type="button" class="btn btn-primary">Crear Estado</button></a>

    <br><br>
	
    <table class="table table-striped dataTables-example" id="tablaAjax">
	    <thead>
	      <tr>
	        <th>ID</th>
	        <th>NOMBRE</th>
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
                url: '{!! route('estado.showTable') !!}',
                type: "POST",
                data: {"_token":"{{ csrf_token() }}"}
                },
        columns: [                    
                { data: 'id', name: 'id', className:'center' },
                { data: 'nombre', name: 'nombre' },                
                { data: 'id', name: 'id', className:'center'}
            ],
        columnDefs: [
        {
            targets: 2,
            createdCell: function (td, cellData, rowData, row, col) {
                show="{!!URL::to('estado/"+cellData+"')!!}";
                edit="{!!URL::to('estado/"+cellData+"/edit')!!}";
                deleted="{!!URL::to('estado/"+cellData+"')!!}";
                $(td).html(buttonsTable(show,edit,deleted,true));
            }
        }
        ]
    });
    
});
 </script>
@endsection