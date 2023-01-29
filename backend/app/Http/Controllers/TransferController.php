<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer;
use App\Models\Passenger;
use App\Models\Vehicle;


class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return "working";
        //$data['transfer']= Transfer::get();
        $data['transfer']= Transfer::join('passengers','transfers.p_id','=','passengers.id')
        ->join('vehicles','transfers.v_id','=','vehicles.id')
        ->get();
        $data['passenger'] = Passenger::get();
        $data['vehicle'] = Vehicle::get();
        return response()->json($data);
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
        $startpoint = $request->startpoint;
         $endpoint = $request->endpoint;
         $depdate = $request->depdate;
         $deptime = $request->deptime;
         $sltvehicle = $request->sltvehicle;
         $sltpassenger = $request->sltpassenger;
        if($startpoint == "" || $endpoint == "" || $depdate=="" || $deptime=="" || $sltvehicle=="" || $sltpassenger=="")
        {
            return false;
        }
        $insrt_tdata = Transfer::insert([
            'p_id' => $sltpassenger,
            'departure_date' => $depdate,
            'departure_time' => $deptime,
            'start_point' => $startpoint,
            'end_point' => $endpoint,
            'v_id' => $sltvehicle,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        if($insrt_tdata)
        {
            return true;
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
        return response()->json(Transfer::where('t_id',$id)
        ->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $t_id)
    {
        if($t_id <= 0)
        {
            return false;
        }
        $startpoint = $request->startpoint;
        $endpoint = $request->endpoint;
        $depdate = $request->depdate;
        $deptime = $request->deptime;
        $sltvehicle = $request->sltvehicle;
        $sltpassenger = $request->sltpassenger;
        if($startpoint == "" || $endpoint == "" || $depdate=="" || $deptime=="" || $sltvehicle=="" || $sltpassenger=="")
        {
            return false;
        }
        $upt_tdata = Transfer::where('t_id', '=',  $t_id)->update([
            'p_id' => $sltpassenger,
            'departure_date' => $depdate,
            'departure_time' => $deptime,
            'start_point' => $startpoint,
            'end_point' => $endpoint,
            'v_id' => $sltvehicle
         ]);
        // $transfer->start_point = $startpoint;
        // $transfer->end_point = $endpoint;
        // $transfer->departure_date = $depdate;
        // $transfer->departure_time = $deptime;
        // $transfer->v_id = $sltvehicle;
        // $transfer->p_id = $sltpassenger;
        // $upt_tdata = $transfer->update();
        
        if($upt_tdata)
        {
            return true;
        }
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
