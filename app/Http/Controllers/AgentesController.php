<?php

namespace App\Http\Controllers;

use App\Agentes;
use Illuminate\Http\Request;
USE Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class AgentesController extends Controller
{

   


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agentes = DB::table('agentes')
                ->select('agentes.id','agentes.id_user', 'agentes.cod_sip', 'agentes.dsc_agent','agentes.ativo', 'agentes.id_tipoagent','users.email')
                ->leftjoin('users as users', 'agentes.id_user', '=', 'users.id')
                ->orderBy('agentes.cod_sip', 'asc')
                ->get();
        return response()->json($agentes);
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
        $data = $request->all();

        $validator = Validator::make($data, [
            
            'cod_sip' => 'required',
            'dsc_agent' => 'required|max:255',
            'ativo' => 'required',
            'id_tipoagent' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $agentes = Agentes::create($data);

        return response([ 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agentes  $agentes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agentes = DB::table('agentes')
                ->select('agentes.id_user', 'agentes.cod_sip', 'agentes.dsc_agent','agentes.ativo', 'agentes.id_tipoagent','users.email')
                ->leftjoin('users as users', 'agentes.id_user', '=', 'users.id')
                ->where('agentes.id',$id)
                ->first();
        return response()->json($agentes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agentes  $agentes
     * @return \Illuminate\Http\Response
     */
    public function edit(Agentes $agentes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agentes  $agentes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $agentes = Agentes::find($id);
        
     
        if(!empty($request->id_user)){
            $agentes->id_user = $request->id_user;
        } else {
            return response([ 'message' => 'Informe o Seu Usuário cadastrado'], 401);
        }
        if(!empty($request->cod_sip)){
            $agentes->cod_sip = $request->cod_sip;
        } else {
            return response([ 'message' => 'Informe o código SIP'], 401);
        }
        if(!empty($request->dsc_agent)){
            $agentes->dsc_agent = $request->dsc_agent;
        } else {
            return response([ 'message' => 'Informe o seu Nome'], 401);
        }
        if(!empty($request->ativo)){
            $agentes->ativo = $request->ativo;
        } else {
            return response([ 'message' => 'Informe se o agente esta Ativo ou não'], 401);
        }
        if(!empty($request->id_tipoagent)){
            $agentes->id_tipoagent = $request->id_tipoagent;
        } else {
            return response([ 'message' => 'Informe o tipo de agente'], 401);
        }
        
        $agentes->save();
        return response([ 'message' => 'Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agentes  $agentes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agentes = Agentes::find($id);
        $agentes->delete();
        return response([ 'message' => 'Deleted successfully'], 200);
    }
}
