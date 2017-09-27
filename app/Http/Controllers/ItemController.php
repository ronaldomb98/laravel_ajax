<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Route;

use Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use View;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('item.item');
    }

    public function showTable()
    {
        return Datatables::of(Item::get())->make(true);
    }

    public function routes()
    {
        $routeCollection = Route::getRoutes();
        $routes_urls = array();
        //echo gettype($routeCollection);
        
        foreach ($routeCollection as $key => $value) {
            // echo $key.'<br>';
            // var_dump($value);
            // echo '<hr>'; 
            //var_dump($value->action['middleware']);
            
            if($value->methods[0] == 'GET' && $value->action['prefix'] == null)
            {
                //var_dump($value->methods[0]);
                $url = $value->uri;
                array_push($routes_urls, $url);
            }
            
            
        }
        //return json_encode($routes_urls);
        return ($routes_urls); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('item.creaItem');
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
            'ruta'=>'required',
            'icono'=>'',
            'estado_id'=>'required',
            'item_id'=>'required',
        ];
        
        $valida = Validator::make($request->all(),$regla);

        if ($valida->fails()) {
        return ['status' => false,
                'errors' => $valida->messages()];
        }

        Item::create([
            'nombre' => $request->nombre,
            'ruta' => $request->ruta,
            'icono' => $request->icono,
            'estado_id' => $request->estado_id,
            'item_id' => null,
            'created_at' => date('Y-m-d h:i:s')
        ]);

        //return ['status'=>true,'out'=>'reload'];
        //return ['status'=>true,'out'=>'redirect','route'=>route('home')];
        return ['status'=>true,'out'=>'alert','title'=>'Atención','html'=>'Item se guardó <b>éxitosamente</b>'];   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Item::findOrFail($id);
        $dat = ["u"=>$data];
        $html = View::make('item.verItem',$dat)->render();
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
        $u = Item::findOrFail($id);
        
        return view('item.editaItem', ["u" => $u]);
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
        $u = Item::findOrFail($id);
        
        $regla = [
            'nombre'=>'required',
            'ruta'=>'required',
            'icono'=>'required',
            'estado_id'=>'required',
            'item_id'=>'required',
        ];

        $valida = Validators::make($equest->all(), $regla);

        if ($valida->fails()) {
            return ['status' => false,
            'errors' => $valida->messages()];
        }

        $u->nombre = $request->nombre;
        $u->ruta = $request->ruta;
        $u->icono = $request->icono;
        $u->estado_id = $request->estado_id;
        $u->item_id = $request->item_id;

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
        //
    }
}
