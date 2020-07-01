<?php

namespace App\Http\Controllers;

use App\Campanhas;
use Illuminate\Http\Request;
USE Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CampanhasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campanhas = Campanhas::all();
        return response()->json($campanhas);
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
            'dsc_campanha' => 'required|max:255',
            'ini_campanha' => 'required',
            'fim_campanha' => 'required',
            'ativo' => 'required',
            'encerrada' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $user = Campanhas::create($data);

        return response([ 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campanhas  $campanhas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campanhas = DB::table('campanhas')
        ->where('campanhas.id',$id)
        ->first(); 
        return response()->json($campanhas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campanhas  $campanhas
     * @return \Illuminate\Http\Response
     */
    public function edit(Campanhas $campanhas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campanhas  $campanhas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campanhas = Campanhas::find($id);
        
     
        if(!empty($request->dsc_campanha)){
            $campanhas->dsc_campanha = $request->dsc_campanha;
        } else {
            return response([ 'message' => 'Informe a Descrição da Campanha'], 401);
        }
        if(!empty($request->ini_campanha)){
            $campanhas->ini_campanha = $request->ini_campanha;
        } else {
            return response([ 'message' => 'Informe a data prevista para inicio'], 401);
        }
        if(!empty($request->fim_campanha)){
            $campanhas->fim_campanha = $request->fim_campanha;
        } else {
            return response([ 'message' => 'IInforme a data prevista para final'], 401);
        }
        if(!empty($request->ativo)){
            $campanhas->ativo = $request->ativo;
        } else {
            return response([ 'message' => 'Informe se a Campanha esta Ativa ou não'], 401);
        }
        if(!empty($request->encerrada)){
            $campanhas->encerrada = $request->encerrada;
        } else {
            return response([ 'message' => 'Informe se a Campanha esta encerrada ou não'], 401);
        }
        
        $campanhas->save();
        return response([ 'message' => 'Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campanhas  $campanhas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campanhas = Campanhas::find($id);
        $campanhas->delete();
        return response([ 'message' => 'Deleted successfully'], 200);
    }
}
