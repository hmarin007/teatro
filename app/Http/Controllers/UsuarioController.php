<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/usuarios/usuarios');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            //=====================================================================
            //Password
            //=====================================================================
            $password = Hash::make($request->password);
            //=====================================================================
            $usuario                 = new User;
            $usuario->name            = $request->name;
            $usuario->email           = $request->email;
            $usuario->password        = $password;
            $usuario->save();
        
                return response()->json([
                    "msg" => "Registro creado", "usuario"=> $usuario
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \sig\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \sig\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuarios = User::find($id);
        return $usuarios;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \sig\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input  = $request->all();
        $data = User::find($id);
        $data->update($input);
        return response()->json([
            'success' => true,
            'msg' => 'Registro Actualizado'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \sig\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return response()->json([
            'success' => true,
            'msg' => 'Eliminación Exitosa'
        ]);
    }

    public function getData()
    {
        $fila = User::all();
            return DataTables::of($fila)
            ->addColumn('opcion', function($fila){
                return '<div class="btn-group">'.
                            '<button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> '.
                                '<i class="fa fa-level-down"></i> '.
                                '<span class="caret"></span> '.
                            '</button> '.
                            '<ul class="dropdown-menu" role="menu"> '.
                                '<li><a href="#" onclick="eliminar('.$fila->id.');"><i class="fa fa-trash-o"></i> Eliminar</a></li> '.
                                '<li><a href="#" onclick="editar('.$fila->id.');"><i class="fa fa-pencil"></i> Actualizar</a> '.
                                '</li> '.
                            '</ul> '.            
                        '</div>';
            })
            ->rawColumns(['opcion'])->make(true);
    }

}
