<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;
use Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use View;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estado.estado');
    }

    public function showTable()
    {
        return Datatables::of(Estado::query())->make(true);
    }

    public function all()
    {
        return Estado::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estado.creaEstado');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regla = [
            'nombre'=>'required'
        ];
        
        $valida = Validator::make($request->all(),$regla);

        if ($valida->fails()) {
        return ['status' => false,
                'errors' => $valida->messages()];
        }

        Estado::create([
            'nombre' => $request->nombre,
            'created_at' => date('Y-m-d h:i:s')
        ]);

        //return ['status'=>true,'out'=>'reload'];
        //return ['status'=>true,'out'=>'redirect','route'=>route('home')];
        return ['status'=>true,'out'=>'alert','title'=>'Atención','html'=>'Estado se guardó <b>éxitosamente</b>'];   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Estado::findOrFail($id);
        $dat = ["u"=>$data];
        $html = View::make('estado.verEstado',$dat)->render();
        return ['title'=>'Detalle','html'=>$html]; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $u = Estado::findOrFail($id);
        
        return view('estado.editaEstado', ["u" => $u]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $u = Estado::findOrFail($id);
        
        $regla = [
            'nombre'=>'required',
        ];
        $valida = Validator::make($request->all(),$regla);
        
        if ($valida->fails()) {
            return ['status' => false,
                    'errors' => $valida->messages()];
        }
        $u->nombre = $request->nombre;
        $u->save();

        return ['status'=>true,
                'out'=>'redirect',
                "route" => route('estado.index')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $u = Estado::findOrFail($id);
        $u->delete();

        return ['status'=>true,
                'out'=>'redirect', 
                'route'=>route('estado.index')];
    }
}
