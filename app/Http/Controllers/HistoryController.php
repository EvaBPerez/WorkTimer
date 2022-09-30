<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\History;
use App\Models\Homework;
use App\Models\Proyect;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $history = DB::table('history')
            ->select('history.id', 'history.time', 'history.created_at', 'proyect.name as proyect_name', 'homework.name as homework_name')
            ->where('history.user_id', '=', $id)
            ->crossJoin('proyect', 'proyect.id', '=', 'history.proyect_id')
            ->crossJoin('homework', 'homework.id', '=', 'history.homework_id')->get();
        return response()->json($history);
    }

    public function graphicDays($id) {
        $day = date("Y-m-d h:m:s");
        $day1 = date("Y-m-d h:m:s", strtotime(date("Y-m-d h:m:s")."- 14 days"));
        $history = DB::table('history')
            ->where('history.proyect_id', '=', $id)
            ->where('history.created_at', '<=', $day)
            ->where('history.created_at', '>=', $day1)->get();
        return response()->json($history);
    }

    public function graphicWeek($id) {
        $day = date("Y-m-d h:m:s");
        $day1 = date("Y-m-d h:m:s", strtotime(date("Y-m-d h:m:s")."- 7 days"));
        $history = DB::table('history')
            ->where('history.proyect_id', '=', $id)
            ->where('history.created_at', '<=', $day)
            ->where('history.created_at', '>=', $day1)->get();
        return response()->json($history);
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
        $history = DB::table('history')
            ->where('user_id', '=', $id)
            ->where('productivity', '=', NULL)
            ->get();
        return response()->json($history);
        
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
    public function destroy(Request $request)
    {
        //
        $arrayOn = $request->get('array');
         for ($i = 0; $i < count($arrayOn); $i++) {
            $history = History::find($arrayOn[$i]);
            $homework = Homework::find($history->homework_id);
            $proyect = Proyect::find($history->proyect_id);

            $homework->total_time = $homework->total_time - $history->time;
            $proyect->total_time = $proyect->total_time - $history->time;
            $homework->count = $homework->count - 1;
            $proyect->count = $proyect->count - 1;
            if ($history->productivity == 1) { //es productivo
                $homework->time_product = $homework->time_product - $history->time;
                $proyect->time_product = $proyect->time_product - $history->time;
            } else if ($history->productivity == 3) { //es productivo
                $homework->time_improduct = $homework->time_improduct - $history->time;
                $proyect->time_improduct = $proyect->time_improduct - $history->time;
            }

            $homework->save();
            $proyect->save();

            $history->delete();

            $request->session()->put(['proyect' => $proyect]);
            $request->session()->put(['homework' => $proyect]);
        }
        
    }
}
