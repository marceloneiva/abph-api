<?php

namespace App\Http\Controllers;

use App\Agendas;
use Illuminate\Http\Request;
USE Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class AgendasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendas = DB::table('agendas')
                ->select('agendas.id','agendas.telefone','agendas.email','agendas.nome','agendas.id_campanha','campanhas.dsc_campanha','agendas.data_agendada','agendas.id_cont','continentes.dsc_cont','agendas.id_pais','pais.local_name','agendas.id_distclub','agendas.id_distrito','distrclubworlds.id_clube','distrclubworlds.dsc_clube','agendas.id_agente','users.name')
                ->leftjoin('campanhas as campanhas', 'agendas.id_campanha', '=', 'campanhas.id')
                ->leftjoin('continentes as continentes', 'agendas.id_cont', '=', 'continentes.id')
                ->leftjoin('pais as pais', 'agendas.id_pais', '=', 'pais.id')
                ->leftjoin('distrclubworlds as distrclubworlds', 'agendas.id_distclub', '=', 'distrclubworlds.id')
                ->leftjoin('users as users', 'agendas.id_agente', '=', 'users.id')
                ->orderBy('id_agente','asc')
                ->orderBy('id_campanha','asc')
                ->orderBy('data_agendada','asc')
                ->orderBy('id_cont','asc')
                ->orderBy('id_pais','asc')
                ->orderBy('id_distrito','asc')
                ->paginate(10);
                return response()->json($agendas);
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

            'id_agente' => 'required', 
            'telefone' => 'required', 
            'email' => 'required|max:255',
            'nome' => 'required|max:255', 
            'data_agendada' => 'required',
            'id_cont' => 'required',
            'id_pais' => 'required',
            'id_distclub' => 'required',
            'id_distrito' => 'required',
            'id_campanha' => 'required',

        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $user = Agendas::create($data);

        return response([ 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agendas  $agendas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agendas = DB::table('agendas')
        ->select('agendas.id','agendas.telefone','agendas.email','agendas.nome','agendas.id_campanha','campanhas.dsc_campanha','agendas.data_agendada','agendas.id_cont','continentes.dsc_cont','agendas.id_pais','pais.local_name','agendas.id_distclub','agendas.id_distrito','distrclubworlds.id_clube','distrclubworlds.dsc_clube','agendas.id_agente','users.name')
        ->leftjoin('campanhas as campanhas', 'agendas.id_campanha', '=', 'campanhas.id')
        ->leftjoin('continentes as continentes', 'agendas.id_cont', '=', 'continentes.id')
        ->leftjoin('pais as pais', 'agendas.id_pais', '=', 'pais.id')
        ->leftjoin('distrclubworlds as distrclubworlds', 'agendas.id_distclub', '=', 'distrclubworlds.id')
        ->leftjoin('users as users', 'agendas.id_agente', '=', 'users.id')
        ->where('agendas.id',$id)
        ->first(); 
        return response()->json($agendas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agendas  $agendas
     * @return \Illuminate\Http\Response
     */
    public function edit(Agendas $agendas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agendas  $agendas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $agendas = Agendas::find($id);
        
           
        if(!empty($request->id_agente)){
            $agendas->id_agente = $request->id_agente;
        } else {
            return response([ 'message' => 'Informe o Agente'], 401);
        }
        if(!empty($request->telefone)){
            $agendas->telefone = $request->telefone;
        } else {
            return response([ 'message' => 'Informe o telefone'], 401);
        }
        if(!empty($request->email)){
            $agendas->email = $request->email;
        } else {
            return response([ 'message' => 'Informe o email'], 401);
        }
        if(!empty($request->nome)){
            $agendas->nome = $request->nome;
        } else {
            return response([ 'message' => 'Informe o nome'], 401);
        }
        if(!empty($request->data_agendada)){
            $agendas->data_agendada = $request->data_agendada;
        } else {
            return response([ 'message' => 'Informe a data'], 401);
        }
        
        if(!empty($request->id_cont)){
            $agendas->id_cont = $request->id_cont;
        } else {
            return response([ 'message' => 'Informe o continente'], 401);
        }
        if(!empty($request->id_pais)){
            $agendas->id_pais = $request->id_pais;
        } else {
            return response([ 'message' => 'Informe o pais'], 401);
        }
        if(!empty($request->id_distclub)){
            $agendas->id_distclub = $request->id_distclub;
        } else {
            return response([ 'message' => 'Informe o Distrito do clube'], 401);
        }
        
        if(!empty($request->id_distrito)){
            $agendas->id_distrito = $request->id_distrito;
        } else {
            return response([ 'message' => 'Innforme o Distrito do clube'], 401);
        }
        if(!empty($request->id_campanha)){
            $agendas->id_campanha = $request->id_campanha;
        } else {
            return response([ 'message' => 'Informe a Campanha'], 401);
        }
        

        $agendas->save();
        return response([ 'message' => 'Updated successfully'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agendas  $agendas
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $agendas = Agendas::find($id);
        $agendas->delete();
        return response([ 'message' => 'Deleted successfully'], 200);
    }
}
