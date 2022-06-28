<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\History;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'user_id'=>'required',
            'proyect_id'=>'required',
            'homework_id'=>'required', 
            'time'=> 'required',
            'productivity'=> ''
        ]);

        $history = new History();
        $history->user_id = $request->get('user_id');
        $history->proyect_id = $request->get('proyect_id');
        $history->homework_id = $request->get('homework_id');
        $history->time = $request->get('time');
        $history->productivity = $request->get('productivity');
        $history -> save();

        return response()->json($history);
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
        $history_update = new History();
        $history_update->id = $request->get('id');
        $history_update->time = $request->get('time');
        $history_update->productivity = $request->get('productivity');

        $history_db = History::find($history_update->id);
        if($history_db->time !== $history_update->time) $history_db->time = $history_update->time;
        if($history_db->productivity !== $history_update->productivity) $history_db->productivity = $history_update->productivity;
       
        $history_db->save();

        $request->session()->put(['history' => $history_update]);
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
