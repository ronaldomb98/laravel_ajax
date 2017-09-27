<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use View;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rol.rol');
    }

    public function showTable()
    {
        return Datatables::of(Rol::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rol.creaRol');
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
            'nombre'=>'required',
            'estado_id'=>'required'
        ];
        
        $valida = Validator::make($request->all(),$regla);

        if ($valida->fails()) {
        return ['status' => false,
                'errors' => $valida->messages()];
        }

        Rol::create([
            'nombre' => $request->nombre,
            'estado_id' => $request->estado_id,
            'created_at' => date('Y-m-d h:i:s')
        ]);

        //return ['status'=>true,'out'=>'reload'];
        //return ['status'=>true,'out'=>'redirect','route'=>route('home')];
        return ['status'=>true,'out'=>'alert','title'=>'Atención','html'=>'Rol se guardó <b>éxitosamente</b>'];   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Rol::findOrFail($id);
        $dat = ["u"=>$data];
        $html = View::make('rol.verRol',$dat)->render();
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
        $u = Rol::findOrFail($id);
        
        return view('rol.editaRol', ["u" => $u]);
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

        $u = Rol::findOrFail($id);

        $regla = [
            'nombre' => 'required',
            'estado_id' => 'required'
        ];

        $valida = Validators::make($equest->all(), $regla);

        if ($valida->fails()) {
            return ['status' => false,
            'errors' => $valida->messages()];
        }

        $u->nombre = $request->nombre;
        $u->estado_id = $request->estado_id;

        return ['status'=>true,
        'out'=>'redirect',
        "route" => route('rol.index')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $u = Rol::findOrFail($id);
        $u->delete();

        return ['status'=>true,
                'out'=>'redirect', 
                'route'=>route('estado.index')];
    }
}
