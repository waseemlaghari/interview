<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Vehicle::get());
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
        $vehiclename = $request->vehiclename;
         $vehiclenumber = $request->vehiclenumber;
         $drivername = $request->drivername;
         $driversurname = $request->driversurname;
        if($vehiclename == "" || $vehiclenumber == "" || $drivername=="" || $driversurname=="")
        {
            return false;
        }
        $insrt_vdata = Vehicle::insert([
            'vehicle_name' => $vehiclename,
            'vehicle_number' => $vehiclenumber,
            'driver_name' => $drivername,
            'driver_surname' => $driversurname,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        if($insrt_vdata)
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
        return response()->json(Vehicle::whereId($id)
        ->first());
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
        // if($id <= 0)
        // {
        //     return false;
        // }
        $vehiclename = $request->vehiclename;
        $vehiclenumber = $request->vehiclenumber;
        $drivername = $request->drivername;
        $driversurname = $request->driversurname;
        if($vehiclename == "" || $vehiclenumber == "" || $drivername=="" || $driversurname=="")
        {
            return false;
        }
        $vehicle = Vehicle::find($id);
        $vehicle->vehicle_name = $vehiclename;
        $vehicle->vehicle_number = $vehiclenumber;
        $vehicle->driver_name = $drivername;
        $vehicle->driver_surname = $driversurname;
        $upt_vdata = $vehicle->update();
        
        
        if($upt_vdata)
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
        Vehicle::whereId($id)->first()->delete();
        return response()->json('success');
    }
}
