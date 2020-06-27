<?php

namespace App\Http\Controllers;

USE Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }


    //Retornar id do user para continuacao
    public function whouser($email) {
      
        //SELECT agentes.cod_sip, agentes.id_tipoagent FROM agentes LEFT JOIN users ON agentes.id_user = users.id where email = 'marceloneiva@yahoo.com.br'
        //$users = User::where('email',$email)->get();
        $users = DB::table('agentes')
                ->select('agentes.cod_sip', 'agentes.id_tipoagent', 'users.name', 'agentes.id_user')
                ->leftjoin('users as users','agentes.id_user', '=', 'users.id')
                ->where('users.email',$email)
                ->first(); 
        return response()->json($users);
        //return ['id' => $users->id];
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
