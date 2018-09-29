<?php

namespace App\Http\Controllers;

use App\Reserva;
use Illuminate\Http\Request;
use GrahamCampbell\Flysystem\Facades\Flysystem;
use Storage;
use Session;
use Auth;
use DB;

class ReservaController extends Controller
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

        $user = Auth::user();

        $id = $user->id;
        
        $butacas = DB::table('reservas')->select('butacas')->where('usuario', $id)->first();

        $butacas_fila_1 = array(
          '1' => 'A1', '2' => 'B1', '3' => 'C1', '4' => 'D1', '5' => 'E1', '6' => 'F1', '7' => 'G1', '8' => 'H1', '9' => 'I1', '10' => 'J1' 
        );
        $butacas_fila_2 = array(
          '11' => 'A2', '12' => 'B2', '13' => 'C2', '14' => 'D2', '15' => 'E2', '16' => 'F2', '17' => 'G2', '18' => 'H2', '19' => 'I2', '20' => 'J2' 
        );
        $butacas_fila_3 = array(
          '21' => 'A3', '22' => 'B3', '23' => 'C3', '24' => 'D3', '25' => 'E3', '26' => 'F3', '27' => 'G3', '28' => 'H3', '29' => 'I3', '30' => 'J3' 
        );
        $butacas_fila_4 = array(
          '31' => 'A4', '32' => 'B4', '33' => 'C4', '34' => 'D4', '35' => 'E4', '36' => 'F4', '37' => 'G4', '38' => 'H4', '39' => 'I4', '40' => 'J4' 
        );
        $butacas_fila_5 = array(
          '41' => 'A5', '42' => 'B5', '43' => 'C5', '44' => 'D5', '45' => 'E5', '46' => 'F5', '47' => 'G5', '48' => 'H5', '49' => 'I5', '50' => 'J5' 
        );

        $reservaciones  = Reserva::all();
        return view('home', compact('butacas_fila_1', 'butacas_fila_2', 'butacas_fila_3', 'butacas_fila_4', 'butacas_fila_5', 'butacas'));
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
            //checkboxs butacas
            //=====================================================================
            if (isset($request->butacas)) {
                foreach ($request->butacas as $value) {
                    $a[] = $value;
                }
                $butacas = implode(", ", $a);
            }else{
                $butacas = '';
            }
                $reservacion           = new Reserva;
                $reservacion->fecha    = $request->fecha;
                $reservacion->usuario  = $request->usuario;
                $reservacion->butacas  = $butacas;
                $reservacion->save();
            
                // log text file

                $exists = Storage::exists('teatro_log.txt');
                if (isset($exists)) {

                    Storage::append( 'teatro_log.txt', $reservacion );

                }else{
                    Storage::put( 'teatro_log.txt', $reservacion );

                }
                //end text log file
            
                return response()->json([
                    "msg" => "Reservación creada para las butacas: ".$butacas, "reservacion"=> $reservacion
                ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
