<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::all()->toArray();
        return response()->json($user);
    }

    public function userInfo($id) {
        $user = User::where('id', '=', $id)->get()->toArray();
        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAdmin(Request $request)
    {
        //
        $message = 'not';
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'type' => 'required',
            'photo' => ''
        ]);

        $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = $request->get('password');
            $user->type = $request->get('type');
            $user->photo = $request->get('photo');

        $use = DB::table('user')
            ->where('email', '=', $user['email']);

        if($use->exists()) {
            return response()->json($message);

        } else {
            $message = 'ok';
            
            $user->save();

            return $user;
        }

    }

    public function create(Request $request)
    {
        //
        $message = 'not';
        $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = $request->get('password');
            $user->type = $request->get('type');
            $user->photo = $request->get('photo');

        $use = DB::table('user')
            ->where('email', '=', $user['email']);

        if ($use->exists()) {
            return response()->json($message);

        } else {
            $message = 'ok';
            $user->save();
            $request->session()->put(['user' => $user]);
            return $request->session()->all();
        }

    }



    public function login(Request $request)
    {
        //
        $request->validate([
            'email'=>['required', 'email'],
            'password'=> 'required'
        ]);
        $message='not';

        $message='not';
        $user = new User();
        $user->email=$request->get('email');
        $user->password=$request->get('password');
        $user = DB::table('user')
            ->where('email', '=', $user['email'])
            -> where('password', '=', $user['password']);
        if($user->exists()){
            $user_login = $user->get();
            session(['user'=>$user_login]);
            $message='ok';
        } 
        // return ($user['password']===$user['password'])? response()->json($user_check): 'Error: no coincide';
        
        return response()->json($message);
    }

    public function logout(Request $request) {
        $request->session()->forget('user');
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
    public function show(Request $request)
    {
        //
        return $request->session()->get('user');
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

        $user_update = new User();
        $user_update->id = $request->get('id');
        $user_update->name = $request->get('name');
        $user_update->email = $request->get('email');
        $user_update->password = $request->get('password');
        $user_update->type = $request->get('type');
        $user_update->photo = $request->get('photo');

        $user_db = User::find($user_update->id);
        if($user_db->name !== $user_update->name) $user_db->name = $user_update->name;
        if($user_db->email !== $user_update->email) $user_db->email = $user_update->email;
        if($user_db->password !== $user_update->password) $user_db->password = $user_update->password;
        if($user_db->type !== $user_update->type) $user_db->type = $user_update->type;
        if($user_db->photo !== $user_update->photo) $user_db->photo = $user_update->photo;
        
        $user_db->save();

        $request->session()->put(['user' => $user_update]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUserAdmin(Request $request)
    {
        //

        $user_update = new User();
        $user_update->id = $request->get('id');
        $user_update->name = $request->get('name');
        $user_update->type = $request->get('type');

        $user_db = User::find($user_update->id);
        if($user_db->name !== $user_update->name) $user_db->name = $user_update->name;
        if($user_db->type !== $user_update->type) $user_db->type = $user_update->type;
        
        $user_db->save();

        $request->session()->put(['user' => $user_update]);

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
        $user_id = $request->get('id');
        $request->session()->forget('user');
        $user = User::find($user_id)->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyUsers(Request $request)
    {
        //
        $arrayOn = $request->get('array');
         for ($i = 0; $i < count($arrayOn); $i++) {
            $users = User::find($arrayOn[$i]);
            
            $users->delete();
        }
        
    }
}
