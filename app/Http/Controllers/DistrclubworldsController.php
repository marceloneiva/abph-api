<?php

namespace App\Http\Controllers;

use App\Distrclubworlds;
use Illuminate\Http\Request;
USE Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DistrclubworldsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distrclub = Distrclubworlds::orderBy('id_distrito','asc')->orderBy('id_clube','asc')->paginate(10);
        return response()->json($distrclub);
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
            'id_distrito' => 'required',
            'dsc_clube' => 'required|max:255'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $user = Distrclubworlds::create($data);

        return response([ 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distrclubworlds  $distrclubworlds
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $distrclub = DB::table('distrclubworlds')
        ->where('distrclubworlds.id',$id)
        ->first(); 
        return response()->json($distrclub);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distrclubworlds  $distrclubworlds
     * @return \Illuminate\Http\Response
     */
    public function edit(Distrclubworlds $distrclubworlds)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distrclubworlds  $distrclubworlds
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $distrclub = Distrclubworlds::find($id);
        
     
        if(!empty($request->id_distrito)){
            $distrclub->id_distrito = $request->id_distrito;
        } else {
            return response([ 'message' => 'Informe o Codigo do Distrito'], 401);
        }
        
        if(!empty($request->dsc_clube)){
            $distrclub->dsc_clube = $request->dsc_clube;
        } else {
            return response([ 'message' => 'IInforme o nome do cluebe'], 401);
        }
        
        $distrclub->save();
        return response([ 'message' => 'Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distrclubworlds  $distrclubworlds
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $distrclub = Distrclubworlds::find($id);
        $distrclub->delete();
        return response([ 'message' => 'Deleted successfully'], 200);
    }
}
