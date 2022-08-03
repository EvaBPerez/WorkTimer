<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Proyect;

class ProyectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $proyect = Proyect::where('user_id', '=', $id)->get()->toArray();
        return response()->json($proyect);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $request->validate([
            'name'=>'required',
            'color'=>'required',
            'user_id'=>'required',
            'count'=> 'required',
        ]);

        $proyect = new Proyect();
        $proyect->name = $request->get('name');
        $proyect->color = $request->get('color');
        $proyect->user_id = $request->get('user_id');
        $proyect->time_improduct = $request->get('time_improduct');
        $proyect->time_normal = $request->get('time_normal');
        $proyect->time_product = $request->get('time_product');
        $proyect->count = $request->get('count');
        $proyect->total_time = $request->get('total_time');
        $proyect -> save();

        return response()->json($proyect);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $proyect = Proyect::where('id', '=', $id)->get()->toArray();
        return response()->json($proyect);
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
    public function update(Request $request)
    {
        //
        $proyect_update = new Proyect();
        $proyect_update->id = $request->get('id');
        $proyect_update->name = $request->get('name');
        $proyect_update->color = $request->get('color');
        $proyect_update->time_improduct = $request->get('time_improduct');
        $proyect_update->time_product = $request->get('time_product');
        $proyect_update->count = $request->get('count');
        $proyect_update->total_time = $request->get('total_time');


        $proyect_db = Proyect::find($proyect_update->id);
        if($proyect_db->name !== $proyect_update->name) $proyect_db->name = $proyect_update->name;
        if($proyect_db->color !== $proyect_update->color) $proyect_db->color = $proyect_update->color;
        if($proyect_db->time_improduct !== $proyect_update->time_improduct) $proyect_db->time_improduct = $proyect_update->time_improduct;
        if($proyect_db->time_product !== $proyect_update->time_product) $proyect_db->time_product = $proyect_update->time_product;
        if($proyect_db->count !== $proyect_update->count) $proyect_db->count = $proyect_update->count;
        if($proyect_db->total_time !== $proyect_update->total_time) $proyect_db->total_time = $proyect_update->total_time;
        
       
        $proyect_db->save();

        $request->session()->put(['proyect' => $proyect_update]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids)
    {
        //
        $proyect = Proyect::find($ids)->delete();
    }
}
