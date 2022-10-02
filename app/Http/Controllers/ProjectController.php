<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $project = Project::where('user_id', '=', $id)->get()->toArray();
        return response()->json($project);
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

        $project = new Project();
        $project->name = $request->get('name');
        $project->color = $request->get('color');
        $project->user_id = $request->get('user_id');
        $project->time_improduct = $request->get('time_improduct');
        $project->time_normal = $request->get('time_normal');
        $project->time_product = $request->get('time_product');
        $project->count = $request->get('count');
        $project->total_time = $request->get('total_time');
        $project -> save();

        return response()->json($project);
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
        $project = Project::where('id', '=', $id)->get()->toArray();
        return response()->json($project);
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
        $project_update = new Project();
        $project_update->id = $request->get('id');
        $project_update->name = $request->get('name');
        $project_update->color = $request->get('color');
        $project_update->time_improduct = $request->get('time_improduct');
        $project_update->time_product = $request->get('time_product');
        $project_update->count = $request->get('count');
        $project_update->total_time = $request->get('total_time');


        $project_db = Project::find($project_update->id);
        if($project_db->name !== $project_update->name) $project_db->name = $project_update->name;
        if($project_db->color !== $project_update->color) $project_db->color = $project_update->color;
        if($project_db->time_improduct !== $project_update->time_improduct) $project_db->time_improduct = $project_update->time_improduct;
        if($project_db->time_product !== $project_update->time_product) $project_db->time_product = $project_update->time_product;
        if($project_db->count !== $project_update->count) $project_db->count = $project_update->count;
        if($project_db->total_time !== $project_update->total_time) $project_db->total_time = $project_update->total_time;
        
       
        $project_db->save();

        $request->session()->put(['project' => $project_update]);
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
        $project = Project::find($ids)->delete();
    }
}
