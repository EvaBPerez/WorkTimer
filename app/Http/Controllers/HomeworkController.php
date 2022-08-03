<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Homework;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $homeworks = Homework::where('proyect_id', '=', $id)->get()->toArray();
        return response()->json($homeworks);
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
            'user_id'=>'required',
            'proyect_id'=>'required', 
            'count'=>'required',
        ]);

        $homework = new Homework();
        $homework->name = $request->get('name');
        $homework->color = $request->get('color');
        $homework->user_id = $request->get('user_id');
        $homework->proyect_id = $request->get('proyect_id');
        $homework->time_improduct = $request->get('time_improduct');
        $homework->time_normal = $request->get('time_normal');
        $homework->time_product = $request->get('time_product');
        $homework->count = $request->get('count');
        $homework->total_time = $request->get('total_time');
        $homework -> save();

        return response()->json($homework);
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
        $homework = Homework::where('id', '=', $id)->get()->toArray();
        return response()->json($homework);
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
        $homework_update = new Homework();
        $homework_update->id = $request->get('id');
        $homework_update->name = $request->get('name');
        $homework_update->color = $request->get('color');
        $homework_update->time_improduct = $request->get('time_improduct');
        $homework_update->time_product = $request->get('time_product');
        $homework_update->count = $request->get('count');
        $homework_update->total_time = $request->get('total_time');


        $homework_db = Homework::find($homework_update->id);
        if($homework_db->name !== $homework_update->name) $homework_db->name = $homework_update->name;
        if($homework_db->color !== $homework_update->color) $homework_db->color = $homework_update->color;
        if($homework_db->time_improduct !== $homework_update->time_improduct) $homework_db->time_improduct = $homework_update->time_improduct;
        if($homework_db->time_product !== $homework_update->time_product) $homework_db->time_product = $homework_update->time_product;
        if($homework_db->count !== $homework_update->count) $homework_db->count = $homework_update->count;
        if($homework_db->total_time !== $homework_update->total_time) $homework_db->total_time = $homework_update->total_time;
        
       
        $homework_db->save();

        $request->session()->put(['homework' => $homework_update]);
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
        $homework = Homework::find($id)->delete();
    }
}
