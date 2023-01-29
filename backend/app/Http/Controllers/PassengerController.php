<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passenger;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Passenger::get());
        //return $name = $request->type;
        // $data['passengers']=Passenger::get();
        // $data['type']=  $request->type;
        // where('t_id',$id)
        // ->first()
        // $type=$id;
        // if($type == 0){
        //     return response()->json(Passenger::get());
        // }
        // else {
        //     return response()->json(Passenger::where('p_type',$type)
        //     ->get());
        // }
        //return response()->json(Passenger::get());
        //return response()->json(Passenger::where('p_type',$type)
        //->get());
        // if($event > 0){
        //     //return response()->json(Passenger::getAll());
        // }
        // else {
        //     return response()->json(Passenger::get());
        // }
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
         $name = $request->name;
         $surname = $request->surname;
         $number = $request->number;
         $type = $request->type;
        if($name == "" || $surname == "" || $number=="" || $type=="")
        {
            return false;
        }
        $insrt_pdata = Passenger::insert([
            'p_name' => $name,
            'p_surname' => $surname,
            'p_number' => $number,
            'p_type' => $type,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        if($insrt_pdata)
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
        
        return response()->json(Passenger::where('id',$id)
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
        
        
        if($id <= 0)
        {
            return false;
        }
        $name = $request->name;
        $surname = $request->surname;
        $number = $request->number;
        $type = $request->type;
        if($name == "" || $surname == "" || $number=="" || $type=="")
        {
            return false;
        }
        $passenger = Passenger::find($id);
        $passenger->p_name = $request->input('name');
        $passenger->p_surname = $request->input('surname');
        $passenger->p_number = $request->input('number');
        $passenger->p_type = $request->input('type');
        $upt_pdata = $passenger->update();
        //$upt_pdata;
        
        if($upt_pdata)
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
        Passenger::whereId($id)->first()->delete();
        return response()->json('success');
    }
}
