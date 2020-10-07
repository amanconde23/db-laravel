<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Gate;

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
        return view('admin/usuario/adminUsuarios', [
            'users' => $users
        ]);
    }

    public function showAllUsers()
    {
        $users = User::all();
        return view('usuario/usuarios', [
            'users' => $users
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('usuario/verUsuario', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editUserForm(User $user)
    {
        return view('usuario/editarUsuario', [
            'user' => $user
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        Alert::success('Sucesso!', 'Usuário Atualizado com Sucesso!');
        $user = User::find($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        
        return redirect()->route('user-pannel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['status'=>'Sua conta foi excluída com sucesso!']);
    }

    public function destroyUserAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['status'=>'Usuário excluído com sucesso!']);
    }

    /**
     * Barra de pesquisa por produtos
     * 
    */
    public function search(Request $request)
    {
        $search = $request->get('searchUser');
        $users = User::where('name', 'LIKE', '%'.$search.'%')->get();
        if(count($users) > 0){
            return view('usuario/resultadoBuscaUsuario')->withDetails($users)->withQuery($search);
        }else{
            return view('usuario/resultadoBuscaUsuario')->withMessage('Nenhum resultado encontrado');
        }
    }
}
