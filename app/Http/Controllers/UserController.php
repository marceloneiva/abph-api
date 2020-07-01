<?php

namespace App\Http\Controllers;

USE Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Validator;

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


    //Retornar o tipo do user de acordo com email
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
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $user = User::create($data);

        return response([ 'message' => 'Created successfully'], 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Retornar os dados do user de acordo com id
        $users = DB::table('users')
                ->where('users.id',$id)
                ->first(); 
        return response()->json($users);
        
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
        $users = User::find($id);
         
        if(!empty($request->name)){
            $users->name = $request->name;
        } else {
            return response([ 'message' => 'Informe o seu Nome'], 401);
        }
        if(filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $users->email    = $request->email;
        } else {
            return response([ 'message' => 'Esse Email é invalido!'], 401);
        }
        
        if(!empty($request->password)){
            $users->password = hash::make($request->password);
        } else {
            return response([ 'message' => 'Informe a sua senha!'], 401);
        }
        
        $users->save();
        return response([ 'message' => 'Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        return response([ 'message' => 'Deleted successfully'], 200);

    }
}
